<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instagram extends Model
{
    protected $fillable = [
        'id',
        'width',
        'length',
        'url'
    ];
}
