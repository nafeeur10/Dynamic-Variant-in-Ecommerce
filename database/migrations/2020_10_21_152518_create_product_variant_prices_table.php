<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variant_prices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_variant_one');
            $table->unsignedBigInteger('product_variant_two');
            $table->unsignedBigInteger('product_variant_three');

            $table->double('price');
            $table->integer('stock');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products'); // foreign key relationship with products table

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
        Schema::dropIfExists('product_variant_prices');
    }
}
