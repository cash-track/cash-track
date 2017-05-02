<?php

namespace App\Http\Controllers\Auth;

use Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Handle a login request to the application.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return bool
     */
    protected function attemptLogin(LoginRequest $request)
    {
        $remember = $request->has('remember');
        $login = $request->input('login');
        $password = $request->input('password');

        return $this->guard()->attempt([
            'email'     => $login,
            'password'  => $password
        ], $remember) ?: $this->guard()->attempt([
            'nick'      => $login,
            'password'  => $password
        ], $remember);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(LoginRequest $request)
    {
        return redirect()->back()
                         ->withInput($request->only('login', 'remember'))
                         ->withErrors([
                             'login' => Lang::get('auth.failed'),
                         ]);
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(LoginRequest $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        return redirect()->back()
                         ->withInput($request->only('login', 'remember'))
                         ->withErrors(['login' => $message]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(LoginRequest $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return redirect()->route('dashboard');
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(LoginRequest $request)
    {
        return Str::lower($request->input('login')).'|'.$request->ip();
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('homepage');
    }
}
