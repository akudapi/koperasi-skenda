@extends('layout.main')



@section('content')
    <div class="content-wrapper">

        <div class="container-pkks">

            {{--  --}}
            <div class="title d-flex flex-row">
                <div>
                    <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Table Hasil Penjualan Koperasi</h2>
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
                                    <h5 class="modal-title" id="modalLabelTambah">Form Tambah Data Penjualan Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                      
                                <!-- Form di dalam Modal -->
                                <form class="form-data" action="{{ route('penjualan.tambah') }}" method="post" enctype="multipart/form-data">
                                    @csrf   
                                    <div class="modal-body">
                        
                                        <div class="form-group">
                                            <label for="jenisProduk">Pilih Produk:</label>
                                            <select class="form-control select2" name="produk">
                                                <option value="#" selected>Pilih Jenis Produk</option>
                                                @foreach ($fungsi as $f)
                                                    <option value="{{ $f->idProduk }}">{{ $f->namaProduk }}</option>    
                                                @endforeach
                                            </select>
                                            @error('produk')
                                            <small>{{ $message }}</small>
                                            @enderror
                                        </div> 

                                        <div class="form-group">
                                            <label for="terjual">Jumlah Terjual:</label>
                                            <input type="text" class="form-control" id="terjual" name="terjual" placeholder="Masukan jumlah...">
                                            @error('terjual')
                                            <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                        
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- GARIS --}}
            <div class="hr-3 mb-5">
                <hr>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Table Penjualan Produk</h3>
                    
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <form action="{{ route("penjualan") }}" method="GET">
                                    <input type="search" name="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search...">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                    @if(collect($produk)->isEmpty())
                                            
                        <div class="d-flex flex-column">
                            <h1 style="text-align: center; margin-top: 175px;">Data tidak ditemukan...</h1>
                            <div class="d-flex justify-content-center align-items-center" style="margin: 155px 20px 20px 90%">
                                <button class="tambah"><a href="{{ route('penjualan') }}" style="width: 120px">Kembali</a></button>
                            </div>
                        </div>
                        
                    @else

                        <div class="table-responsive">

                            <div class="card-body">
            
                                <table id="dataPenjualan" class="table table-bordered table-hover">

                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th> 
                                                <th>Nama Produk</th>
                                                <th>Jenis Produk</th>
                                                <th>Stok Produk</th>
                                                <th>Harga Produk</th>
                                                <th>Jumlah Terjual</th>
                                                <th>Total</th>
                                                @if(Auth::user()->level === 'admin')
                                                    <th style="width: 120px; text-align:center;">Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                    
                                    @foreach ($produk as $p)
                                        <tbody>
                                            <tr class="td-p">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="ovfl-text">{{ $p->namaProduk }}</td>
                                                <td>{{ $p->jenisProduk }}</td>
                                                <td>{{ $p->stokProduk }}</td>
                                                <td>Rp. {{ $p->hargaProduk }}</td>
                                                <td> {{ $p->terjual }} </td>
                                                
                                                <td>Rp. {{ $p->totalSatuan }}</td>
                                                @if(Auth::user()->level === 'admin')
                                                    <td class="text-center">
                                                        
                                                        
                                                        <a data-toggle="modal" data-target="#modal-hapus{{ $p->id }}" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>

                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>

                                        <div class="modal fade" id="modal-hapus{{ $p->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data Penjualan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah kamu yakin ingin menghapus data penjualan <b>{{ $p->namaProduk }}</b> <s>( {{ $p->id }} )</s></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('penjualan.delete',['id' => $p->id]) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-default mr-auto" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Ya, Hapus data</button>  
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                        
                                </table>

                                <div class="d-flex mt-3">     
                                    <div class="mr-auto my-auto">
                                        <h3 class="card-title">Total penjualan semua produk: <span style="font-weight: bold">Rp. {{ $p->totalPenjualan = $totalPenjualan }}</span></h3>
                                    </div>
                                    {{-- <div>
                                        {!! $pata->links() !!}
                                    </div> --}}
                                    {{-- <form class="ml-auto card-tools" action="" method="">
                                        <button type="submit" class="btn btn-secondary">
                                            Save Data
                                        </button>
                                    </form> --}}
                                </div>
            
                            </div>
                        </div>

                    @endif

            </div>

        </div>
    </div>
@endsection