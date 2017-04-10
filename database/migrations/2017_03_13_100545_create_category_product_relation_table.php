<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table category product idx
        Schema::create('category_product_relation', function (Blueprint $table) {
            $table->integer('product_id')->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->integer('category_id')->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop table category product idx
        Schema::dropIfExists('category_product_relation');
    }
}
