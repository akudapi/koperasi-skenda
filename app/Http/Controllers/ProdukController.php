<?php

namespace App\Http\Controllers;

use App\Models\Tb_Produk;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            'hargaProduk'       => 'required',
            'gambarProduk'      => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        $photo      = $request->file('gambarProduk');
        $filename   = date('Y-m-D').$photo->getClientOriginalName();
        $path       = 'photo-user/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        //  Helper::IDGenerator(new ProdukController, 'idProduk', 5, 'PRDK');

        $idProduk = Helper::IDGenerator(new Tb_Produk, 'idProduk', 3, 'PRD');

        $data['idProduk']           = $idProduk;
        $data['namaProduk']         = $request->namaProduk;
        $data['jenisProduk']        = $request->jenisProduk;
        $data['hargaProduk']        = $request->hargaProduk;
        $data['gambarProduk']       = $filename;

        Tb_Produk::create($data);

        return redirect()->route('admin.produk');
    }

    public function edit(Request $request, $id){
        $data = Tb_Produk::find($id);

        return view('edit',compact('data'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'email'     => 'required|email',
            'nama'      => 'required',
            'password'  => 'nullable',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        $data['email']      = $request->email;
        $data['name']       = $request->nama;

        Tb_Produk::whereId($id)->update($data);

        return redirect()->route('index');
    }

    public function delete(Request $request, $id){
        $data = Tb_Produk::find($id);

        if ($data) {
            $data ->delete();
        }

        return redirect()->route('index');
    }

}
