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
    
        $totalPenuh = Tb_Produk::with('penjualan')
            ->when($search, function($query) use ($search) {
                return $query->where('idProduk', 'LIKE', "%{$search}%")
                    ->orWhere('namaProduk', 'LIKE', "%{$search}%")
                    ->orWhere('jenisProduk', 'LIKE', "%{$search}%")
                    ->orWhere('hargaProduk', 'LIKE', "%{$search}%");
            })
            ->get()
            ->sum(function ($produk) {
                return $produk->hargaProduk * $produk->penjualan->terjual;
            });
    
        $data = Tb_Produk::with('penjualan')
            ->when($search, function($query) use ($search) {
                return $query->where('idProduk', 'LIKE', "%{$search}%")
                    ->orWhere('namaProduk', 'LIKE', "%{$search}%")
                    ->orWhere('jenisProduk', 'LIKE', "%{$search}%")
                    ->orWhere('hargaProduk', 'LIKE', "%{$search}%");
            })
            ->paginate(5);
    
        return view('penjualan', compact('data', 'totalPenuh', 'search'));
    }
    

    public function tambahterjual(Request $request, $id){

        $produk             = Tb_Produk::findOrFail($id);
        $jumlahTerjual      = $request->input('jumlah_terjual');
        $kurangiTerjual     = $request->input('kurangi_terjual');

        $penjualan      = $produk->penjualan;

        if (!$penjualan) {
            $penjualan = new Tb_Penjualan();
            $penjualan->idProduk = $id;
        }
        
        $produk->stokProduk -= $jumlahTerjual;
        $produk->save();

        $penjualan->terjual += $jumlahTerjual;
        $penjualan->save();

        return redirect()->back()->with('success', 'Jumlah terjual berhasil ditambahkan.');

    }

    public function kurangiterjual(Request $request, $id){

        $produk             = Tb_Produk::findOrFail($id);
        $kurangiTerjual     = $request->input('kurangi_terjual');

        $penjualan          = $produk->penjualan;

        $produk->stokProduk += $kurangiTerjual;
        $produk->save();

        $penjualan->terjual -= $kurangiTerjual;
        $penjualan->save();

        return redirect()->back()->with('success', 'Jumlah terjual berhasil dikurangkan.');

    }


}
