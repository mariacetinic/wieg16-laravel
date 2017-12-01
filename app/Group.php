<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    ////Primary antas vara id
    //protected $primaryKey = "id";
    public $incrementing = false;
    public $timestamps = false;

    // Om ni istället vill vitlista kolumner
    protected $fillable = [
        'customer_group_id',
        'customer_group_code',
        'tax_class_id'
    ];



    //en grupp kan ha flera grouprices t.ex. privatkund mfl
    public function groupPrice() {
        return $this->hasMany(GroupPrice::class);
    }


    public function customer() {
        return $this->hasOne(Order::class);
    }
}
