<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        $supplier = Supplier::all();
        $jumlah_obat = count($obat);
        $jumlah_supplier = count($supplier);
        $expired = 0;
        foreach ($obat as $item) {
            if (strtotime($item->expired) < strtotime("now")) {
                $expired += 1;
            }
        }
        return view('dashboard-app')->with(['jumlah_obat'=>$jumlah_obat, 'jumlah_supplier'=> $jumlah_supplier, 'expired' => $expired]);
    }
}
