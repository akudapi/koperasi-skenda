<?php

namespace App\Models;

use App\Http\Controllers\PenjualanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_Penjualan extends Model
{
    use HasFactory;

    protected $table = "tb_penjualan";

    protected $fillable = [
        "idProduk",
        "terjual",
    ];

    public function produk()
    {
        return $this->belongsTo(Tb_Produk::class, 'idProduk', 'idProduk');
    }
    
}
