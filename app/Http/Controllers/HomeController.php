<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application homepage.
     *
     * @return View
     */
    public function index() :View
    {
        return view('homepage');
    }

    /**
     * Display help page
     *
     * @return View
     */
    public function help() :View
    {
        return view('help');
    }

    /**
     * Display about us page
     *
     * @return View
     */
    public function about() :View
    {
        return view('about');
    }
}
