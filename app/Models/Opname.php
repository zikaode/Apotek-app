<?php

namespace App\Models;

use App\Models\Obat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opname extends Model
{
    use HasFactory;
    protected $fillable = [
        'stok_awal',
        'stok_perbaikan',
        'keterangan',
    ];
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
