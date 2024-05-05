<?php

namespace App\Http\Controllers;

use App\Models\Tb_Penjualan;
use App\Models\Tb_Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    
    public function penjualan(){

        $data = Tb_Produk::with('penjualan')->get();

        return view('penjualan', compact('data'));

    }

    public function tambahterjual(Request $request, $id){

        $produk         = Tb_Produk::findOrFail($id);
        $jumlahTerjual  = $request->input('jumlah_terjual');

        $penjualan      = $produk->penjualan;

        if (!$penjualan) {
            $penjualan = new Tb_Penjualan();
            $penjualan->idProduk = $id;
        }

        $penjualan->terjual = $jumlahTerjual;
        $penjualan->save();

        
        return redirect()->back()->with('success', 'Jumlah terjual berhasil ditambahkan.');
    }


}
