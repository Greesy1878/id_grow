<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        Lokasi::create([
            'kode_lokasi' => 'LOC001',
            'nama_lokasi' => 'Gudang Utama',
            'keterangan' => 'Lokasi utama penyimpanan'
        ]);

        Lokasi::create([
            'kode_lokasi' => 'LOC002',
            'nama_lokasi' => 'Toko Cabang',
            'keterangan' => 'Lokasi cabang'
        ]);
    }
}
