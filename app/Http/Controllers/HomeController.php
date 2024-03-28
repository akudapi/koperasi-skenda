<?php

namespace App\Http\Controllers;

use App\Models\Tb_Penjualan;
use App\Models\Tb_Produk;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view('index');
    }

    public function penjualan(){
        
        $data = Tb_Penjualan::get();

        return view('penjualan', compact('data'));
        
    }

}
