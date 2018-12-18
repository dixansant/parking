<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class LoginController extends Controller
{
    /**
     * Show the application login.
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */

    use AuthenticatesUsers;


    public function loginAction(Request $request)
    {
        if (Auth::check()){
            return view('success.start', ['logued'=>true]);
        }else {

            return view('auth.login', ['forward'=>$request->path()]);
        }
    }


    public function loginDialogAction(Request $request)
    {
        if (Auth::check()){
            //die();
            return view('success.start');
        }else {
            return view('auth.login');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * ROUTE: home/reguser
     */

    public function registerAction()
    {
        if (Auth::check()){

        } else
        return view('auth.register02', [
            'action' => 'register',
            'user' => new User
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * ROUTE: home/edituser
     */



    public function resetAction()
    {
        if (Auth::check()){

        } else
        return view('auth.passwords.reset');
    }




    public function mail()
    {
        $name = 'TEST';
        Mail::to('dixan.sant@gmail.com')->send(new SendMailable($name));

        die('OK');
        return true;
    }

}
