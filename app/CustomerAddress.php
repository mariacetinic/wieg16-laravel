<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    //Primary antas vara id
    //protected $primaryKey = "id";
    public $incrementing = false;
    public $timestamps = false;

    // Om ni istället vill vitlista kolumner
    protected $fillable = [
        "id",
        "customer_id",
        "customer_address_id",
        "gender",
        "email",
        "firstname",
        "lastname",
        "postcode",
        "street",
        "city",
        "telephone",
        "country_id",
        "address_type",
        "company",
        "country",
    ];
}
