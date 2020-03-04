<?php

use App\jenis_kelamin;
use App\role;
use App\status_pengobatan;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        jenis_kelamin::create([
            'jns_kelamin' => 'laki-laki',
        ]);

        jenis_kelamin::create([
            'jns_kelamin' => 'perempuan',
        ]);

        role::create([
            'nama' => 'admin'
        ]);

        role::create([
            'nama' => 'dokter'
        ]);

        role::create([
            'nama' => 'perawat'
        ]);

        status_pengobatan::create([
            'status' => 'rawat jalan'
        ]);

        status_pengobatan::create([
            'status' => 'rawat inap'
        ]);

        status_pengobatan::create([
            'status' => 'selesai'
        ]);
    }
}
