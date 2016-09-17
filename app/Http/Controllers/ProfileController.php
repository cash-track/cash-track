<?php

namespace App\Http\Controllers;

use App\Models\Balance;

class ProfileController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

	/**
	 * Show the application dashboard
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$balances = Balance::all();
		return view('profile.dashboard', compact('balances'));
	}
}
