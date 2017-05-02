<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'      => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'nick'      => str_slug($request->get('nick')),
            'email'     => $request->get('email'),
            'password'  => bcrypt($request->get('password')),
        ]);

        event(new Registered($user));

        $this->guard()->login($user);

        return redirect()->route('dashboard');
    }
}
