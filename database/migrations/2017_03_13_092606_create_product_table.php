<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create product table
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->string('main_image')->nullable();
            //$table->text('description')->nullable();
            $table->boolean('status')->default(true);
        });
        Schema::create('product_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['product_id','locale']);
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop product table
        Schema::dropIfExists('product');
    }
}
