<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use input;
use App\Board;
use App\User;
use App\Board_record;

class Board_pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()['name'];
        $img = Auth::user()['user_image'];
        $master = DB::table('users')->where('email', Auth::user()['email'])->value('master');

        $boards = DB::table('boards')->orderBy('execute_date', 'desc')->paginate(6);

        // $apply_count = DB::table('board_applies')
        //                 ->join('boards', 'id', '=', 'boards.id')
        //                 ->join('');
        
        return view('board.board', ['user' => $user, 'master' => $master, 'img' => $img, 'boards' => $boards]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()['name'];
        return view('form.write_form')->with('user', $user);
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
        $target = Board::find($id);
        $contents = DB::table('boards')->where('id', $id)->get();
        $hit = DB::table('boards')->where('id', $id)->value('hits');
        $board = Board::find($id);
        $count = DB::table('board_applies')->where('applied_id', $id)->count();

        if(!Auth::Check()){
            return redirect()->route('board.board');
        }

        if(!DB::table('board_records')->where('user_id', Auth::user()['name'])->where('num', $id)->value('user_id')){
            $response = Board_record::create([
               'user_id' => Auth::user()['name'],
                'num' => $id,
            ]);

            $board->hits = $hit + 1;
            $board->save();
        }

        return view('view.board_view')->with('target', $target)
                                      ->with('contents', $contents)
                                      ->with('count', $count);
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
    public function update($id)
    {
        
        return view('form.modify_form');
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

    public function search(Request $request)
    {
        $user = Auth::user()['name'];
        $img = Auth::user()['user_image'];
        $master = DB::table('users')->where('email', Auth::user()['email'])->value('master');

        $column = $request->menu;
        $value = $request->search_content;
        $contents = DB::table('boards')->where($column, $value)->paginate(6);

        if($column && $value && $contents){
            return view('board.board', ['user' => $user, 'master' => $master, 'img' => $img, 'boards' => $contents]);
        }else{
            return redirect()->route('board.board');
        }
    }


    public function distance(Request $request)
    {
        
        
        $contents = DB::table('boards')->get();
        $min = 0;
        $list = array();
        $count = 0;
        $id;

        // $contents = DB::table('boards')
        //             ->select(array(DB::raw('myfunction() as mm'), 'boards.*'))
        //             ->orderBy('mm')->get();


        $contents = $contents->sortBy(function($r, $k) use($request){
            $lat1 = $r->lat;
            $lng1 = $r->lng;

            $lat2 = $request->lat;
            $lng2 = $request->lng;

            $earth_radius = 6371;
            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lng2 - $lng1);
            $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
            $c = 2 * asin(sqrt($a));
            $distance = $earth_radius * $c;
            return $distance;
        });

        foreach($contents as $content){
            $lat1 = $content->lat;
            $lng1 = $content->lng;
            $lat2 = $request->lat;
            $lng2 = $request->lng;

            $earth_radius = 6371;
            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lng2 - $lng1);
            $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
            $c = 2 * asin(sqrt($a));
            $distance = $earth_radius * $c;
            
            $list[$count][0] = $distance;
            $list[$count][1] = $content->id;
            $count++;
        }
        for($i = 0; $i < count($list); $i++){
            for($j = $i+1; $j < count($list); $j++){
                if($list[$i][0] > $list[$j][0]){
                    $temp = $list[$i][0];
                    $list[$i][0] = $list[$j][0];
                    $list[$j][0] = $temp;
                }
            }
        }

        $user = Auth::user()['name'];                                                        
        $img = Auth::user()['user_image'];
        $master = DB::table('users')->where('email', Auth::user()['email'])->value('master');        
 
        $recommended = array();
        for($i = 0; $i < count($list); $i++){
            $rcm = Board::where('id', $list[$i][1])->first();
            $recommended[$i] = $rcm; 
        }        

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($recommended);
 
        // Define how many items we want to be visible in each page
        $perPage = 6;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());

       // return view('board.board', ['user' => $user, 'master' => $master, 'img' => $img, 'boards' => $boards, 'recommended' => $recommended]);
       return view('board.board', ['user' => $user, 'master' => $master, 'img' => $img, 'boards' => $paginatedItems]);
    }
}
