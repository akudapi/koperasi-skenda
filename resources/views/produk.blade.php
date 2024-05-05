@extends('layout.main')



@section('content')
    <div class="content-wrapper">

        <div class="container-pkks">

            <div class="title d-flex flex-row">
                <div>
                    <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Table Data Produk Koperasi</h2>
                </div>
                <div class="ml-auto">
                    <button class="tambah"><a href="{{ route("produk.create") }}">Tambah Data</a></button>
                </div>
            </div>
            <div class="hr-3 mb-5">
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Table Produk</h3>
        
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table  border="1 solid gray" class="table table-hover poppins">

                        <thead class="font-table text-center">
                            <tr>
                                <th>No</th>
                                <th style="width: 125px;">Id Produk</th>
                                <th>Nama Produk</th>
                                <th>Jenis Produk</th>
                                <th>Harga Produk</th>
                                <th>Stok Produk</th>
                                <th>Gambar Produk</th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                        </thead>

                        @foreach ($data as $d)
                        <tbody class="font-table text-center">
                            <tr class="flex-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->idProduk }}</td>
                                <td>{{ $d->namaProduk }}</td>
                                <td>{{ $d->jenisProduk }}</td>
                                <td>Rp. {{ $d->hargaProduk }}</td>
                                <td>{{ $d->stokProduk }}</td>
                                <td><img src="{{ asset('storage/foto-produk/'.$d->gambarProduk ) }}" alt="GAMBAR PRODUK" style="width: 100px;"></td>
                                <td>
                                    <a href="{{ route('produk.edit',['id' => $d->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> Edit</a>
                                    <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>                            
                        </tbody>

                        <div class="modal fade" id="modal-hapus{{ $d->id }}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Default Modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <p>Apakah kamu yakin ingin menghapus data produk <b>{{ $d->namaProduk }}</b></p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    {{--  --}}
                                <form action="{{ route('produk.delete',['id' => $d->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ya, Hapus data</button>  
                                </form>
                                </div>
                            </div>
                            
                            </div>
                            
                        </div>
                        @endforeach

                        </table>
                    </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection