<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
    protected $table = "notices";

    protected $fillable = [
        'content_title',
        'content',
        'writer',
        'hits',
        'regtime',
        'master',
    ];

    public function select()
    {
        $notices = App\Notices::all();
    }
}
