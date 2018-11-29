<?php

namespace App\Http\Controllers;

use App\Notices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Input;

class NoticesController extends Controller
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
        $notices = DB::table('notices')->paginate(10);
        return view('board.notices', ['user' => $user, 'master' => $master, 'notices' => $notices]);
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
        $master = DB::table('users')->where('email', Auth::user()['email'])->value('master');
        if($master == 1) {
            $response = Notices::create([
                'content_title' => $request->content_title,
                'content' => $request->content,
                'writer' => $request->writer,
                'master' => 1,
            ]);
        }else{
            $response = Notices::create([
                'content_title' => $request->content_title,
                'content' => $request->content,
                'writer' => $request->writer,
            ]);
        }

        return redirect('board/notices');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Notices  $notices
     * @return \Illuminate\Http\Response
     */
    public function show(Notices $notices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notices  $notices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contents = Notices::find($id);
        return view('form.notices_modify_form')->with('id', $id)
                                       ->with('contents', $contents);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notices  $notices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $notice = Notices::find($id);
        $notice->update([
            'content_title' => $request->content_title,
            'content' => $request->content,
        ]);
        return redirect()->route('board.notices'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notices  $notices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notices = Notices::find($id);
        $notices->delete();

        return redirect()->route('board.notices');
    }
}
