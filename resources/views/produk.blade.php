@extends('layout.main')



@section('content')
    <div class="content-wrapper">

        <div class="container-pkks">

            <div class="title d-flex flex-row">
                <div>
                    <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Table Data Produk Koperasi</h2>
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
                            <th class="py-3">No</th>
                            <th>Nama Produk</th>
                            <th>Jenis Produk</th>
                            <th>Harga Produk</th>
                            <th>Gambar Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr style="font-size: 20px;">
                                <td class="py-3">{{ $loop->iteration }}</td>
                                <td class="col-6">{{ $d->namaProduk }}</td>
                                <td class="col-2">{{ $d->jenisProduk }}</td>
                                <td class="col-2">{{ $d->hargaProduk }}</td>
                                <td style="width: 200px"><img src="{{ asset('image/'.$d->gambarProduk) }}" style="width: 200px" alt="FOTO PRODUK"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </main>

        </div>

    </div>
@endsection