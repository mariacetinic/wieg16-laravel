<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'id',
        'amount_package',
        'created_at',
        'item_id',
        'name',
        'order_id',
        'price',
        'price_incl_tax',
        'qty',
        'row_total',
        'sku',
        'tax_amount',
        'tax_percent',
        'total_incl_tax',
        'updated_at',
        'marking'
    ];
}
