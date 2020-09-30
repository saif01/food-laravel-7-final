<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;


class LoginController extends Controller
{
    //User Login page
    public function Index(){
        return view('user.login.index');
    }

    //User Dashboard
    public function Dashboard(){
        return view('admin.dashboard.index');
    }

    //Login Action
    public function LoginAction(Request $request){

        request()->validate([
            'login' => 'required|max:20',
            'password' => 'required|max:20',
        ]);


        $credentials = [ 'login' => $request->login, 'password' =>$request->password ];

        //dd($credentials);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('home');

        }else{


            $notification = array(
                'loginErrorMsg' => 'You have entered invalid credentials',
            );

           // return redirect('form')->withInput();
           return redirect()->route("user.login")->with($notification)->withInput();
        }

    }
}
