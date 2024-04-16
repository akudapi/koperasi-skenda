@extends('layout.main')



@section('content')
    <div class="content-wrapper">

        <div class="container-pkks">

            <div class="title d-flex flex-row">
                <div>
                    <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Table Data Produk Koperasi</h2>
                </div>
                <div class="ml-auto">
                    <button class="tambah"><a href="{{ route("admin.produk.create") }}">Tambah Data</a></button>
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
                        <table class="table table-hover poppins">

                        <thead>
                            <tr style="font-size: 20px">
                                <th style="width: 150px; text-align: center;">Id Produk</th>
                                <th>Nama Produk</th>
                                <th style="text-align: center;">Jenis Produk</th>
                                <th style="text-align: center;">Harga Produk</th>
                                <th style="text-align: center;">Gambar Produk</th>
                                <th style="width: 200px; text-align: center;">Action</th>
                            </tr>
                        </thead>

                        @foreach ($data as $d)
                        <tr>
                            <td style="text-align: center">{{ $d->idProduk }}</td>
                            <td>{{ $d->namaProduk }}</td>
                            <td style="text-align: center;">{{ $d->jenisProduk }}</td>
                            <td style="text-align: center;">{{ $d->hargaProduk }}</td>
                            <td style="text-align: center;">{{ $d->gambarProduk }}</td>
                            <td>
                                {{-- {{ route('admin.user.edit',['id' => $d->id]) }} --}}
                                <a href="" class="btn btn-primary"><i class="fas fa-pen"></i> Edit</a>
                                <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </td>
                        </tr>
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
                                    {{-- {{ route('admin.user.delete',['id' => $d->id]) }} --}}
                                <form action="" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ya, Hapus data</button>  
                                </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
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