<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Validator;
use App\Attachment;
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
        // $response = Board::create([
        //     'content_title' => $request->content_title,
        //     'content' => $request->content,
        //     'content_loc' => $request->content_loc,
        //     'execute_date' => $request->execute_date,
        //     'writer' => Auth::user()['name'],
        //     'lat' => $request->lat,
        //     'lng' => $request->lng,
        // ]);

        $board = new Board();
        $board->content_title = $request->content_title;
        $board->content = $request->content;
        $board->content_loc = $request->content_loc;
        $board->execute_date = $request->execute_date;
        $board->writer = Auth::user()['name'];
        $board->lat = $request->lat;
        $board->lng = $request->lng;
        $board->save();
        
        if($request->has('attachments')){
            foreach($request->attachments as $aid){
                $attach = Attachment::find($aid);
                $attach->board_id = $board->id;
                $attach->save();
            }
        }

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
        $board = Board::find($request->id);
        $board->content_title = $request->content_title;
        $board->content = $request->content;
        $board->content_loc = $request->content_loc;
        $board->execute_date = $request->execute_date;
        $board->lat = $request->lat;
        $board->lng = $request->lng;
        $board->save();

        if($request->has('attachments')){
            foreach($request->attachments as $aid){
                $attach = Attachment::find($aid);
                $attach->board_id = $board->id;
                $attach->save();
            }
        }

        if($request->has('del_attachments')) {
			foreach($request->del_attachments as $did) {
				$attach = Attachment::find($did);
				$attach->deleteAttachedFile($attach->filename);
				$attach->delete();
			}
		}  	

        // $id = $request->id;
        // $board = Board::find($id);
        // $board->update([
        //     'content_title' => $request->content_title,
        //     'content' => $request->content,
        //     'content_loc' => $request->content_loc,
        // ]);
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
