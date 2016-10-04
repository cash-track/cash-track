<?php

namespace App\Http\Controllers;

use Auth;
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
}
