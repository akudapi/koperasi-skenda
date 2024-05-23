<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_Produk extends Model
{
    use HasFactory;

    protected $table = "tb_produk";

    protected $fillable = [
        "idProduk",
        "namaProduk",
        "jenisProduk",
        "hargaProduk",
        "stokProduk",
        "gambarProduk",
    ];

    public function penjualan()
    {
        return $this->hasMany(Tb_Penjualan::class,  'idProduk', 'id');
    }    
}
