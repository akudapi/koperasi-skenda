<?php

namespace App\Http\Controllers;

use App\Models\Tb_Penjualan;
use App\Models\Tb_Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    
    public function penjualan(){

        $fungsi = DB::select(
            'select tb_produk.idProduk, tb_produk.namaProduk
            FROM tb_produk'
        );
        

        $produk = DB::select(
            'select tb_produk.idProduk, tb_produk.namaProduk, tb_produk.jenisProduk, tb_produk.stokProduk, tb_produk.hargaProduk, tb_penjualan.id, tb_penjualan.terjual, (tb_penjualan.terjual * tb_produk.hargaProduk) AS totalSatuan
            FROM tb_produk left JOIN tb_penjualan 
            on tb_penjualan.idProduk = tb_produk.idProduk
            where tb_penjualan.terjual is not null;'
        );

        $totalPenjualan = DB::selectOne(
            'SELECT SUM(tb_penjualan.terjual * tb_produk.hargaProduk) AS totalPenjualan 
            from tb_penjualan 
            JOIN tb_produk ON tb_penjualan.idProduk = tb_produk.idProduk;'
        )->totalPenjualan;

        $pengurangan = Tb_Produk::with('penjualan')->get();

        return view('penjualan', compact('produk', 'fungsi', 'totalPenjualan'));

    }
    
    public function penjualantambah(Request $request){


        $request->validate([
            'produk' => 'required',
            'terjual' => 'required|integer|min:1',
        ]);


        // untuk mendaapatkan idProduk dari input
        $idProduk   = $request->produk;

        $penjualan = new Tb_Penjualan();
        $penjualan->idProduk    = $idProduk;
        $penjualan->terjual     = $request->terjual;
        $penjualan->save();

        $produk     = Tb_Produk::where('idProduk', $idProduk)->first();
        // dd($produk);
        $produk->stokProduk -= $request->terjual;
        $produk->save();

        return redirect()->back()->with('success', 'Jumlah terjual berhasil ditambahkan.');

    }

    public function penjualankurang(Request $request, $id){

        // $idProduk   = $request->produk;
        // $produk     = Tb_Produk::with('penjualan')->get();
        
        // // input an untuk dikurangi
        // $kurangiTerjual = $request->input('kurangi_terjual');

        // $produk-> += $kurangiTerjual;
        // $produk->save();

        // $penjualan = $produk->penjualan;
        // $penjualan->terjual -= $kurangiTerjual;
        // $penjualan->save();

        $produk             = Tb_Produk::findOrFail($id);
        $kurangiTerjual     = $request->input('kurangi_terjual');

        $penjualan          = $produk->penjualan;

        $produk->stokProduk += $kurangiTerjual;
        $produk->save();

        // $penjualan = Tb_Penjualan::findOrFail('idProduk');
        $penjualan->terjual -= $kurangiTerjual;
        $penjualan->save();

        return redirect()->back()->with('success', 'Jumlah terjual berhasil dikurangkan.');

    }

    public function penjualandelete($id)
    {
        
        // MENGAMBIL ID PRIMARY KEY UNTUK DELETE DATA
        $penjualan = Tb_Penjualan::findOrFail($id);
    
        // AMBIL DATA SESUAI idProduk YANG DIPILIH
        $produk = Tb_Produk::where('idProduk', $penjualan->idProduk)->first();
    
        // MENAMBAHKAN STOKPRODUK APABILA ADA DATA PENJUALAN YANG DIHAPUS
        $produk->stokProduk += $penjualan->terjual;
        $produk->save();
    
        // DELETE DATA SESUAI ID PRIMARY KEY YANG DIAMBIL
        $penjualan->delete();
        // dd($penjualan);
    
        return redirect()->back()->with('success', 'Penjualan berhasil dihapus.');
    }

}
