<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'kode_produk' => 'P001',
            'nama_produk' => 'Laptop',
            'kategori' => 'Elektronik',
            'satuan' => 'Unit',
            'deskripsi' => 'Laptop untuk keperluan kantor',
            'harga' => 15000000,
            'min_stok' => 5,
            'sku' => 'SKU001'
        ]);

        Produk::create([
            'kode_produk' => 'P002',
            'nama_produk' => 'Mouse',
            'kategori' => 'Aksesoris',
            'satuan' => 'Unit',
            'deskripsi' => 'Mouse Wireless',
            'harga' => 150000,
            'min_stok' => 10,
            'sku' => 'SKU002'
        ]);
    }
}
