<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'costumer',
        'total_harga',
        'total_bayar',
        'kembalian',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
