<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = Carbon::now();

        for ($i = 0; $i < 25; $i++) {
            $createdAt = $currentDate->copy()->subDays(rand(0, 365));
            
            DB::table('tb_penjualan')->insert([
                'idProduk' => 'PRD-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'terjual' => rand(20, 50),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
