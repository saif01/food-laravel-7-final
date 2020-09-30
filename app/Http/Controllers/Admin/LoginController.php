<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;


class LoginController extends Controller
{
    //Admin login page
    public function Index(){
        return view('admin.login.index');
    }



    //Admin Login action
    public function LoginAction(Request $request){

        request()->validate([
            'login' => 'required|max:20',
            'password' => 'required|max:20',
        ]);


        $credentials = [ 'login' => $request->login, 'password' =>$request->password ];

        //dd($credentials );

        // Authentication check...
        if ( Auth::attempt($credentials) ) {


            return redirect()->route('admin.dashboard');


        }else{


            $notification = array(
                'loginErrorMsg' => 'You have entered invalid credentials',
            );

           // return redirect('form')->withInput();
           return redirect()->route("admin.login")->with($notification)->withInput();
        }

    }

    //Admin Logout
    public function Logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');

    }




}
