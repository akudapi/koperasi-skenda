<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = Carbon::now();

        for ($i = 0; $i < 50; $i++) {
            $createdAt = $currentDate->copy()->subDays(rand(0, 365));
            
            DB::table('tb_produk')->insert([
                'idProduk' => 'PRD-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'namaProduk' => 'Produk ' . ($i + 1),
                'jenisProduk' => ['Aksesoris', 'Alat Tulis', 'Seragam'][rand(0, 2)],
                'hargaProduk' => rand(1000, 100000),
                'stokProduk' => rand(20, 100),
                'gambarProduk' => 'gambarproduk.png',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
