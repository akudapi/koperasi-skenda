@extends('layout.main')



@section('content')
    <div class="content-wrapper">

        <div class="container-pkks">

            <div class="title d-flex flex-row">
                <div>
                    <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Table Hasil Penjualan Koperasi</h2>
                </div>
                <div class="ml-auto">
                    <button class="tambah"><a href="">Tambah Data</a></button>
                </div>
            </div>
            <div class="hr-3">
                <hr>
            </div>

            <main class="main-activity poppins">

                <table border="none" class="text-center bg-white mt-5">
                    <thead style="font-size: 20px;">
                        <tr>
                            <th>Id Penjualan</th>
                            <th>Id Produk</th>
                            <th>Nama Produk</th>
                            <th>Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr style="font-size: 20px;">
                                <td class="py-3">{{ $d->idPenjualan }}</td>
                                <td class="col-6">{{ $d->idProduk }}</td>
                                <td class="col-2">{{ $d->namaProduk }}</td>
                                <td class="col-2">{{ $d->penjualan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </main>

        </div>

    </div>
@endsection