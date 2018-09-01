<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       //create product category table
       Schema::create('blog_category', function (Blueprint $table) {
        $table->increments('id');
        //$table->string('name');
        $table->integer('parent_id')->nullable();
        $table->integer('lft');
        $table->integer('rgt');
        $table->integer('depth')->nullable();
        $table->string('group_name');
        $table->boolean('status')->default(true);
        $table->timestamps();
    });

    Schema::create('blog_category_translations', function(Blueprint $table)
    {
        $table->increments('id');
        $table->integer('category_id')->unsigned();
        $table->string('name');
        $table->text('content');
        $table->string('locale')->index();
        $table->unique(['category_id','locale']);
        $table->foreign('category_id')->references('id')->on('blog_category')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
             //drop product categroy table
             Schema::dropIfExists('blog_category');
             Schema::dropIfExists('blog_category_translations');
    }
}
