<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create table cms_page
        Schema::create('cms_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('content')->nullable(true);
            $table->integer('first_create_user')->foreign('first_create_user')->references('id')->on('users');
            $table->integer('last_update_user')->foreign('last_update_user')->references('id')->on('users');
            $table->boolean('status')->default(true);
            $table->timestamps();
            //$table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop table cms_page
        Schema::dropIfExists('cms_page');
    }
}
