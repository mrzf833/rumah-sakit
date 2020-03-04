<?php

namespace App\Http\Controllers;

use App\dokter;
use App\jenis_kelamin;
use App\perawat;
use DB;
use Exception;
use Illuminate\Http\Request;

class crud_perawat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jns_kelamins = jenis_kelamin::all();
        $dokters = dokter::all();
        $perawats = perawat::all();
        return view('perawat')->with([
            'perawats' => $perawats,
            'dokters' => $dokters,
            'jns_kelamins' => $jns_kelamins
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
            'nama' => 'string|min:3|max:225|required',
            'dokter' => 'integer|exists:dokters,id|required',
            'jenis_kelamin' => 'integer|exists:jenis_kelamins,id|required'
        ]);
        try{
            $perawat = perawat::create([
                'nama' => $request->nama,
                'id_dokter' => $request->dokter,
                'id_jenis_kelamin' => $request->jenis_kelamin
            ]);
            return back()->with('sukses','data perawat berhasil ditambahkan');
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
            'nama' => 'string|min:3|max:225|required',
            'dokter' => 'integer|exists:dokters,id|required',
            'jenis_kelamin' => 'integer|exists:jenis_kelamins,id|required'
        ]);
        try{
            $perawat = perawat::find($id)->update([
                'nama' => $request->nama,
                'id_dokter' => $request->dokter,
                'id_jenis_kelamin' => $request->jenis_kelamin
            ]);
            return back()->with('sukses','data perawat berhasil di update/edit');
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
        $perawat = perawat::find($id)->delete();
        return back()->with('sukses','perawat berhasil di hapus');
    }
}
