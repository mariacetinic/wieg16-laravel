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

class CreateAdressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id');
            $table->string('customer_address_id');
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('postcode');
            $table->string('street');
            $table->string('city');
            $table->string('telephone');
            $table->string('country_id');
            $table->string('address_type');
            $table->string('company');
            $table->string('country');
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
