<?php

namespace App\Http\Controllers;

use App\Models\Tb_Penjualan;
use App\Models\Tb_Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class LaporanController extends Controller
{
    public function Laporan()
    {
        // Mengambil tahun unik dari tabel penjualan
        $years = Tb_Penjualan::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    
        // data array
        $data = [];
    
        // Loop melalui setiap tahun
        foreach ($years as $year) {
            $yearData = [];
    
            // Mengambil data bulan untuk tiap tahun
            $months = Tb_Penjualan::selectRaw('MONTH(created_at) as month')
                ->whereYear('created_at', $year->year)
                ->groupBy('month')
                ->orderBy('month')
                ->get();
    
            // mengulang menggunakan bulan untuk tahun tertentu
            foreach ($months as $month) {
                // menambahkan bulan ke tahun yang dipilih
                $yearData[] = [
                    'month' => $month->month,
                    'year' => $year->year
                ];
            }
    
            // Tambahkan data tahun ini ke data utama
            $data[] = [
                'year' => $year->year,
                'months' => $yearData
            ];
        }
    
        return view('laporan', compact('data'));
    }
    

    public function laporanbulanan($month, $year)
    {
        // Mengambil data penjualan dan informasi produk yang sesuai
        $produk = DB::select(
            'SELECT tb_produk.idProduk, tb_produk.namaProduk, tb_produk.jenisProduk, tb_produk.stokProduk, tb_produk.hargaProduk, tb_penjualan.id, tb_penjualan.terjual, (tb_penjualan.terjual * tb_produk.hargaProduk) AS totalSatuan
            FROM tb_produk
            LEFT JOIN tb_penjualan ON tb_produk.idProduk = tb_penjualan.idProduk
            WHERE tb_penjualan.terjual IS NOT NULL
            AND YEAR(tb_penjualan.created_at) = :year
            AND MONTH(tb_penjualan.created_at) = :month',
            ['year' => $year, 'month' => $month]
        );

        // Menghitung total penjualan hanya untuk bulan dan tahun yang sesuai
        $totalPenjualan = DB::selectOne(
            'SELECT SUM(tb_penjualan.terjual * tb_produk.hargaProduk) AS totalPenjualan 
            FROM tb_produk 
            JOIN tb_penjualan ON tb_produk.idProduk = tb_penjualan.idProduk
            WHERE YEAR(tb_penjualan.created_at) = :year
            AND MONTH(tb_penjualan.created_at) = :month',
            ['year' => $year, 'month' => $month]
        )->totalPenjualan;

        // Mengambil nama bulan
        $monthName = Carbon::createFromDate($year, $month, 1)->format('F');
    
        return view('laporanbulanan', compact('produk', 'year', 'month', 'monthName', 'totalPenjualan'));
    }

    public function cetak($month, $year)
    {
        // Mengambil data penjualan dan informasi produk yang sesuai
        $produk = DB::select(
            'SELECT tb_produk.idProduk, tb_produk.namaProduk, tb_produk.jenisProduk, tb_produk.stokProduk, tb_produk.hargaProduk, tb_penjualan.id, tb_penjualan.terjual, (tb_penjualan.terjual * tb_produk.hargaProduk) AS totalSatuan
            FROM tb_produk
            LEFT JOIN tb_penjualan ON tb_produk.idProduk = tb_penjualan.idProduk
            WHERE tb_penjualan.terjual IS NOT NULL
            AND YEAR(tb_penjualan.created_at) = :year
            AND MONTH(tb_penjualan.created_at) = :month',
            ['year' => $year, 'month' => $month]
        );
    
        // Menghitung total penjualan hanya untuk bulan dan tahun yang sesuai
        $totalPenjualan = DB::selectOne(
            'SELECT SUM(tb_penjualan.terjual * tb_produk.hargaProduk) AS totalPenjualan 
            FROM tb_produk 
            JOIN tb_penjualan ON tb_produk.idProduk = tb_penjualan.idProduk
            WHERE YEAR(tb_penjualan.created_at) = :year
            AND MONTH(tb_penjualan.created_at) = :month',
            ['year' => $year, 'month' => $month]
        )->totalPenjualan;
    
        // Mengambil nama bulan
        $monthName = Carbon::createFromDate($year, $month, 1)->format('F');
    
        // Generate the PDF
        $pdf = PDF::loadView('laporanbulanan_pdf', compact('produk', 'year', 'month', 'monthName', 'totalPenjualan'));
    
        return $pdf->download("Laporan_Bulanan_{$monthName}_{$year}.pdf");
    }

}
