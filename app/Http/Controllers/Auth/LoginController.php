<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

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
    protected $redirectTo = '/painel/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authenticate($email,$pwd){ 
        \Hash::make(sha1($pwd));
        $auth = \Auth::attempt(['email' => $email, 'password' => $pwd], true);

        if($auth){
            return \Response::json([
                'Authenticated'
            ], 200);
            dd();
        }else{
            return \Response::json([
                'No granted'
            ], 403);
            dd();
        }
    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
