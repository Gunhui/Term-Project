<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()['name'];
        $contents = DB::select('select * from notices');

        return view('board.board',['members'=>$contents,'user'=>$user]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    public function email(Request $request)
    {
        $confirmCode = str_random(5);
        $request->confirm_code = $confirmCode;
        \Mail::send('emails.auth.confirm', compact('request'), function($message) use($request){
            $message->to($request->mail);
            $message->subject('회원가입 확인');
            
        });

        return $confirmCode;
        
        // return redirect()->route('register')->with('message', '메일에 날라간 인증확인을 부탁드립니다.')
        //              ->with('mail_check', 1);
    }

    public function email_check(Request $request)
    {
        if($request->code == $request->confirmCode){
            return "ok";
        }
        return $request->code; 
    }

    public function name_check(Request $request)
    {
        
        $name = DB::table('users')->where('name', $request->name)->value('name');
        if($name){
            return "name";
        }
        
        return "no";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users)
    {
        //
    }
}
