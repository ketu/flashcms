<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table attribute
        Schema::create('attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->boolean('status')->default(true);
            $table->string('type');
        });


        Schema::create('attribute_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->string('name');
            $table->string('value')->nullable();
            $table->string('locale')->index();
            $table->unique(['attribute_id','locale']);
            $table->foreign('attribute_id')->references('id')->on('attribute')->onDelete('cascade');
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
        Schema::dropIfExists('attribute');
        Schema::dropIfExists('attribute_translations');
    }
}
