<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //Länka modellen till en annan tabell
    //protected $table = "my_customers";

    //Primary antas vara id
    //protected $primaryKey = "id";

    public $incrementing = false;
    public $timestamps = false; //laravel ska inte sköta timestamps, jag vill göra det själv. Vid true kommer laravel göra det automatiskt. Sätter oftast false när datan kommer från någonannastans och inte en själv

    // Om ni istället vill vitlista kolumner
    protected $fillable = [
        "email",
        "firstname",
        "lastname",
        "gender",
        "customer_activated",
        "group_id",
        "customer_company",
        "default_billing",
        "default_shipping",
        "is_active",
        "created_at",
        "updated_at",
        "customer_invoice_email",
        "customer_extra_text",
        "customer_due_date_period",
        "id",
        "company_id"
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }

}
