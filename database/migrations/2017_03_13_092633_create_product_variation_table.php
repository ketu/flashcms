<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create product variation table
        Schema::create('product_variation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->unique();
            $table->string('variation_name');
            $table->string('variation_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('product_variation');
    }
}
