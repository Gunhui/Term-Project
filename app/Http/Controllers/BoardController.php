<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Validator;
use Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('board.board');
    }  


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('board.home');
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Board::create([
            'content_title' => $request->content_title,
            'content' => $request->content,
            'content_loc' => $request->content_loc,
            'execute_date' => $request->execute_date,
            'writer' => Auth::user()['name'],
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);   

        return redirect()->route('board.board');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        $response = Board::find($board);

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contents = Board::find($id);
        return view('form.modify_form')->with('id', $id)
                                       ->with('contents', $contents);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $board = Board::find($id);
        $board->update([
            'content_title' => $request->content_title,
            'content' => $request->content,
            'content_loc' => $request->content_loc,
        ]);
        return redirect()->route('board.board'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $board = Board::find($id);
        $board->delete();

        return redirect()->route('board.board'); 
    }
}
