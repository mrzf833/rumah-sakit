<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pasiens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pasien')->unsigned()->index();
            $table->integer('id_dokter')->unsigned()->index();
            $table->integer('id_status_pengobatan')->unsigned()->index();
            $table->string('diagnosa_penyakit',255);
            $table->integer('id_rawat_inap')->nullable()->unsigned()->index();
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
        Schema::dropIfExists('riwayat_pasiens');
    }
}
