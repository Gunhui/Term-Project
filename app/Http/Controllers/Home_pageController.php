<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Home_pageController extends Controller
{
    public function index()
    {
    
        $user = Auth::user()['name'];
        $master = DB::table('users')->where('email', Auth::user()['email'])->value('master');
        
        return view('board.home', ['user' => $user, 'master' => $master]);
    }
}
