<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table product gallery
        Schema::create('gallery_image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link')->nullable();
            $table->string('name')->nullable();
            $table->integer('sort_order')->default(0);
            $table->integer('gallery_id')->unsigned();
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
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
        //
        Schema::dropIfExists('gallery_image');
    }
}
