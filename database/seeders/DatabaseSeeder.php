<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Apotek;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Penjualan;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // $id = UserProfile::create([
        //     'alamat' => 'Mongeudong',
        //     'no_telp' => '081201010101',
        //     'tanggal_lahir' => '2002-07-11',
        //     'jenis_kelamin' => 'L',
        // ]);
        // User::create([
        //     'name' => 'Dzikri Arraiyan',
        //     'email' => 'test@example.com',
        //     'email_verified_at' => now(),
        //     'level' => 'admin',
        //     'password' => Hash::make('Admin123'),
        //     'remember_token' => Str::random(10),
        //     'user_profile_id' => $id->id,
        // ]);
        // Kategori::create([
        //     'nama' => 'Obat Umum'
        // ]);
        // Supplier::create([
        //     'nama' => 'dzikri',
        //     'alamat' => 'mongeudong',
        //     'no_telp' => '82082',
        //     'hutang' => 0,
        // ]);

        // Apotek::create([
        //     'nama' => 'Apotek Dzikri',
        //     'alamat' => 'Mongeudong',
        //     'no_telp' => '182048',
        //     'jenis_obat' => 'obat;vitamin;susu'
        // ]);

        // \App\Models\Obat::factory(10)->create();
        // \App\Models\Kategori::factory(30)->create();

        Penjualan::create([
            'costumer' => 'Apotek Dzikri',
            'total_harga' => '80000',
            'total_bayar' => '100000',
            'kembalian' => '20000',
            'user_id' => 1
        ]);
    }
}
