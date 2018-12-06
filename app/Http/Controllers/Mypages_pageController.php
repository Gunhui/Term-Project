<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Board;
use App\User;

class Mypages_pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()['name'];
        // $master = Auth::user()['master'];

        $users = DB::table('users')->get();
        $master = DB::table('users')->where('email', Auth::user()['email'])->value('master');
        $all_point = DB::table('donations')->sum('point');
        
        $contents = DB::table('boards')->where('writer', $user)->get();
        $notices = DB::table('notices')->where('writer', $user)->get();
        $applied = DB::table('board_applies')->where('user_id', $user)->get();
        $my_point = DB::table('donations')->where('user_id', Auth::user()['name'])->sum('point');
        $point_list = DB::table('donations')->select(DB::raw('user_id, sum(point) as points'))->groupBy('user_id')->orderBy('points', 'desc')->get();

        $lists = array();
        $count = 0;
        
        foreach($applied as $apply){
            // $lists[$count] = DB::table('boards')->where('id', $apply->applied_id)->get();
            $lists[$count] = Board::where('id', $apply->applied_id)->first();
            $count++;
        }
        
        $is_empty = DB::table('notices')->where('writer', $user)->value('id');
        if(!$is_empty){
            $notices = 'empty';
        }       

        return view('board.mypage', ['point_list' => $point_list ,'my_point' => $my_point ,'all_point' => $all_point ,'master' => $master, 'users' => $users, 'contents' => $contents, 'notices' => $notices, 'lists' => $lists]);
    }

    public function manage()
    {
        $user = Auth::user()['name'];
        $master = Auth::user()['master'];

        $users = DB::table('users')->get();
        $all_point = DB::table('donations')->sum('point');
        $my_point = DB::table('donations')->where('user_id', Auth::user()['name'])->sum('point');
        $point_list = DB::table('donations')->select(DB::raw('user_id, sum(point) as points'))->groupBy('user_id')->orderBy('points', 'desc')->get();

        return view('board.manage', ['master' => $master ,'point_list' => $point_list ,'my_point' => $my_point ,'all_point' => $all_point ,'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $name = $request->name;
        $value = $request->val;
        $boards_id = $request->boards;
        for($i=0; $i<count($name); $i++){
            if($value[$i] == null) {
                $value[$i] = 1;
            }
            $user = User::where('name', $name[$i])->first();
            $boards = Board::where('id', $boards_id[$i])->first();
            $point = DB::table('users')->where('name', $name[$i])->value('point');
            $user->point = $point + $value[$i];
            $boards->give_point = 1;
            $user->save();
            $boards->save();
        }
        return redirect()->route('board.mypage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
