<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Trans;
use Illuminate\Http\Request;

class TransController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // check authorisation of requested user
        $this->middleware('auth');

        $trans = new Trans();

        // get requested balance
        $balance = Balance::find($request->get('balance_id'));
        if (!$balance->exists) {
            return back()->with('fail', 'Unknown balance');
        }

        // set transaction field
        $trans->amount = $request->get('amount');
        $trans->type = $request->get('type');
        $trans->title = $request->get('title') ? $request->get('title') : null;
        $trans->description = $request->get('description') ? $request->get('description') : null;

        // assign transaction to balance
        $trans->balance()->associate($balance);

        // save transaction
        if ($trans->save()) {
            return back()->with('success', 'Transaction added');
        } else {
            return back()->with('fail', 'Cannot add transaction');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // check authorisation of requested user
        $this->middleware('auth');

        // get instance
        $trans = Trans::findOrFail($id);

        // update instance fields
        $trans->amount = $request->get('amount');
        $trans->type = $request->get('type');
        $trans->title = $request->get('title') ? $request->get('title') : null;
        $trans->description = $request->get('description') ? $request->get('description') : null;

        // save transaction
        if ($trans->save()) {
            $trans->balance()->touch();

            return back()->with('success', 'Transaction updated');
        } else {
            return back()->with('fail', 'Cannot save transaction or data not changed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tran = Trans::find($id);
        if (!$tran->exists) {
            return back()->with('fail', 'Unknown transaction');
        }

        if (!$tran->delete()) {
            return back()->with('fail', 'Cannot delete transaction');
        }

        return back()->with('success', 'Transaction deleted');
    }
}
