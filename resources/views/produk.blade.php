@extends('layout.main')



@section('content')
    <div class="content-wrapper">

        <div class="container-pkks">

            <div class="title d-flex flex-row">
                <div>
                    <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Table Data Produk Koperasi</h2>
                </div>
                @if(Auth::user()->level === 'admin')
                    <div class="ml-auto">
                        {{-- <a href="{{ route("produk.create") }}">Tambah Data</a> --}}
                        <button type="button" class="popup-btn" data-toggle="modal" data-target="#formTambah">
                            Tambah Data
                        </button>
                    </div>

                    {{-- FORM POPUP TAMBAH DATA --}}
                    <div class="modal fade" id="formTambah" tabindex="-1" role="dialog" aria-labelledby="modalLabelTambah" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabelTambah">Form Tambah Data Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                      
                                <!-- Form di dalam Modal -->
                                <form class="form-data" action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf   
                                    <div class="modal-body">
                                        
                                        <div class="form-group">
                                            <label for="namaProduk">Nama Produk:</label>
                                            <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="Masukan Nama Produk">
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
                                            <input type="number" class="form-control" id="hargaProduk" name="hargaProduk" placeholder="Masukan Harga Produk">
                                                @error('hargaProduk')
                                                <small>{{ $message }}</small>
                                                @enderror
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="stokProduk">Stok Produk :</label>
                                            <input type="number" class="form-control" id="stokProduk" name="stokProduk" placeholder="Masukan Stok Produk">
                                                @error('stokProduk')
                                                <small>{{ $message }}</small>
                                                @enderror
                                        </div>
                        
                                        <div class="form-group input-image">
                                            <label for="gambarProduk">Gambar Produk :</label>
                                            <input type="file" class="form-control" id="gambarProduk" name="gambarProduk">
                                              @error('gambarProduk')
                                                  <small>{{ $message }}</small>
                                              @enderror
                                        </div>
                        
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                @endif
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
                                    <form action="{{ route("produk") }}" method="GET">
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
                                    <button class="tambah"><a href="{{ route('produk') }}" style="width: 120px">Kembali</a></button>
                                </div>
                            </div>
                        @else
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
                                        @if(Auth::user()->level === 'admin')
                                            <th style="width: 200px;">Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                @foreach ($data as $d)
                                    <tbody class="font-table text-center">
                                        <tr class="flex-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->idProduk }}</td>
                                            <td class="ovfl-text">{{ $d->namaProduk }}</td>
                                            <td>{{ $d->jenisProduk }}</td>
                                            <td>Rp. {{ $d->hargaProduk }}</td>
                                            <td>{{ $d->stokProduk }}</td>
                                            <td><img src="{{ asset('storage/foto-produk/'.$d->gambarProduk ) }}" alt="GAMBAR PRODUK" class="prd-img-set"></td>
                                            @if(Auth::user()->level === 'admin')
                                                <td>
                                                    {{-- <a href="{{ route('produk.edit',['id' => $d->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> Edit</a> --}}
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formEdit{{ $d->id }}">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </button>

                                                    {{-- FORM POPUP EDIT DATA --}}
                                                    <div class="modal fade" id="formEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabelEdit" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <!-- Header Modal -->
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" style="font-size: 18.26px" id="modalLabelEdit">Form Edit Data Produk</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                      
                                                                <!-- Form di dalam Modal -->
                                                                <form class="form-data" action="{{ route('produk.update',['id' => $d->idProduk]) }}" method="post" enctype="multipart/form-data" style="font-size: 22px; text-align:start;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                        
                                                                        <div class="form-group">
                                                                            <label for="namaProduk">Nama Produk:</label>
                                                                            <input type="text" class="form-control" id="namaProduk" name="namaProduk" value="{{ $d->namaProduk }}" placeholder="Masukan Nama Produk">
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
                                                                            <input type="number" class="form-control" id="hargaProduk" name="hargaProduk" value="{{ $d->hargaProduk }}" placeholder="Masukan Harga Produk">
                                                                                @error('hargaProduk')
                                                                                <small>{{ $message }}</small>
                                                                                @enderror
                                                                        </div>
                                                        
                                                                        <div class="form-group">
                                                                            <label for="stokProduk">Stok Produk :</label>
                                                                            <input type="number" class="form-control" id="stokProduk" name="stokProduk" value="{{ $d->stokProduk }}" placeholder="Masukan Stok Produk">
                                                                                @error('stokProduk')
                                                                                <small>{{ $message }}</small>
                                                                                @enderror
                                                                        </div>
                                                        
                                                                        <div class="form-group input-image">
                                                                            <label for="gambarProduk">Gambar Produk :</label>
                                                                            <input type="file" class="form-control" id="gambarProduk" name="gambarProduk">
                                                                              @error('gambarProduk')
                                                                                  <small>{{ $message }}</small>
                                                                              @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                        
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- END --}}
                                                    <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                                                </td>
                                            @endif
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
                        @endif
                        
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection