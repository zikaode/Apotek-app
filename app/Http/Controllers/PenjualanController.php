<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;
use Illuminate\Contracts\Session\Session;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::paginate(10);
        return view('penjualan', ['penjualan' => $penjualan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obat = Obat::where('stok', '>', 0)->get();
        // return dd($obat);
        // session()->forget('kasir');
        $temp = session()->get('kasir', []);
        $refresh = array_map(function ($var) {
            try {
                session()->flash('statusKasir', false);
                return ['id' => $var['id'], 'jumlah' => $var['jumlah'], 'obat' => Obat::where('kode', '=', $var['id'])->get()];
            } catch (\Throwable $th) {
            }
        }, $temp);
        $total = 0;
        $refresh = array_filter($refresh, function ($var) {
            try {
                if ($var['jumlah'] <= 0) {
                } else return $var;
            } catch (\Throwable $th) {
            }
        });
        foreach ($refresh as $i) {
            try {
                $total += $i['obat'][0]->harga_jual * $i['jumlah'];
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        session()->put('kasir', $refresh);
        session()->flash('total', $total);
        return view('kasir', ['obat' => $obat]);
    }
    public function add(Request $request)
    {
        // session()->forget('kasir');
        $temp = session()->get('kasir', []);
        session()->flash('statusKasir', true);
        session()->put('temp', ['id' => $request->obat, 'jumlah' => $request->jumlah]);
        $obat = array_map(function ($var) {
            try {
                $temp = session()->get('temp');
                if ($var['id'] == $temp['id']) {
                    session()->flash('statusKasir', false);
                    $jumlah = $var['jumlah'] + $temp['jumlah'];
                    if ($jumlah <= $var['obat'][0]->stok)
                        return ['id' => $var['id'], 'jumlah' => $jumlah, 'obat' => $var['obat']];
                    else {
                        session()->flash('failed', 'Input Obat Melebihi Jumlah Stok Yang Tersedia. (OBAT: ' . $var['obat'][0]->nama . ' - STOK: ' . $var['obat'][0]->stok . ')');
                        return $var;
                    }
                } else return $var;
            } catch (\Throwable $th) {
            }
        }, $temp);
        session()->forget('temp');
        if (session()->get('statusKasir', false) == true) {
            $dataObat = Obat::where('kode', '=', $request->obat)->get();
            if ($request->jumlah <= $dataObat[0]->stok) array_push($obat, ['id' => $request->obat, 'jumlah' => $request->jumlah, 'obat' => $dataObat]);
            else session()->flash('failed', 'Input Obat Melebihi Jumlah Stok Yang Tersedia. (OBAT: ' . $dataObat[0]->nama . ' - STOK: ' . $dataObat[0]->stok . ')');
        }
        $obat = array_filter($obat, function ($var) {
            try {
                if ($var['jumlah'] <= 0) {
                } else return $var;
            } catch (\Throwable $th) {
            }
        });
        session()->put('kasir', $obat);
        // return session()->get('kasir');
        return redirect(route('penjualan.kasir'));
    }
    public function transaksi(Request $request)
    {
        $totalHarga = 0;
        $dataKasir = session()->get('kasir');
        foreach ($dataKasir as $i) {
            $totalHarga += ($i['jumlah'] * $i['obat'][0]->harga_jual);
        }
        $data = [
            'costumer' => $request->costumer,
            'total_bayar' => $request->totalbayar,
            'total_harga' => $totalHarga,
            'kembalian' => $request->totalbayar - $totalHarga,
            'user_id' => Auth::user()->id
        ];
        DB::beginTransaction();
        $transaksi = Penjualan::make($data)->save();
        $transaksiId = Penjualan::latest()->get();
        foreach ($dataKasir as $i) {
            $data = [
                'jumlah' => $i['jumlah'],
                'sub_total' => ($i['jumlah'] * $i['obat'][0]->harga_jual),
                'harga_beli' => $i['obat'][0]->harga_beli,
                'harga_jual' => $i['obat'][0]->harga_jual,
                'obat_id' => $i['obat'][0]->id,
                'penjualan_id' => $transaksiId[0]->id
            ];
            $obat = Obat::find($i['obat'][0]->id);
            $result = $obat->update([
                'stok' => $i['obat'][0]->stok - $i['jumlah']
            ]);
            if ($result) {
                $result = DetailPenjualan::make($data)->save();
                $transaksi = $transaksi && $result;
            }
        }
        session()->forget('kasir');
        if ($transaksi) {
            DB::commit();
            session()->flash('success', "Data Transaksi Berhasil Direkam!");
            return redirect(route('penjualan.kasir'));
        } else {
            DB::rollBack();
            session()->flash('failed', "Data Transaksi Gagal Direkam!");
            return redirect(route('penjualan.kasir'));
        }
    }
    public function min($id)
    {
        $temp = session()->get('kasir', []);
        session()->put('id', $id);
        $obat = array_map(function ($var) {
            try {
                if ($var['id'] == session()->get('id', 0)) {
                    return ['id' => $var['id'], 'jumlah' => $var['jumlah'] - 1, 'obat' => $var['obat']];
                } else return $var;
            } catch (\Throwable $th) {
            }
        }, $temp);
        session()->forget('id');
        session()->put('kasir', $obat);
        return back();
    }
    public function del($id)
    {
        $temp = session()->get('kasir', []);
        session()->put('id', $id);
        $obat = array_filter($temp, function ($var) {
            try {
                if ($var['id'] != session()->get('id', 0)) {
                    return $var;
                }
            } catch (\Throwable $th) {
            }
        });
        session()->forget('id');
        session()->put('kasir', $obat);
        return back();
    }
    public function bukti($id)
    {
        $penjualan = Penjualan::find($id);
        return view('detailpenjualan', ['penjualan' => $penjualan]);
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
    public function update(Request $request, $id)
    {
        //
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
}
