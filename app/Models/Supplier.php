<?php

namespace App\Models;

use App\Models\Obat;
use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
        'hutang',
    ];
    public function obat()
    {
        return $this->hasOne(Obat::class);
    }
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }
}
