<?php

namespace App\Models;

use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah',
        'sub_total',
        'harga_beli',
    ];
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
