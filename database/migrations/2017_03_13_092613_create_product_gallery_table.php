<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table product gallery
        Schema::create('product_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->integer('sort_order')->default(0);
            $table->integer('product_id')->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop table product gallery
        Schema::dropIfExists('product_gallery');
    }
}
