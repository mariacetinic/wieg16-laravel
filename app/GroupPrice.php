<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupPrice extends Model
{

    ////Primary antas vara id
    protected $primaryKey = 'price_id';
    protected $table = 'products';
    public $incrementing = false;
    public $timestamps = false;

    // Om ni istället vill vitlista kolumner
    protected $fillable = [
        'price',
        'group_id',
        'price_id',
        'product_id',
];

//som t.ex privat eller företagskund får jag ett pris
//GroupPrice has one group
    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
//customer är inte med för den har ingen direkt länk
}
