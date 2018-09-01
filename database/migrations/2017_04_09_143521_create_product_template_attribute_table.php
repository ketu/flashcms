<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTemplateAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table category product idx
        Schema::create('product_template_attribute', function (Blueprint $table) {
            $table->integer('template_id')->foreign('template_id')->references('id')->on('product_template')->onDelete('cascade');
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
        //
        Schema::dropIfExists('product_template_attribute');
    }
}
