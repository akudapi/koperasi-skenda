@extends('layout.main')

@section('content')
<div class="content-wrapper">

    <div class="container-pkks" style="font-family: 'Poppins'; ">

        <div class="title">
            <h2>Tambah Data User</h2>                
        </div>
        <div class="hr-3">
            <hr>
        </div>

        <form class="form-user" action="{{ route('admin.produk.update',['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-user">
                <p>Form Tambah Data User</p>
                
            </div>    
            
            <div class="form-pad">

                <div class="form-group">
                    <label for="namaProduk">Nama Produk:</label>
                    <input type="text" class="form-control" id="namaProduk" name="namaProduk" value="{{ $data->namaProduk }}" placeholder="Masukan Nama Produk">
                        @error('namaProduk')
                        <small>{{ $message }}</small>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="jenisProduk">Jenis Produk :</label>
                    <select class="form-control" name="jenisProduk">
                        <option value="#" selected>Pilih Jenis Produk</option>
                        <option value="Aksesoris">Aksesoris</option>
                        <option value="Alat Tulis">Alat Tulis</option>
                        <option value="Seragam">Seragam</option>
                    </select>
                    @error('jenisProduk')
                    <small>{{ $message }}</small>
                    @enderror
                </div> 

                <div class="form-group">
                    <label for="hargaProduk">Harga Produk :</label>
                    <input type="number" class="form-control" id="hargaProduk" name="hargaProduk" value="{{ $data->hargaProduk }}" placeholder="Masukan Harga Produk">
                        @error('hargaProduk')
                        <small>{{ $message }}</small>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="gambarProduk">Gambar Produk :</label>
                    <input type="file" class="form-control" id="gambarProduk" name="gambarProduk">
                      @error('gambarProduk')
                          <small>{{ $message }}</small>
                      @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>

        </form>
        
    </div>

</div>
@endsection       