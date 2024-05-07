@extends('layout.main')



@section('content')
    <div class="content-wrapper">

        <div class="container-pkks">

            <div class="title d-flex flex-row">
                <div>
                    <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Table Hasil Penjualan Koperasi</h2>
                </div>
            </div>
            <div class="hr-3 mb-5">
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Table Penjualan Produk</h3>
        
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                    <form action="{{ route("penjualan") }}" method="GET">
                                        <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search...">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">

                        @if($data->isEmpty())
                            <div class="d-flex flex-column">
                                <h1 style="text-align: center; margin-top: 175px;">Data tidak ditemukan...</h1>
                                <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 175px;">
                                    <button class="tambah"><a href="{{ route('penjualan') }}" style="width: 120px">Kembali</a></button>
                                </div>
                            </div>
                        @else
                            <table border="1 solid gray" class="table table-hover poppins">

                                <thead class="font-table text-center">
                                    <tr>
                                        <th>No</th>
                                        <th style="width: 125px;">Id Produk</th>
                                        <th style="width: 200px">Nama Produk</th>
                                        <th>Stok Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Jumlah Terjual</th>
                                        <th style="width: 150px">Total</th>
                                        @if(Auth::user()->level === 'admin')
                                            <th style="width: 150px;">Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                @foreach ($data as $d)
                                    <tbody class="font-table text-center">
                                        <tr class="flex-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->penjualan->idProduk }}</td>
                                            <td class="ovfl-text">{{ $d->namaProduk }}</td>
                                            <td>{{ $d->stokProduk }}</td>
                                            <td>Rp. {{ $d->hargaProduk }}</td>
                                            <td>
                                                @if ($d->penjualan->terjual == null)
                                                    -
                                                @else
                                                    {{ $d->penjualan->terjual }}
                                                @endif
                                            </td>

                                            <td>Rp. {{ $d->hargaProduk * $d->penjualan->terjual }}</td>
                                            @if(Auth::user()->level === 'admin')
                                                <td>
                                                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-tambah-terjual{{ $d->idProduk }}"><i class="fas fa-plus"></i> Tambah</button>
                                                </td>
                                            @endif
                                        </tr>                            
                                    </tbody>

                                    <div class="modal fade" id="modal-tambah-terjual{{ $d->idProduk }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Terjual</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('penjualan.terjual',['id' => $d->id]) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="jumlah_terjual">Jumlah Terjual</label>
                                                            <input type="number" class="form-control" id="jumlah_terjual" name="jumlah_terjual" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                        
                                @endforeach

                            </table>
                        @endif

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection