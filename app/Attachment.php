<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Board;

class Attachment extends Model
{
    //
    protected $fillable = ['board_id', 'filename', 'bytes', 'mime'];

    public function board() {
    	return $this->belongsTo(Board::class);
    }

    public function getUrlAttribute() {
    	return url('files/'. \Auth::user()->id . '/' . $this->filename);
    }

   function deleteAttachedFile($filename) {
        $path = public_path('files') . DIRECTORY_SEPARATOR .  \Auth::user()->id  . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
   }

}