<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table product gallery
        Schema::create('menu_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });


        Schema::create('menu_item_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('menu_item_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['menu_item_id','locale']);
            $table->foreign('menu_item_id')->references('id')->on('menu_item')->onDelete('cascade');
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
        Schema::dropIfExists('menu_item');
        Schema::dropIfExists('menu_item_translations');

    }
}
