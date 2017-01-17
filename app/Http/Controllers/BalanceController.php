<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\{
    Balance, User
};
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\{
    JsonResponse, RedirectResponse, Request
};
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
     * @return View
     */
    public function create() :View
    {
        return view('balance.new');
    }

    /**
     * Store a newly created balance in database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) :RedirectResponse
    {
        // create balance instance
        $balance = new Balance();

        // fill balance fields
        $balance->title = $request->get('title');
        switch ($request->get('type')) {
            case '1':
                // Balance active
                $balance->is_active = true;
                break;
            case '2':
                // only this balance active
                $balance->is_active = true;
                Auth::user()
                    ->balances()
                    ->where('is_active', 1)
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

            // make current user as balance owner
            $balance->owner()->associate(Auth::user());

            return redirect()->route('balance.show', ['id' => $balance->id]);
        } else {
            return back()->with('fail', 'Cannot create balance');
        }
    }

    /**
     * Display the specified balance.
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function show(int $id) :View
    {
        $balance = Balance::findOrFail($id);

        // balance can see only attached user
        if (!$balance->hasUser(Auth::user())) {
            return redirect()->route('dashboard');
        }

        return view('balance.show', compact('balance'));
    }

    /**
     * Show the form for editing the specified balance.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id) :View
    {
        $balance = Balance::findOrFail($id);

        return view('balance.edit', compact('balance'));
    }

    /**
     * Update the specified balance in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id) :RedirectResponse
    {
        // get balance instance
        $balance = Balance::findOrFail($id);

        // update balance fields
        $balance->title = $request->get('title');
        switch ($request->get('type')) {
            case '1':
                // Balance actives
                $balance->is_active = true;
                break;
            case '2':
                // only this balance active
                $balance->is_active = true;
                Auth::user()
                    ->balances()
                    ->where('is_active', 1)
                    ->update(['is_active' => 0]);
                break;
            case '3':
                // balance not active
                $balance->is_active = false;
                break;
        }

        // save balance
        if ($balance->save()) {
            return redirect()
                ->route('balance.show', ['id' => $balance->id])
                ->with('success', 'Balance updated');
        } else {
            return back()->with('fail', 'Cannot update balance or data not changed.');
        }
    }

    /**
     * Activate specified balance.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function activate(Request $request, int $id) :RedirectResponse
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
     * @param int $id
     * @return RedirectResponse
     */
    public function disactivate(Request $request, int $id) :RedirectResponse
    {
        $balance = Balance::findOrFail($id);
        $balance->is_active = false;
        $balance->save();

        return back()->with('success', 'Balance disactivated');
    }


    /**
     * Display invite page
     *
     * @param int $id
     * @return View
     */
    public function showInvite(int $id) :View
    {
        $balance = Balance::findOrFail($id);

        // balance can see only attached user
        if (!$balance->hasUser(Auth::user()))
            return redirect(route('dashboard'));

        return view('balance.invite', compact('balance'));
    }

    /**
     * Invite user to balance
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function invite(Request $request, int $id) :RedirectResponse
    {
        $user = User::find($request->get('user_id'));
        if(is_null($user) || !$user->exists)
            return back()->with('fail', 'Cannot invite unknown user');

        $balance = Balance::find($id);
        $invited = $balance->users()->get();
        $result = $invited->search(function($item, $key) use ($user) {
            return $item->id == $user->id;
        });

        if($result !== false)
            return back()->with('fail', 'User already invited');

        $user->balances()->attach($balance);

        return back()->with('success', 'User invited to this balance');
    }

    /**
     * Remove user invite in balance
     *
     * @param Request $request
     * @param int $id
     * @param int $user_id
     * @return RedirectResponse
     */
    public function unInvite(Request $request, int $id, int $user_id) :RedirectResponse
    {
        $user = User::find($user_id);
        if(is_null($user) || !$user->exists)
            return back()->with('fail', 'Unknown user');

        $balance = Balance::find($id);

        $user->balances()->detach($balance);

        return back()->with('success', 'User uninvited success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id) :RedirectResponse
    {
        $balance = Balance::findOrFail($id);
        $balance->users()->detach();
        $balance->trans()->delete();
        $balance->delete();

        return redirect()->route('dashboard');
    }

    /**
     * User auto complete handler on invite page
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function inviteAutoComplete(Request $request) :JsonResponse
    {
        $value = $request->get('name');

        $result = User::where('name', 'LIKE', '%'.$value.'%')
            ->orWhere('email', 'LIKE', '%'.$value.'%')
            ->get();

        return response()->json($result);
    }
}
