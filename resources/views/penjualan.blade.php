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

                @if($data->count())
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
                                    <th>Stok Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Total</th>
                                    @if(Auth::user()->level === 'admin')
                                        <th >Action</th>
                                    @endif
                                </tr>
                            </thead>
                            
                            @foreach ($data as $d)
                                <tbody>
                                    <tr class="td-p">
                                        <td class="text-center">{{ $loop->iteration }}</td>
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
                                            @if ($d->penjualan->terjual)
                                                <td class="d-flex mx-auto">
                                                    <button class="btn btn-success mr-auto" data-toggle="modal" data-target="#modal-tambah-terjual{{ $d->idProduk }}"><i class="fas fa-plus"></i></button>
                                                    <button class="btn btn-danger ml-1" data-toggle="modal" data-target="#modal-kurang-terjual{{ $d->idProduk }}"><i class="fas fa-minus"></i></button>   
                                                </td>
                                            @else
                                                <td class="d-flex mx-auto">
                                                    <button class="btn btn-success col" data-toggle="modal" data-target="#modal-tambah-terjual{{ $d->idProduk }}"><i class="fas fa-plus"></i></button>
                                                </td>
                                            @endif

                                        @endif
                                    </tr>
                                </tbody>
                                
                                {{-- FORM POPUP MENAMBAHKAN PENJUALAN --}}
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
                                                        <label for="jumlah_terjual">Jumlah terjual:</label>
                                                        <input type="number" class="form-control" id="jumlah_terjual" name="jumlah_terjual" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- FORM POPUP MENGURANGI PENJUALAN --}}
                                <div class="modal fade" id="modal-kurang-terjual{{ $d->idProduk }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Kurangi Penjualan</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('penjualan.kurangi',['id' => $d->id]) }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="kurangi_terjual">Jumlah dikurangi:</label>
                                                        <input type="number" class="form-control" id="kurangi_terjual" name="kurangi_terjual" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                
                        </table>
    
                        <div class="d-flex mt-3">     
                            <div class="mr-auto my-auto">
                                <h3 class="card-title">Total penjualan semua produk: <span style="font-weight: bold">Rp. {{ $totalPenuh }}</span></h3>
                            </div>
                            <div>
                                {!! $data->links() !!}
                            </div>
                            {{-- <form class="ml-auto card-tools" action="" method="">
                                <button type="submit" class="btn btn-secondary">
                                    Save Data
                                </button>
                            </form> --}}
                        </div>
    
                    </div>
                </div>

                @else
                    
                    <div class="d-flex flex-column">
                        <h1 style="text-align: center; margin-top: 175px;">Data tidak ditemukan...</h1>
                        <div class="d-flex justify-content-center align-items-center" style="margin: 155px 20px 20px 90%">
                            <button class="tambah"><a href="{{ route('penjualan') }}" style="width: 120px">Kembali</a></button>
                        </div>
                    </div>
                    
                @endif

        </div>

    </div>
@endsection