<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_prices', function (Blueprint $table) {
            $table->bigInteger('group_id', false, true);
            $table->decimal('price', 12, 4);
            $table->bigInteger('price_id', false, true)->primary();
            $table->timestamps(); //lägger till created_at och updated_at
            $table->bigInteger('product_id', false, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_prices');
    }
}
