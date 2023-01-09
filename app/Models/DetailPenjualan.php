<?php

namespace App\Models;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah',
        'sub_total',
        'harga_beli',
        'harga_jual',
        'obat_id',
        'penjualan_id'
    ];
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
