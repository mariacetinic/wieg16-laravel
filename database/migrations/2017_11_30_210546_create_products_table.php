<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('entity_id', false, true)->primary();
            $table->string('entity_type_id')->nullable();
            $table->string('attribute_set_id')->nullable();
            $table->string('type_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('has_options')->nullable();
            $table->string('required_options')->nullable();
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('status')->nullable();
            $table->string('name')->nullable();
            $table->string('amount_package')->nullable();
            $table->string('price')->nullable();
            $table->string('is_salable')->nullable();
            $table->string('stock_item')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
