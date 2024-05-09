<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->id();
            $table->text('idProduk');
            $table->string('namaProduk', 250);
            $table->enum('jenisProduk', ['Aksesoris','Alat Tulis','Seragam']);
            $table->integer('hargaProduk');
            $table->integer('stokProduk');
            $table->string('gambarProduk', 250);
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
        Schema::dropIfExists('tb_produk');
    }
};
