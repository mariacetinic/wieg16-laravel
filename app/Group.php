<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    /*public $incrementing = false;
    public $timestamps = false;*/
    protected $primaryKey = 'customer_group_id';
    protected $table = 'groups';

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
