<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/home'; // REF: 000001

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //Auth methods

    public function loginPost(Request $request)
    {


        /*var_dump($request);
        die();*/
        $this->validateLogin($request);


        /*if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }*/

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
            //return view('auth.success');
        }

        $this->incrementLoginAttempts($request);

        return view('home.startpage.login.error');

    }

    public function logout(Request $request)
    {


        $auth = Auth::check();
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view(
            'home.startpage.logout',
            [
                //'ref'=>'/home/logout',
                //'auth'=>$auth,

            ]
        );
    }




}
