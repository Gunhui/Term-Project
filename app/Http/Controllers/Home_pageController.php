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
        $all_point = DB::table('donations')->sum('point');
        $my_point = DB::table('donations')->where('user_id', Auth::user()['name'])->sum('point');
        $point_all = DB::table('donations')->select(DB::raw('user_id, sum(point) as points'))->groupBy('user_id')->orderBy('points', 'desc')->get();
        $point_list = DB::table('donations')->select(DB::raw('user_id, sum(point) as points'))->groupBy('user_id')->orderBy('points', 'desc')->take(3)->get();
        
        return view('board.home', ['point_all' => $point_all , 'point_list' => $point_list ,'user' => $user, 'master' => $master, 'all_point' => $all_point, 'my_point' => $my_point]);
    }
}
