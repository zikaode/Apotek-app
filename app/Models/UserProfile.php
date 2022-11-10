<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
