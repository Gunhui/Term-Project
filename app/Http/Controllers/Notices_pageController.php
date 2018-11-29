<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notices;
use App\Notice_record;

class Notices_pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()['name'];
        $master = DB::table('users')->where('email', Auth::user()['email'])->value('master');
        $order = 'desc';

        $notices = DB::table('notices')->orderBy('master',$order)->paginate(7);  
        $my_point = DB::table('donations')->where('user_id', Auth::user()['name'])->sum('point');   
        $all_point = DB::table('donations')->sum('point');
        $point_list = DB::table('donations')->select(DB::raw('user_id, sum(point) as points'))->groupBy('user_id')->orderBy('points', 'desc')->get();
        
        return view('board.notices', ['point_list' => $point_list ,'user' => $user, 'master' => $master, 'notices' => $notices, 'my_point' => $my_point, 'all_point' => $all_point]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()['name'];
        return view('form.record_form')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $target = Notices::find($id);
        $contents = DB::table('notices')->where('id', $id)->get();
        $hit = DB::table('notices')->where('id', $id)->value('hits');
        $notice = Notices::find($id);
        $all_point = DB::table('donations')->sum('point');

        if(!DB::table('notice_records')->where('user_id', Auth::user()['name'])->where('num', $id)->value('user_id')){
            $response = Notice_record::create([
                'user_id' => Auth::user()['name'],
                'num' => $id,
            ]);

            $notice->hits = $hit + 1;
            $notice->save();
        }

        return view('view.notices_view')->with('target', $target)
                                      ->with('contents', $contents)
                                      ->with('all_point', $all_point);          
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
