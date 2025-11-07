<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'satuan',
        'deskripsi',
        'harga',
        'min_stok',
        'sku'
    ];

    public function lokasis()
    {
        return $this->belongsToMany(Lokasi::class, 'produk_lokasi', 'produk_id', 'lokasi_id')
            ->withPivot('stok') 
            ->withTimestamps();
    }
}
