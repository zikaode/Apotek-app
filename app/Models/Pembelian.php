<?php

namespace App\Models;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'harga_beli',
        'harga_jual',
        'selisih',
        'keterangan',
        'user_id',
        'supplier_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
