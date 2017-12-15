<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $primaryKey = 'id';

    // vitlista kolumner
    protected $fillable = [
        'id',
        'text'
    ];
}
