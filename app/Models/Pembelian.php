<?php

namespace App\Models;

use App\Models\User;
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
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
