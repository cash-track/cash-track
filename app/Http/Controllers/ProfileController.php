<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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
     * @return View|ViewFactory
     */
    public function index()
    {
        $balances = Auth::user()->balances()->orderBy('created_at', 'DESC')->get();

        return view('profile.dashboard', compact('balances'));
    }

	/**
	 * Display profile page
	 * Count a small statistics
	 *
	 * @return View|ViewFactory
	 */
    public function profile()
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

	    $transactions = $user->transactions()->orderBy('updated_at', 'desc')->paginate(3);

    	return view('profile.index', compact('user', 'credited', 'debited', 'active_balances', 'transactions'));
    }

	/**
	 * Display edit profile page
	 *
	 * @return View|ViewFactory
	 */
    public function setting($section = 'general')
    {
    	$user = Auth::user();

	    return view('profile.setting', compact('user', 'section'));
    }

	/**
	 * Save new profile settings
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 */
    public function update(Request $request, $section = 'general')
    {
    	$user = Auth::user();

    	return back()->with('success', 'Profile updated');
    }
}
