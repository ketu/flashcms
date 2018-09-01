<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table product gallery
        Schema::create('newsletter_subscriber', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->boolean('status')->default(true);
            $table->string('locale', 10);
            $table->unique( ['email','locale']);
            $table->timestamps();
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
        Schema::dropIfExists('newsletter_subscriber');
    }
}
