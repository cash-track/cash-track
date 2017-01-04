<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\User;
use Auth;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class BalanceController.
 */
class BalanceController extends Controller
{
    /**
     * BalanceController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new balance.
     *
     * @return View|ViewFactory
     */
    public function create()
    {
        return view('balance.new');
    }

    /**
     * Store a newly created balance in database.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // create balance instance
        $balance = new Balance();

        // fill balance fields
        $balance->amount = $request->get('amount');
        switch ($request->get('type')) {
            case '1':
                // Balance active
                $balance->is_active = true;
                break;
            case '2':
                // only this balance active
                $balance->is_active = true;
                Auth::user()->balances()->where('is_active', 1)
                    ->update(['is_active' => 0]);
                break;
            case '3':
                // balance not active
                $balance->is_active = false;
                break;
        }

        // save balance
        if ($balance->save()) {

            // attach balance to user
            Auth::user()->balances()->attach($balance);

            return redirect()->route('balance.show', ['id' => $balance->id]);
        } else {
            return back()->with('fail', 'Cannot create balance');
        }
    }

    /**
     * Display the specified balance.
     *
     * @param int $id
     *
     * @return View|ViewFactory|RedirectResponse
     */
    public function show($id)
    {
        $balance = Balance::findOrFail($id);

        // balance can see only attached user
        if (!$balance->hasUser(Auth::user())) {
            return redirect(route('dashboard'));
        }

        return view('balance.show', compact('balance'));
    }

    /**
     * Show the form for editing the specified balance.
     *
     * @param int $id
     *
     * @return View|ViewFactory
     */
    public function edit($id)
    {
        $balance = Balance::findOrFail($id);

        return view('balance.edit', compact('balance'));
    }

    /**
     * Update the specified balance in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // get balance instance
        $balance = Balance::findOrFail($id);

        // update balance fields
        $balance->amount = $request->get('amount');
        switch ($request->get('type')) {
            case '1':
                // Balance actives
                $balance->is_active = true;
                break;
            case '2':
                // only this balance active
                $balance->is_active = true;
                Auth::user()->balances()->where('is_active', 1)
                    ->update(['is_active' => 0]);
                break;
            case '3':
                // balance not active
                $balance->is_active = false;
                break;
        }

        // save balance
        if ($balance->save()) {
            return redirect()->route('balance.show', ['id' => $balance->id])->with('success', 'Balance updated');
        } else {
            return back()->with('fail', 'Cannot update balance or data not changed.');
        }
    }

    /**
     * Activate specified balance.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return RedirectResponse
     */
    public function activate(Request $request, $id)
    {
        $balance = Balance::findOrFail($id);
        $balance->is_active = true;
        $balance->save();

        return back()->with('success', 'Balance activated');
    }

    /**
     * Disactivate specified balance.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return RedirectResponse
     */
    public function disactivate(Request $request, $id)
    {
        $balance = Balance::findOrFail($id);
        $balance->is_active = false;
        $balance->save();

        return back()->with('success', 'Balance disactivated');
    }


    public function showInvite($id){
        $balance = Balance::findOrFail($id);

        // balance can see only attached user
        if (!$balance->hasUser(Auth::user()))
            return redirect(route('dashboard'));

        return view('balance.invite', compact('balance'));
    }

    /**
     * Invite user to balance
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invite(Request $request, $id)
    {
        $user = User::find($request->get('user_id'));
        if(!$user->exists)
            return back()->with('fail', 'Cannot invite unknown user');

        $balance = Balance::find($id);

        $user->balances()->attach($balance);

        return back()->with('success', 'User invited to this balance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $balance = Balance::findOrFail($id);
        $balance->users()->detach();
        $balance->trans()->delete();
        $balance->delete();

        return redirect()->route('dashboard');
    }
}
