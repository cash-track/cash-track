<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Balance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class BalanceController
 *
 * @package App\Http\Controllers
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
    public function create()
    {
        return view('balance.new');
    }

    /**
     * Store a newly created balance in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
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
			    Auth::user()->balances()->where('is_active', 1)
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
		    Auth::user()->balances()->attach($balance);

		    return redirect()->route('balance.show', $balance->id);
	    }else{
	    	return back()->with('fail', 'Cannot create balance');
	    }
    }

    /**
     * Display the specified balance.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
		$balance = Balance::findOrFail($id);

	    // balance can see only attached user
	    if(!$balance->hasUser(Auth::user()))
	    	return redirect(route('dashboard'));

	    return view('balance.show', compact('balance'));
    }

    /**
     * Show the form for editing the specified balance.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
    	$balance = Balance::findOrFail($id);

        return view('balance.edit', compact('balance'));
    }

    /**
     * Update the specified balance in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
    	// get balance instance
    	$balance = Balance::findOrFail($id);

	    // update balance fields
		$balance->amount = $request->get('amount');
	    switch($request->get('type')){
		    case '1':
			    // Balance actives
			    $balance->is_active = true;
			    break;
		    case '2':
			    // only this balance active
			    $balance->is_active = true;
			    Auth::user()->balances()->where('is_active', 1)
			        ->update(['is_active'=>0]);
			    break;
		    case '3':
			    // balance not active
			    $balance->is_active = false;
			    break;
	    }

	    // save balance
	    if($balance->save()){
		    return redirect()->route('balance.show', $balance->id)->with('success', 'Balance updated');
	    }else{
		    return back()->with('fail', 'Cannot update balance or data not changed.');
	    }
    }

	/**
	 * Activate specified balance
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
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
	 * Disactivate specified balance
	 *
	 * @param Request $request
	 * @param int $id
	 * @return RedirectResponse
	 */
	public function disactivate(Request $request, $id)
	{
		$balance = Balance::findOrFail($id);
		$balance->is_active = false;
		$balance->save();

		return back()->with('success', 'Balance disactivated');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
