<?php

namespace App\Http\Controllers;

use App\jenis_kelamin;
use App\pasien;
use App\rawat_inap;
use App\riwayat_pasien;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class crud_pasien extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_kelamins = jenis_kelamin::all();
        $pasiens = pasien::all();
        return view('pasien')->with([
            'pasiens' => $pasiens,
            'jenis_kelamins' => $jenis_kelamins
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
            'nama' => 'string|min:3|max:240|required',
            'jns_kelamin' => 'integer|exists:jenis_kelamins,id|required',
            'alamat' => 'string|min:3|max:240|required',
            'no_hp' => 'required|digits_between:4,15|numeric'
        ]);
        try{
            $pasiens = pasien::create([
                'nama' => $request->nama,
                'alamat' =>$request->alamat,
                'no_hp' => $request->no_hp,
                'id_jenis_kelamin' => $request->jns_kelamin
            ]);
            return back()->with('sukses','pasien berhasil telah ditambahkan');
        }catch(Exception $e){
            DB::rollBack();
            back()->with('error',$e->getMessage());
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
        //
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
            'nama' => 'string|min:3|max:240|required',
            'jns_kelamin' => 'integer|exists:jenis_kelamins,id|required',
            'alamat' => 'string|min:3|max:240|required',
            'no_hp' => 'required|digits_between:4,15|numeric'
        ]);
        try{
            $pasien = pasien::find($id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'id_jenis_kelamin' => $request->jns_kelamin,
                'no_hp' => $request->no_hp
            ]);
            return back()->with('sukses','data pasien berhasil di update/edit');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
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
        $pasien = pasien::find($id)->delete();
        return back()->with('sukses','data pasien berhasil di hapus');
    }

}
