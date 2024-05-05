@extends('layout.main')

@section('content')
<div class="content-wrapper">

    <div class="container-pkks" style="font-family: 'Poppins'; ">

        <div class="title">
            <h2>Tambah Data Produk</h2>                
        </div>
        <div class="hr-3">
            <hr>
        </div>

        <form class="form-data" action="{{ route('penjualan.store') }}" method="post">
            @csrf
            
            <div class="card-user">
                <p>Form Tambah Data Produk</p>
            </div>    
            
            <div class="form-pad">

                <div class="form-group">
                    <label for="produk">Pilih Produk:</label>
                    <select name="idProduk" id="produk" class="form-control">
                        <option disable selected>--pilih produk--</option>
                        @foreach($produk as $data)
                            <option value="{{ $data->idProduk }}">{{ $data->namaProduk}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="terjual">Produk Terjual:</label>
                    <input type="number" class="form-control" id="terjual" name="terjual" placeholder="masukkan penjualan produk..">
                        @error('terjual')
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