<?php

namespace App\Http\Controllers;

use App\dokter;
use App\jenis_kelamin;
use App\tipe_dokter;
use DB;
use Exception;
use Illuminate\Http\Request;

class crud_dokter extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_kelamins = jenis_kelamin::all();
        $dokters = dokter::all();
        return view('dokter')->with([
            'dokters' => $dokters,
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
        //dd($request->all());
        $this->validate($request,[
            'nama' => 'string|min:3|max:240|required',
            'tipe_dokter' => 'string|min:1|max:240|required',
            'jenis_kelamin' => 'integer|exists:jenis_kelamins,id|required'
        ]);
        try{
            $tipe_dokter_small= strtolower($request->tipe_dokter);
            $tipe_dokter = tipe_dokter::firstOrCreate(
                ['tp_dokter' => $tipe_dokter_small]
            );
            $dokter = dokter::create([
                'nama' => $request->nama,
                'id_tipe_dokter' => $tipe_dokter->id,
                'id_jenis_kelamin' =>$request->jenis_kelamin
            ]);
            return back()->with('sukses','dokter berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
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
        //dd($request->all());
        $this->validate($request,[
            'nama' => 'string|min:3|max:240|required',
            'tipe_dokter' => 'string|min:1|max:240|required',
            'jenis_kelamin' => 'integer|exists:jenis_kelamins,id|required'
        ]);
        try{
            $tipe_dokter_small= strtolower($request->tipe_dokter);
            $tipe_dokter = tipe_dokter::firstOrCreate(
                ['tp_dokter' => $tipe_dokter_small]
            );
            $dokter = dokter::find($id)->update([
                'nama' => $request->nama,
                'id_tipe_dokter' => $tipe_dokter->id,
                'id_jenis_kelamin' => $request->jenis_kelamin
            ]);
            return back()->with('sukses','data dokter berhasil di update/edit');
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
        $dokter = dokter::find($id)->delete();
        return back()->with('sukses','data dokter berhasil di hapus');
    }

    public function tipe_dokter(){
        $tipe_dokters = tipe_dokter::all();
        return view('tipedokter')->with([
            'tipe_dokters' => $tipe_dokters
        ]);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTipe($id)
    {
        $tipe = tipe_dokter::find($id)->delete();
        return back()->with('sukses','data dokter berhasil di hapus');
    }
}
