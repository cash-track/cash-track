<?php

namespace App\Http\Controllers;

use App\Models\Trans;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\View\View;

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

    	return view('profile.index', compact('user', 'credited', 'debited'));
    }
}
