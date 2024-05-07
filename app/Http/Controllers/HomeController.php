<?php

namespace App\Http\Controllers;

use App\Models\Tb_Penjualan;
use App\Models\Tb_Produk;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){

        $totalData1 = User::count();
        $totalData2 = Tb_Produk::count();
        $totalData3 = Tb_Penjualan::count();

        return view('index', compact('totalData1', 'totalData2', 'totalData3'));

    }

}
