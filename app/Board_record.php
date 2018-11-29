<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board_record extends Model
{
    protected $table = "board_records";

    protected $fillable = [
        'user_id',
        'num',
    ];

}
