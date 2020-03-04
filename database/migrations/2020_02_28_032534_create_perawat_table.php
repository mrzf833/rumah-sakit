<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerawatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perawats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama',255);
            $table->integer('id_dokter')->unsigned()->index()->nullable();
            $table->integer('id_jenis_kelamin')->unsigned()->index();
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
        Schema::dropIfExists('perawats');
    }
}
