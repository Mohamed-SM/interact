<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccadimicYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accadimic_years', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->string('grade');
            $table->integer('domain_id');
            $table->integer('filier_id');
            $table->integer('spesialite_id');
            $table->integer('departement_id');
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
        Schema::dropIfExists('accadimic_years');
    }
}
