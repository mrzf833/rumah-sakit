<?php

use App\dokter;
use App\jenis_kelamin;
use App\pasien;
use App\perawat;
use App\riwayat_inap;
use App\riwayat_pasien;
use App\status_pengobatan;
use App\tipe_dokter;
use App\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {

    Route::group(['middleware' => ['adminOrDokter']], function(){
        Route::resource('/perawat', 'crud_perawat');
    });

    Route::group(['middleware' => ['dokterOrPerawat']], function(){
        Route::get('/','crud_riwayat@index');
        Route::resource('/riwayat','crud_riwayat');
    });

    Route::group(['middleware' => ['admin']], function(){
        Route::resource('/dokter', 'crud_dokter');
        Route::get('/tipe_dokter','crud_dokter@tipe_dokter')->name('dokter.tipe');
        Route::delete('/tipe_dokter/{tipe}','crud_dokter@destroyTipe')->name('destroy.tipe');
    });

    Route::group(['middleware' => ['perawat']],function(){
        Route::post('/riwayat/select_perawat','crud_riwayat@select_perawat')->name('riwayat.select_perawat');
        Route::post('/riwayat/select_kamar','crud_riwayat@select_kamar')->name('riwayat.select_kamar');
        Route::resource('/pasien', 'crud_pasien');
    });
});
