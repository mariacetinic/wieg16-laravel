<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingAddressesIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses_id', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('customer_id',false,true)->nullable();
            $table->bigInteger('customer_address_id',false,true)->nullable();
            $table->string('email')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('postcode')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('telephone')->nullable();
            $table->string('country_id')->nullable();
            $table->string('address_type')->nullable();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_addresses_id');
    }
}
