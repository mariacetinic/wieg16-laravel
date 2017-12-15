<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramPicture extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'id',
        'url'
    ];
}
