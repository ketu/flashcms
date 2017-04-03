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
            $table->integer('attribute_id')->foreign('attribute_id')->references('id')->on('attribute')->onDelete('cascade');
        });


        Schema::create('attribute_option_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('option_id')->unsigned();
            $table->string('label');
            $table->string('locale')->index();
            $table->unique(['option_id','locale']);
            $table->foreign('option_id')->references('id')->on('attribute_option')->onDelete('cascade');
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
        Schema::dropIfExists('attribute_option_translations');
    }
}
