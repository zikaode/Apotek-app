<?php

namespace App\Models;

use App\Models\Opname;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'maximum',
        'minimum',
        'stok',
        'harga_beli',
        'harga_jual',
        'expired',
    ];
    public function opname()
    {
        return $this->hasMany(Opname::class);
    }
    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class);
    }
    public function detail_penjualan()
    {
        return $this->hasMany(DetailPembelian::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
