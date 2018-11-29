<?php

namespace App\Http\Controllers;

use App\Board_apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store($id)
    {   
        $user = Auth::user()['name'];
        $is_empty = DB::table('board_applies')->where('applied_id', $id)->where('user_id', $user)->value('id');
   
        if($is_empty){
            return redirect()->route('board.board')->with('Message', '이미 신청하셨습니다.');
        }else{
            $response = Board_apply::create([
                'user_id' => $user,
                'applied_id' => $id,
            ]);   

            $who = DB::table('boards')->where('id', $id)->value('writer');
            $title = DB::table('boards')->where('id', $id)->value('content_title');
            event(new \App\Events\StatusLiked($user, $who, $title));

            return redirect()->route('board.board')->with('Message', '신청에 성공하셨습니다.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board_apply  $board_apply
     * @return \Illuminate\Http\Response
     */
    public function show(Board_apply $board_apply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board_apply  $board_apply
     * @return \Illuminate\Http\Response
     */
    public function edit(Board_apply $board_apply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board_apply  $board_apply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board_apply $board_apply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board_apply  $board_apply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board_apply $board_apply)
    {
        //
    }
}
