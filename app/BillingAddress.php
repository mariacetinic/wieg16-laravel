<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    public $incrementing = false;
    public $timestamps = false; //fråga

    // Om ni istället vill vitlista kolumner
    protected $fillable = [
        'id',
        'address_type',
        'city',
        'company',
        'country',
        'country_id',
        'customer_address_id',
        'customer_id',
        'email',
        'firstname',
        'lastname',
        'postcode',
        'street',
        'telephone',
        'billing_address_id',
        'created_at',
        'customer_email',
        'customer_id',
        'grand_total',
        'order_id',
        'increment_id'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function order() {
        return $this->hasOne(Order::class);
    }
}
