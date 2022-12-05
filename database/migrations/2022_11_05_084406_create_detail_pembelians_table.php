<?php

use App\Models\Obat;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('jumlah');
            $table->unsignedInteger('harga_beli');
            $table->unsignedInteger('sub_total');
            $table->foreignIdFor(Obat::class);
            $table->foreignIdFor(Penjualan::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembelians');
    }
};
