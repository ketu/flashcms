<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create table cms_block
        Schema::create('cms_block', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->integer('first_create_user')->unsigned()->foreign('first_create_user')->references('id')->on('users');
            $table->integer('last_update_user')->unsigned()->nullable(true)->foreign('last_update_user')->references
            ('id')->on
            ('users');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            //$table->softDeletes();
        });

        Schema::create('cms_block_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('block_id')->unsigned();
            $table->string('name');
            $table->text('content');
            $table->string('locale')->index();
            $table->unique(['block_id','locale']);
            $table->foreign('block_id')->references('id')->on('cms_block')->onDelete('cascade');
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

        Schema::dropIfExists('cms_block');
        Schema::dropIfExists('cms_block_translations');


    }
}
