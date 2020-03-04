<?php

namespace App\Http\Controllers;

use App\dokter;
use App\pasien;
use Illuminate\Http\Request;
use App\riwayat_pasien;
use App\rawat_inap;
use App\status_pengobatan;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class crud_riwayat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasienns = pasien::all();
        $statuss = status_pengobatan::all();
        $dokters = dokter::all();
        $riwayat_pasiens = riwayat_pasien::all();
        $rawat_inaps = rawat_inap::all();
        return view('dashboard')->with([
            'riwayat_pasiens' => $riwayat_pasiens,
            'rawat_inaps' => $rawat_inaps,
            'dokters' => $dokters,
            'statuss' => $statuss,
            'no_kamar' => '',
            'pasienns' => $pasienns
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'pasien' => 'integer|exists:pasiens,id|required',
            'dokter' => 'integer|exists:dokters,id|required',
            'penyakit' => 'string|min:1|max:225|required',
            'status' => 'integer|exists:status_pengobatans,id|required',
        ]);
        try{
            $status = $request->status;
            $status = status_pengobatan::where('id',$status)->first()->status;
            if($status == 'rawat inap' && ($request->kamar == null || $request->perawat == null)){
                return back()->with('error','silahkan masukan no kamar dan perawat jika ingin menginap');
            };
            if($status == 'rawat inap'){
                $id_rawat_inap = rawat_inap::firstOrCreate([
                    'no_kamar' => $request->kamar,
                ]);
                $id_rawat_inap->update([
                    'id_perawat' => $request->perawat
                ]);
                $riwayat_pasien = riwayat_pasien::create([
                    'id_pasien' => $request->pasien,
                    'id_dokter' => $request->dokter,
                    'id_status_pengobatan' => $request->status,
                    'diagnosa_penyakit' => $request->penyakit,
                    'id_rawat_inap' => $id_rawat_inap->id
                ]);
            return back()->with('sukses','riwayat pasien sudah di tambahkan');
            }else{
                $riwayat_pasien = riwayat_pasien::create([
                    'id_pasien' => $request->pasien,
                    'id_dokter' => $request->dokter,
                    'id_status_pengobatan' => $request->status,
                    'diagnosa_penyakit' => $request->penyakit,
                    'id_rawat_inap' => null
                ]);
                return back()->with('sukses','riwayat pasien sudah di tambahkan');
            }
        }catch(Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('aassa');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'string|min:1|max:40|required',
            'dokter' => 'integer|exists:dokters,id|required',
            'penyakit' => 'string|min:1|max:225|required',
            'status' => 'integer|exists:status_pengobatans,id|required',
        ]);
        //dd($request->all());
        try {
            $status = $request->status;
            $status = status_pengobatan::where('id',$status)->first()->status;
            if($status == 'rawat inap' && ($request->kamar == null || $request->perawat == null)){
                return back()->with('error','silahkan masukan no kamar dan perawat jika ingin menginap');
            };
            if($status == 'rawat inap'){
                $rawat_inap = rawat_inap::firstOrCreate([
                'no_kamar' => $request->kamar,
                ]);
                $rawat_inap->update([
                    'id_perawat' => $request->perawat
                ]);
                $pasienn = riwayat_pasien::find($id)->pasiens()->first()->update([
                    'nama' => $request->nama,
                ]);
                $riwayat_pasiens = riwayat_pasien::find($id)->update([
                    'id_rawat_inap' => $rawat_inap->id,
                    'diagnosa_penyakit' => $request->penyakit,
                    'id_dokter' => $request->dokter,
                    'id_status_pengobatan' => $request->status
                ]);
            return back()->with('sukses','riwayat pasien telah diperbarui');
            }else{
                $pasienn = riwayat_pasien::find($id)->pasiens()->first()->update([
                    'nama' => $request->nama,
                ]);
                $riwayat_pasiens = riwayat_pasien::find($id)->update([
                    'diagnosa_penyakit' => $request->penyakit,
                    'id_dokter' => $request->dokter,
                    'id_status_pengobatan' => $request->status,
                    'id_rawat_inap' => null
                ]);
                return back()->witth('sukses','riwayat pasien telah diperbarui');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $riwayat_pasien = riwayat_pasien::find($id)->delete();
        return back()->with('sukses' ,'riwayat pasien sudah di hapus');
    }

    public function select_kamar(Request $request){
        $this->select_perawat($request);
    }
    public function select_perawat(Request $request){
        $dokter = $request->id;
        $datas = dokter::where('id',$dokter)->first()->perawats()->get();
        $output = '<option value="">--pilih--</option>';
        foreach($datas as $data){
            $output .= '<option value="' . $data->id . '">' . $data->nama.'</option>';
        }
        echo $output;
    }
}
