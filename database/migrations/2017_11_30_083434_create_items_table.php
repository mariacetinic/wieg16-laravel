<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps(); //lägger till created_at och updated_at
            $table->string('amount_package')->nullable();
            $table->string('item_id')->nullable();
            $table->string('name')->nullable();
            $table->string('order_id')->nullable();
            $table->string('price')->nullable();
            $table->string('price_incl_tax')->nullable();
            $table->string('qty')->nullable();
            $table->string('row_total')->nullable();
            $table->string('sku')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('tax_percent')->nullable();
            $table->string('total_incl_tax')->nullable();
            $table->string('marking')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
