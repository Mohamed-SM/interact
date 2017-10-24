<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('code');
            $table->integer('group_moduls_id');
            $table->integer('credits');
            $table->integer('coefficient');
            $table->integer('time_course')->unsigned()->nullable();
            $table->integer('time_td')->unsigned()->nullable();
            $table->integer('time_tp')->unsigned()->nullable();
            $table->boolean('controle');
            $table->boolean('exame');
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
        Schema::dropIfExists('modules');
    }
}
