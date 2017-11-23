<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public function user() {
        // \App\User = User::class (fördel: vid byte av namespace av klassen behövs det inte ändras)
        return $this->belongsTo(User::class); //magiska funktioner
    }
}
