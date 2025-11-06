<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function lokasi()
    {
        return $this->belongsToMany(Lokasi::class, 'produk_lokasi')->withPivot('stok')->withTimestamps();
    }
}
