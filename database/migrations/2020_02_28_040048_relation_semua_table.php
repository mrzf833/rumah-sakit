<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationSemuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokters', function (Blueprint $table) {
            $table->foreign('id_tipe_dokter')->references('id')->on('tipe_dokters')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_jenis_kelamin')->references('id')->on('jenis_kelamins')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('riwayat_pasiens', function (Blueprint $table) {
            $table->foreign('id_pasien')->references('id')->on('pasiens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_dokter')->references('id')->on('dokters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_status_pengobatan')->references('id')->on('status_pengobatans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_rawat_inap')->references('id')->on('rawat_inaps')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('pasiens', function (Blueprint $table) {
            $table->foreign('id_jenis_kelamin')->references('id')->on('jenis_kelamins')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('rawat_inaps', function (Blueprint $table) {
            $table->foreign('id_perawat')->references('id')->on('perawats')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('perawats', function (Blueprint $table) {
            $table->foreign('id_dokter')->references('id')->on('dokters')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_jenis_kelamin')->references('id')->on('jenis_kelamins')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokters', function (Blueprint $table) {
            //
        });
    }
}
