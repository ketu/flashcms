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
            $table->decimal('price', 12, 2);
            $table->decimal('weight', 10, 2);
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->integer('template_id')->unsigned();
            $table->foreign('template_id')->references('id')->on('product_template');
            $table->boolean('status')->default(true);
            $table->timestamps();
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
        Schema::dropIfExists('product_translations');

    }
}
