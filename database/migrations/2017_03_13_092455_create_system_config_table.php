<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create table system_config
        Schema::create('system_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->text('value')->nullable();
            $table->string('group');
            $table->unique(['path', 'group']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop table system_config
        Schema::dropIfExists('system_config');
    }
}
