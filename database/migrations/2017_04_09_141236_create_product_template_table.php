<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table product gallery
        Schema::create('product_template', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('sort_order')->default(0);
        });
        Schema::create('product_template_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('template_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['template_id','locale']);
            $table->foreign('template_id')->references('id')->on('product_template')->onDelete('cascade');
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
        Schema::dropIfExists('product_template');
        Schema::dropIfExists('product_template_translations');
    }
}
