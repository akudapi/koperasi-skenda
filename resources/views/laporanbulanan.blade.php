@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="container-pkks" style="font-family: 'Poppins'; ">
        {{-- JUDUL --}}
        <div class="title d-flex flex-row">
            <div>
                <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Laporan Penjualan Koperasi Bulan - {{ $monthName }} {{ $year }}</h2>
            </div>
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

            <div class="card-body">
                <table id="dataPenjualan" class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th class="text-center">No</th> 
                            <th>Nama Produk</th>
                            <th>Jenis Produk</th>
                            <th>Stok Produk</th>
                            <th>Harga Produk</th>
                            <th>Jumlah Terjual</th>
                            <th>Total</th>
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
                            </tr>
                        </tbody>
                    @endforeach

                </table>
                    
                    <div class="d-flex mt-3">     
                        <div class="mr-auto my-auto">
                            <h3 class="card-title">Total penjualan semua produk: <span style="font-weight: bold">Rp. {{ $totalPenjualan }}</span></h3>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
