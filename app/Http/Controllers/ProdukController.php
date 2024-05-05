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
    public function produk(){
        
        $data = Tb_Produk::get();

        return view('produk', compact('data'));
        
    }

    public function produkcreate(){

        $data = Tb_Produk::get();
        
        return view('produkCreate',compact('data'));
    }

    public function produkstore(Request $request){
        $validator = Validator::make($request->all(),[
            'namaProduk'        => 'required',
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

        //  Helper::IDGenerator(new ProdukController, 'idProduk', 5, 'PRDK');

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
        $penjualan->idProduk    = $produk->idProduk;
        $penjualan->save();

        // $data['idProduk']           = $idProduk;
        // $data['namaProduk']         = $request->namaProduk;
        // $data['jenisProduk']        = $request->jenisProduk;
        // $data['hargaProduk']        = $request->hargaProduk;
        // $data['stokProduk']         = $request->stokProduk;
        // $data['gambarProduk']       = $filename;
        // Tb_Produk::create($data);

        return redirect()->route('produk');
    }

    public function produkedit(Request $request, $id){
        $data = Tb_Produk::find($id);

        return view('produkEdit',compact('data'));
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

        if ($request->hasFile('gambarProduk')) {
            $photo = $request->file('gambarProduk');
            $filename = date('Y-m-D') . $photo->getClientOriginalName();
            $path = 'photo-user/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($photo));
            $data['gambarProduk'] = $filename;
        } else {
            $existingProduct = Tb_Produk::findOrFail($id);
            $data['gambarProduk'] = $existingProduct->gambarProduk;
        }

        Tb_Produk::whereId($id)->update($data);

        return redirect()->route('produk');
    }

    public function produkdelete(Request $request, $id){
        $data = Tb_Produk::find($id);

        if ($data) {
            $data ->delete();
        }

        return redirect()->route('produk');
    }

}
