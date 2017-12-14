<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramPicture extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'url'
    ];
}
