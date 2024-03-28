<?php

namespace App\Http\Controllers;

use App\Models\Tb_Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function produk(){
        
        $data = Tb_Produk::get();

        return view('produk', compact('data'));
        
    }

    

}
