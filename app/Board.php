<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Attachment;
use App\User;


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

    public function user() {

    	return $this->belongsTo(User::class);

    }



    public function attachments() {

    	return $this->hasMany(Attachment::class);

    }
    
  
    /*              
        example
            $query = \App\Board::query();
            $query->where('document_srl', '=', '$args->document_srl);
    */

  
}
