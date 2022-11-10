<?php

use App\Models\Kategori;
use App\Models\Supplier;
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
        Schema::create('obats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('satuan');
            $table->unsignedInteger('maximum')->unsigned();
            $table->unsignedInteger('minimum')->unsigned();
            $table->unsignedInteger('stok')->unsigned();
            $table->unsignedInteger('harga_beli')->unsigned();
            $table->unsignedInteger('harga_jual')->unsigned();
            $table->date('expired');
            $table->foreignIdFor(Supplier::class);
            $table->foreignIdFor(Kategori::class);
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
        Schema::dropIfExists('obats');
    }
};
