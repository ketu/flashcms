<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       //create product table
       Schema::create('blog', function (Blueprint $table) {
        $table->increments('id');
        $table->string('slug')->unique();
        $table->string('thumb')->nullable();
        $table->boolean('status')->default(true);
        $table->timestamps();
    });

    Schema::create('blog_translations', function(Blueprint $table)
    {
        $table->increments('id');
        $table->integer('blog_id')->unsigned();
        $table->string('name');
        $table->longText('description');
        $table->string('locale')->index();
        $table->unique(['blog_id','locale']);
        $table->foreign('blog_id')->references('id')->on('blog')->onDelete('cascade');
    });
           //create table category product idx
           Schema::create('blog_category_relation', function (Blueprint $table) {
            $table->integer('blog_id')->unsigned()->foreign('blog_id')->references('id')->on('blog')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->foreign('category_id')->references('id')->on('blog_category')->onDelete('cascade');
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
    }
}
