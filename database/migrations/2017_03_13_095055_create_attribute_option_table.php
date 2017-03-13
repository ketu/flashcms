<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table attribute
        Schema::create('attribute_option', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
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
        //drop table attribute
        Schema::dropIfExists('attribute_option');
    }
}
