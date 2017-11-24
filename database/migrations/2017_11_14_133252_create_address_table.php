<?php
/*
 * Skapa en migrations fil för vardera tabell
 * Ta den tabellstruktur som ni gjort tidigare och skriv in den som migrationer i Laravel.
 * Hämta data via cURL från https://www.milletech.se/invoicing/export/customers.
 * Testa dina migrationer och sedan skriver du ett artisankommando för att importera kunderna.
 *
 * */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->bigInteger('customer_id', false, true);
            $table->string('customer_address_id')->nullable();
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
