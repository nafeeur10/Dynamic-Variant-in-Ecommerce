<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();

            $table->string('variant');

            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants'); // foreign key relationship with variants table

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
        Schema::dropIfExists('product_variants');
    }
}
