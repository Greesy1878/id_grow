<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Lokasi;

class ProdukLokasiSeeder extends Seeder
{
    public function run(): void
    {
        $produk1 = Produk::where('kode_produk', 'PRD001')->first();
        $produk2 = Produk::where('kode_produk', 'PRD002')->first();

        $lokasi1 = Lokasi::where('kode_lokasi', 'LOC001')->first();
        $lokasi2 = Lokasi::where('kode_lokasi', 'LOC002')->first();

        // cek apakah produk dan lokasi ada
        if ($produk1 && $lokasi1) {
            $produk1->lokasi()->attach($lokasi1->id, ['stok' => 50]);
        }

        if ($produk1 && $lokasi2) {
            $produk1->lokasi()->attach($lokasi2->id, ['stok' => 20]);
        }

        if ($produk2 && $lokasi1) {
            $produk2->lokasi()->attach($lokasi1->id, ['stok' => 30]);
        }

        if ($produk2 && $lokasi2) {
            $produk2->lokasi()->attach($lokasi2->id, ['stok' => 15]);
        }
    }
}
