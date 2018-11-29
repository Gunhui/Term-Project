<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = "boards";

    protected $fillable = [
        'content_title',
        'content',
        'content_loc',
        'execute_date',
        'writer',
        'hit',
        'lat',
        'lng',
    ];

    public function select()
    {
        $boards = App\Board::all();
    }

    public function apply()
    {
        return $this->hasMany('App\Board_apply', 'apllied_id');
    }
    
  
    /*
        example
            $query = \App\Board::query();
            $query->where('document_srl', '=', '$args->document_srl);
    */

  
}
