<?php

namespace App\Http\Controllers;

use App\Models\Tb_Penjualan;
use App\Models\Tb_Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    
    public function penjualan(Request $request){

        $search = $request->input('search');

        if ($search) {
            $data = Tb_Produk::query()
                ->where('idProduk', 'LIKE', "%{$search}%")
                ->orWhere('namaProduk', 'LIKE', "%{$search}%")
                ->orWhere('jenisProduk', 'LIKE', "%{$search}%")
                ->orWhere('hargaProduk', 'LIKE', "%{$search}%")
                ->get();

            $isEmpty = $data->isEmpty();
        } else {
            $data = Tb_Produk::with('penjualan')->get();
            $isEmpty = false;
        }

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
        
        $produk->stokProduk -=$jumlahTerjual;
        $produk->save();

        $penjualan->terjual += $jumlahTerjual;
        $penjualan->save();


        return redirect()->back()->with('success', 'Jumlah terjual berhasil ditambahkan.');

    }


}
