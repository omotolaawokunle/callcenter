<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    //
    protected $fillable = [
        'title', 'audio', 'contact',
    ];
}
