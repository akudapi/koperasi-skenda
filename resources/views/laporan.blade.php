@extends('layout.main')

@section('content')
<div class="content-wrapper">

    <div class="container-pkks" style="font-family: 'Poppins'; ">
        
            {{-- JUDUL --}}
            <div class="title d-flex flex-row">
                <div>
                    <h2><span class="mr-4"><i class="fa-solid fa-cart-shopping"></i></span>Laporan Penjualan Bulanan Koperasi</h2>
                </div>
            </div>

            {{-- GARIS --}}
            <div class="hr-3 mb-5">
                <hr>
            </div>

            <div class="card">
                <ul class="list-group list-group-flush">
                    @foreach ($data as $yearData)
                        <li class="list-group-item">
                            <h3 style="margin-bottom: 10px;">Tahun {{ $yearData['year'] }}</h3>
                            <ul>
                                @foreach ($yearData['months'] as $month)
                                    @php
                                        \Carbon\Carbon::setLocale('id');
                                        $tanggal = \Carbon\Carbon::create($month['year'], $month['month'], 1);
                                    @endphp
                                    <li style="display: flex; flex-direction: row; margin-bottom: 8px;">
                                        <p style="display: flex; margin-top: auto; margin-bottom:auto;">Bulan {{ $tanggal->format('F') }}, Tahun {{ $tanggal->format('Y') }}</p>
                                        <a style="margin-left: auto" href="{{ route('laporan.bulanan', ['month' => $month['month'], 'year' => $month['year']]) }}" class="btn btn-primary">Buka</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>

    </div>

</div>
@endsection