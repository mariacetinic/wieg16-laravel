<?php
/*
 * Skapa en migrations fil för vardera tabell
 * Ta den tabellstruktur som ni gjort tidigare och skriv in den som migrationer i Laravel.
 * Skapa funktion och lägga in för att sedan hämta funktionen som hämtar data via cURL från https://www.milletech.se/invoicing/export/customers.
 * Efter att du har gjort färdigt dina migrationer och testat dem så skriver du ett artisankommando för att importera kunderna.
 *
 * */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

function get_webpage($url) {
    $ch = curl_init($url);

    //$fp = fopen("customers.json", "w");
    //curl_setopt($ch, CURLOPT_FILE, $fp);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
$json = json_decode(get_webpage("https://www.milletech.se/invoicing/export/customers"), true);


class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender');
            $table->string('customer_activated');
            $table->string('group_id');
            $table->string('customer_company');
            $table->string('default_billing');
            $table->string('default_shipping');
            $table->string('is_active');
            $table->string('	created_at');
            $table->string('	updated_at');
            $table->string('customer_invoice_email');
            $table->string('customer_extra_text');
            $table->string('customer_due_date_period');
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
        Schema::dropIfExists('customer');
    }
}
