<?php

namespace App\Http\Controllers;

use Illuminate\http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{

    public function login(Request $req)
    {
        $email = $req->input('email');
        $pwd = $req->input('password');

        echo Hash::make($pwd);

        $result = Auth::attempt(['email'=>$email, 'password'=>$pwd], ture);

        if($result){
            return redirect()->intended('/');
        }else{
            return redirect()->back();
        }
    }
}