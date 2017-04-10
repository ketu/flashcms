<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table product attribute
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value')->nullable();
            $table->boolean('is_option_value')->default(false);
            //$table->integer('product_id')->foreign('product_id')->references('id')->on('product')->onDelete
            //('cascade');
            $table->integer('attribute_id')->foreign('attribute_id')->references('id')->on('attribute')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop table product attribute
        Schema::dropIfExists('product_attribute');
    }
}
