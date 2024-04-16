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
        Schema::create('tb_penjualan', function (Blueprint $table) {
            $table->id('idPenjualan');
            $table->text('idProduk');
            $table->string('namaProduk', 250);
            $table->integer('penjualan');
            $table->timestamps();

            //relation untuk idProduk di table tb_produk
            // $table->foreign('idProduk')->references('idProduk')->on('tb_produk')->onUpdate('cascade')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_penjualan');
    }
};
