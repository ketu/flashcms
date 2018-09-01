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
            $table->integer('parent_id')->nullable();
            $table->integer('lft');
            $table->integer('rgt');
            $table->integer('depth')->nullable();
            $table->string('group_name');
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('menu_item_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['item_id','locale']);
            $table->foreign('item_id')->references('id')->on('menu_item')->onDelete('cascade');
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
