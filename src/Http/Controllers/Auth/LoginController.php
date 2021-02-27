<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers\Auth;

use TheRealJanJanssens\Pakka\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/' . ADMIN;
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	    constructGlobVars();
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('pakka::auth.login');
    }
}