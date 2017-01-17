<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\{
    Request, RedirectResponse
};
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index() :View
    {
        $balances = Auth::user()
            ->balances()
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('profile.dashboard', compact('balances'));
    }

    /**
     * Display profile page
     * Count a small statistics
     *
     * @return View
     */
    public function profile() :View
    {
        $user = Auth::user();
        $debited = $credited = [];

        $week_ago_date = Carbon::now()->subWeek()->format('Y-m-d H:i:s');
        $month_ago_date = Carbon::now()->subMonth()->format('Y-m-d H:i:s');

        // get summary of all debited transactions
        $debited['all'] = $user->transactions()
            ->where('type', '=', '+')
            ->sum('amount');

        // get summary of all credited transactions
        $credited['all'] = $user->transactions()
            ->where('type', '=', '-')
            ->sum('amount');

        // get summary per last week debited transactions
        $debited['week'] = $user->transactions()
            ->where('type', '=', '+')
            ->where('created_at', '>=', $week_ago_date)
            ->sum('amount');

        // get summary per last week credited transactions
        $credited['week'] = $user->transactions()
            ->where('type', '=', '-')
            ->where('created_at', '>=', $week_ago_date)
            ->sum('amount');

        // get summary per last month debited transactions
        $debited['month'] = $user->transactions()
            ->where('type', '=', '+')
            ->where('created_at', '>=', $month_ago_date)
            ->sum('amount');

        // get summary per last month credited transactions
        $credited['month'] = $user->transactions()
            ->where('type', '=', '-')
            ->where('created_at', '>=', $month_ago_date)
            ->sum('amount');

        $active_balances = $user->balances()
            ->where('is_active', '=', true)
            ->get();

        $transactions = $user->transactions()
            ->orderBy('updated_at', 'desc')
            ->paginate(3);

        return view('profile.index', compact('user', 'credited', 'debited', 'active_balances', 'transactions'));
    }

    /**
     * Display edit profile page
     *
     * @param string $section
     * @return View
     */
    public function setting(string $section = 'general') :View
    {
        $user = Auth::user();

        return view('profile.setting', compact('user', 'section'));
    }

    /**
     * Save new profile settings
     *
     * @param Request $request
     * @param string $section
     * @param string $action
     * @return RedirectResponse
     */
    public function update(Request $request, string $section = 'general', string $action) :RedirectResponse
    {
        $user = Auth::user();

        switch($section){
            case 'general':
                //
                break;
            case 'notification':
                //
                break;
            case 'access':
                return $this->updateAccess($request, $user, $action);
                break;
        }

        return back()->with(
            'error',
            'Possible XSS attack detected. Unexpected form action'
        );
    }

    /**
     * Update access options section
     *
     * @param Request $request
     * @param User $user
     * @param string $action
     * @return RedirectResponse
     */
    private function updateAccess(Request $request, User $user, string $action) :RedirectResponse
    {
        switch($action){
            case 'update-password':
                return $this->updatePassword($request, $user, $action);
                break;
        }

        return back()->with(
            'error',
            'Possible XSS attack detected. Unexpected form action'
        );
    }

    /**
     * Update profile password
     *
     * @param Request $request
     * @param User $user
     * @param string $action
     * @return RedirectResponse
     */
    private function updatePassword(Request $request, User $user, string $action) :RedirectResponse
    {
        // validate old password
        if(!\Hash::check($request->get('old-password'), $user->password)){
            // old password not valid
            return back()
                ->with($action.'-error', 'Old password is not valid')
                ->withInput();
        }

        // validate form request
        $validator = \Validator::make($request->all(), [
            'old-password' => 'required',
            'password'     => 'required|min:6|max:100|confirmed'
        ]);

        // throw if error
        if($validator->fails()){
            return back()
                ->withErrors($validator, $action)
                ->withInput();
        }

        // update password on user
        $user->fill([
            'password' => \Hash::make($request->password)
        ]);

        if($user->save()){
            return back()->with($action.'-success', 'Password has been updated');
        }

        return back()->with($action.'-error', 'Password not updated');
    }
}
