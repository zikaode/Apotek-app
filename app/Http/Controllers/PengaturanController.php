<?php

namespace App\Http\Controllers;

use App\Models\Apotek;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apotek = Apotek::first();
        $pengaturan = explode(';', ($apotek->pengaturan));
        return view('pengaturan')->with(['apotek' => $apotek, 'pengaturan' => $pengaturan]);
        // return dd($apotek);
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
        //
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
    public function update(Request $request)
    {
        $apotek = Apotek::first();
        $validated = $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'info' => ''
        ]);
        $result = $apotek->update([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'info' => $request->info
        ]);
        if ($result) {
            session()->flash('status', "Pengaturan Berhasil Disimpan!");
            return back();
        } else {
            session()->flash('failed', "Pengaturan Gagal Disimpan!");
            return back()->withInput();
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
        //
    }
    public function opname()
    {
        $apotek = Apotek::first();
        $pengaturan = explode(';', ($apotek->pengaturan));
        if ($pengaturan[0] === 'opname:true') {
            $apotek->update([
                'pengaturan' => "opname:false;{$pengaturan[1]}"
            ]);
            $pengaturan = explode(';', ($apotek->pengaturan));
            session()->flash('status', "Menu Edit Opname Ditutup!");
            return back();
        } else {
            $apotek->update([
                'pengaturan' => "opname:true;{$pengaturan[1]}"
            ]);
            session()->flash('status', "Menu Edit Opname Dibuka!");
            return back();
        }
    }
    public function obat()
    {
        $apotek = Apotek::first();
        $pengaturan = explode(';', ($apotek->pengaturan));
        if ($pengaturan[1] === 'obat:true') {
            $apotek->update([
                'pengaturan' => "{$pengaturan[0]};obat:false"
            ]);
            $pengaturan = explode(';', ($apotek->pengaturan));
            session()->flash('status', "Menu Edit Obat Ditutup!");
            return back();
        } else {
            $apotek->update([
                'pengaturan' => "{$pengaturan[0]};obat:true"
            ]);
            session()->flash('status', "Menu Edit Obat Dibuka!");
            return back();
        }
    }
}
