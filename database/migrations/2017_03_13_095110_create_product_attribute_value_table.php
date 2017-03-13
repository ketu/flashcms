<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table product attribute value
        Schema::create('product_attribute_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_option_id')->foreign('attribute_option_id')->references('id')->on('attribute_option')->onDelete('cascade');
            $table->integer('product_id')->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
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
        //drop table product attribute value
    }
}
