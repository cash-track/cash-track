<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\{
    Request, RedirectResponse
};

class ProfileController extends Controller
{
    use ProfileSettingUpdateHandlers;

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
            ->orderBy('updated_at', 'DESC')
            ->paginate(3);

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
                // general options section
                switch($action){
                    case 'update-profile-info':
                        return $this->updateProfileInfo($request, $user, $action);
                }
                break;
            case 'notification':
                //
                break;
            case 'access':
                // access options section
                switch($action){
                    case 'update-password':
                        return $this->updatePassword($request, $user, $action);
                }
                break;
        }

        return back()->with(
            'error',
            'Possible XSS attack detected. Unexpected form action'
        );
    }


}
