<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingAddressesIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_addresses_id', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('address_type')->nullable();
            $table->string('city')->nullable();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->string('country_id')->nullable();
            $table->string('customer_address_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('email')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('postcode')->nullable();
            $table->string('street')->nullable();
            $table->string('telephone')->nullable();
            $table->string('billing_address_id')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('order_id')->nullable();
            $table->string('increment_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_addresses_id');
    }
}
