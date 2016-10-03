<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BalanceController extends Controller
{
	/**
	 * @var User
	 */
	protected $user;

	/**
	 * BalanceController constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->user = Auth::user();
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('balance.new');
    }

    /**
     * Store a newly created balance in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    // create balance instance
	    $balance = new Balance();

	    // fill balance fields
	    $balance->amount = $request->get('amount');
	    switch($request->get('type')){
		    case '1':
		    	// Balance active
		    	$balance->is_active = true;
		    	break;
		    case '2':
		    	// only this balance active
			    $balance->is_active = true;
				$this->user->balances()->where('is_active', 1)
					->update(['is_active'=>0]);
		    	break;
		    case '3':
		    	// balance not active
		    	$balance->is_active = false;
		    	break;
	    }

	    // save balance
	    if($balance->save()){

	    	// attach balance to user
	    	$this->user->balances()->attach($balance);

		    return redirect()->route('balance.show', $balance->id);
	    }else{
	    	return back()->with('fail', 'Cannot create balance');
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
		$balance = Balance::findOrFail($id);

	    // balance can see only attached user
	    if(!$balance->hasUser($this->user))
	    	return redirect(route('dashboard'));

	    return view('balance.show', compact('balance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
