<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Binar extends Model
{
    protected $fillable = [
        'parent_id',
        'position',
        'level',
        'path'
    ];

    const LEFT = 1;
    const RIGHT = 2;

}
