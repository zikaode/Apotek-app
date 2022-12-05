<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Apotek;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pengaturan = explode(';', (Apotek::find(1)->pengaturan));
        $jenis = explode(';', (Apotek::find(1)->jenis_obat));
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        if (isset($request->search))
            $obat = Obat::with('kategori', 'supplier')->where('nama', 'LIKE', "%{$request->search}%")->paginate(10)->withQueryString();
        else $obat = Obat::with('kategori', 'supplier')->paginate(10)->withQueryString();
        if ($pengaturan[1] === 'obat:true') {
            return view('obat')->with(['obat' => $obat, 'search' => $request->search, 'jenis' => $jenis, 'kategori' => $kategori, 'supplier' => $supplier]);
        } else {
            session()->flash('close', "Pengelolaan Data Obat Ditutup");
            return view('obat_close')->with(['obat' => $obat, 'search' => $request->search,  'jenis' => $jenis, 'kategori' => $kategori, 'supplier' => $supplier]);
        }
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
        $pengaturan = explode(';', (Apotek::find(1)->pengaturan));
        if ($pengaturan[1] === 'obat:true') {
            $validated = $request->validate([
                'kode' => 'required|unique:obats,kode',
                'nama' => 'required',
                'jenis' => 'required',
                'kategori' => 'required|exists:kategoris,id',
                'supplier' => 'required|exists:suppliers,id',
                'expired' => 'required|date',
                'stokAwal' => 'required|numeric|min:1|lte:stokMax|gte:stokMin',
                'stokMin' => 'required|numeric|min:1|lt:stokMax',
                'stokMax' => 'required|numeric|min:1|gt:stokMin',
                'satuan' => 'required',
                'ppn' => 'required|numeric|max:100',
                'margin' => 'required|numeric',
                'hargaBeli' => 'required|numeric',
                'hargaJual' => 'required|numeric|gt:hargaBeli'
            ]);
            $obatInsert = Obat::make([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'kategori_id' => $request->kategori,
                'supplier_id' => $request->supplier,
                'expired' => $request->expired,
                'stok' => $request->stokAwal,
                'minimum' => $request->stokMin,
                'maximum' => $request->stokMax,
                'satuan' => $request->satuan,
                'ppn' => $request->ppn,
                'margin' => $request->margin,
                'harga_beli' => $request->hargaBeli,
                'harga_jual' => $request->hargaJual
            ]);
            if ($obatInsert->save()) {
                session()->flash('success', "Data Obat Berhasil Direkam!");
                return back();
            } else {
                session()->flash('failed', "Data Obat Gagal Direkam!");
                return back()->withInput();
            }
        } else {
            session()->flash('close', "Pengelolaan Data Obat Ditutup");
            return back()->with('close', 'Pengeditan Untuk Obat Ditutup!');
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
    public function update(Request $request, Obat $obat)
    {
        $pengaturan = explode(';', (Apotek::find(1)->pengaturan));
        if ($pengaturan[1] === 'obat:true') {
            $validated = $request->validate([
                'kode' => 'required|same:last_kode',
                'nama' => 'required',
                'jenis' => 'required',
                'kategori' => 'required|exists:kategoris,id',
                'supplier' => 'required|exists:suppliers,id',
                'expired' => 'required|date',
                'stokAwal' => 'required|numeric|min:1|lte:stokMax|gte:stokMin',
                'stokMin' => 'required|numeric|min:1|lt:stokMax',
                'stokMax' => 'required|numeric|min:1|gt:stokMin',
                'satuan' => 'required',
                'ppn' => 'required|numeric|max:100',
                'margin' => 'required|numeric',
                'hargaBeli' => 'required|numeric',
                'hargaJual' => 'required|numeric|gt:hargaBeli'
            ]);
            $result = $obat->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'kategori_id' => $request->kategori,
                'supplier_id' => $request->supplier,
                'expired' => $request->expired,
                'minimum' => $request->stokMin,
                'maximum' => $request->stokMax,
                'satuan' => $request->satuan,
                'ppn' => $request->ppn,
                'margin' => $request->margin,
                'harga_beli' => $request->hargaBeli,
                'harga_jual' => $request->hargaJual
            ]);
            if ($result) {
                session()->flash('success', "Data Obat Berhasil Direkam!");
                return back();
            } else {
                session()->flash('failed', "Data Obat Gagal Direkam!");
                return back()->withInput();
            }
        } else {
            session()->flash('close', "Pengelolaan Data Obat Ditutup");
            return back()->with('close', 'Pengeditan Untuk Obat Ditutup!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $pengaturan = explode(';', (Apotek::find(1)->pengaturan));
        if ($pengaturan[1] === 'obat:true') {
            $obat = Obat::find($id);
            $nama = $obat->nama;
            if (!$obat)
                return back();
            $obat->delete();
            session()->flash('status', "Obat '{$nama}' Berhasil Dihapus!");
            return back();
        } else {
            session()->flash('close', "Pengelolaan Data Obat Ditutup");
            return back();
        }
    }
}
