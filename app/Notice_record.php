<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice_record extends Model
{
    protected $table = "notice_records";

    protected $fillable = [
        'user_id',
        'num',
    ];
}