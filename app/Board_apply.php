<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board_apply extends Model
{
    protected $table = "board_applies";

    protected $fillable = [
        'user_id',
        'applied_id',
    ];
}
