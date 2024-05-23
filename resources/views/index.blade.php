@extends('layout.main')



@section('content')
    <div class="content-wrapper">

        <div class="container-pkks">

            <div class="title">
                <h2>Dashboard</h2>                
            </div>
            <div class="hr">
                <hr>
            </div>

            <div class="card-welcome">
                <div class="card-1">
                    <h4>Selamat Datang <span style="color: cyan">{{ Auth::user()->name }}</span></h4>
                </div>
                <div class="card-2">
                    <p>Website Pembukuan Penjualan Koperasi Sekolah Menengah Kejuruan Negeri 2 Banjarmasin</p>
                </div>
                <div>
                    <img src="{{ asset('image/cont.png') }}" class="image-card">  
                </div>
            </div>

            <div class="hr-2">
                <hr>
            </div>
                
            <div class="title-2">
                <h2>Activity</h2>                
            </div>


            <main class="main-activity">

                @if(Auth::user()->level === 'admin')
                    <div class="card-activity">
                        <div class="icon-activity">
                            <img src="{{ asset('image/user.png') }}" alt="user">
                        </div>
                        <div class="d-flex">
                            <h2 class="mr-2">( <span>{{ $totalData1 }}</span>  )</h2>
                            <h2 class="">Data User</h2>
                        </div>
                        <button class="btn button-activity">
                            <a href="{{ route('user') }}">Buka</a>
                        </button>
                    </div>
                @endif

                <div class="card-activity">
                    <div class="icon-activity">
                        <img src="{{ asset('image/folder.png') }}" alt="user">
                    </div>
                    <div class="d-flex">
                        <h2 class="mr-2">( <span>{{ $totalData2 }}</span>  )</h2>
                        <h2 class="">Data Produk</h2>
                    </div>
                    <button class="btn button-activity">
                        <a href="{{ route('produk') }}">Buka</a>
                    </button>
                </div>

                <div class="card-activity">
                    <div class="icon-activity">
                        <img src="{{ asset('image/folder.png') }}" alt="user">
                    </div>
                    <div class="d-flex">
                        <h2 class="mr-2">( <span>{{ $totalData3 }}</span>  )</h2>
                        <h2 class="">Data Penjualan</h2>
                    </div>
                    <button class="btn button-activity">
                        <a href="{{ route('penjualan') }}">Buka</a>
                    </button>
                </div>

                <div class="card-activity">
                    <div class="icon-activity">
                        <img src="{{ asset('image/folder.png') }}" alt="user">
                    </div>
                    <div class="d-flex">
                        <h2 class="">Laporan Penjualan Bulanan</h2>
                    </div>
                    <button class="btn button-activity">
                        <a href="{{ route('laporan') }}">Buka</a>
                    </button>
                </div>

                {{-- <div class="card-activity">
                    <div class="icon-activity">
                        <img src="{{ asset('image/folder.png') }}" alt="user">
                    </div>
                    <h2>Data Hasil Penjualan</h2>
                    <div class="button-activity">
                        <a href="{{ route('admin.dashboard') }}">Buka</a>
                    </div>
                </div> --}}




            </main>

        </div>

    </div>
@endsection