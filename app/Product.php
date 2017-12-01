<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    ////Primary antas vara id
    //protected $primaryKey = "id";
    public $incrementing = false;
    public $timestamps = false;

    // Om ni istället vill vitlista kolumner
    protected $fillable = [
        'entity_id',
        'entity_type_id',
        'attribute_set_id',
        'type_id',
        'sku',
        'has_options',
        'required_options',
        'created_at',
        'updated_at',
        'status',
        'name',
        'amount_package',
        'price',
        'is_salable',
        'stock_item'
    ];

    public function groupPrice(){
        return $this->hasMany(GroupPrice::class);
    }

}


