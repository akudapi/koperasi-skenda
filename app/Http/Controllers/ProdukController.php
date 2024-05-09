<?php

namespace App\Http\Controllers;

use App\Models\Tb_Produk;
use App\Models\Tb_Penjualan;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\NullableType;

class ProdukController extends Controller
{
    public function produk(Request $request){

        $search = $request->input('search');

        $data = Tb_Produk::with('penjualan')
            ->when($search, function($query) use ($search) {
                return $query->where('idProduk', 'LIKE', "%{$search}%")
                    ->orWhere('namaProduk', 'LIKE', "%{$search}%")
                    ->orWhere('jenisProduk', 'LIKE', "%{$search}%")
                    ->orWhere('hargaProduk', 'LIKE', "%{$search}%");
            })
            ->paginate(5);

        return view('produk', compact('data', 'search'));
        
    }

    public function produkstore(Request $request){
        $validator = Validator::make($request->all(),[
            'namaProduk'        => 'required|max:250',
            'jenisProduk'       => 'required|in:Aksesoris,Alat Tulis,Seragam',
            'hargaProduk'       => 'required',
            'stokProduk'        => 'required',
            'gambarProduk'      => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $photo      = $request->file('gambarProduk');
        $filename   = date('Y-m-D').$photo->getClientOriginalName();
        $path       = 'foto-produk/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $idProduk = Helper::IDGenerator(new Tb_Produk, 'idProduk', 3, 'PRD');

        $produk = new Tb_Produk();
        $produk->idProduk       = $idProduk;
        $produk->namaProduk     = $request->namaProduk;
        $produk->jenisProduk    = $request->jenisProduk;
        $produk->hargaProduk    = $request->hargaProduk;
        $produk->stokProduk     = $request->stokProduk;
        $produk->gambarProduk   = $filename;
        $produk->save();

        $penjualan = new Tb_Penjualan();
        $penjualan->idProduk = $produk->idProduk;
        $penjualan->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan produk.');
    }

    public function produkupdate(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'namaProduk'        => 'required',
            'jenisProduk'       => 'required|in:Aksesoris,Alat Tulis,Seragam',
            'hargaProduk'       => 'required',
            'stokProduk'        => 'required',
            'gambarProduk'      => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        $data['namaProduk']         = $request->namaProduk;
        $data['jenisProduk']        = $request->jenisProduk;
        $data['hargaProduk']        = $request->hargaProduk;
        $data['stokProduk']         = $request->stokProduk;

        $imageDb = Tb_Produk::findOrFail($id);
        $data['gambarProduk'] = $imageDb->gambarProduk;

        Tb_Produk::whereId($id)->update($data);

        return redirect()->back()->with('success', 'Berhasil mengedit produk.');
    }

    public function produkdelete(Request $request, $id){
        $data = Tb_Produk::findOrFail($id);

        Tb_Penjualan::where('idProduk', $data->idProduk)->delete();

        $data ->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus produk.');
    }

}
