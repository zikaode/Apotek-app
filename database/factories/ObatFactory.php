<?php

namespace Database\Factories;

use App\Models\Apotek;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Node\Expr\Cast\String_;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obat>
 */
class ObatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jenis = explode(';', (Apotek::find(1)->jenis_obat));
        $temp_harga = (random_int(10, 250));
        return [
            'nama' => fake()->word(),
            'jenis' => $jenis[random_int(0, 2)],
            'maximum' => random_int(30, 50),
            'minimum' => 10,
            'stok' => random_int(20, 30),
            'harga_beli' => $temp_harga * 1000,
            'harga_jual' => ($temp_harga + random_int(10, 50)) * 1000,
            'supplier_id' => 1,
            'kategori_id' => 1,
            'expired' => fake()->date(),
            'kode' => fake()->word(),
            'margin' => 20,
            'ppn' => 11,
            'satuan' => fake()->word(),
        ];
    }
}
