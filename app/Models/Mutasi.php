<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutations';

    protected $fillable = [
        'user_id',
        'produk_lokasi_id',
        'tanggal',
        'jenis_mutasi',
        'jumlah',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produkLokasi()
    {
        return $this->belongsTo(ProdukLokasi::class);
    }
    public function produk()
    {
        return $this->hasOneThrough(
            Produk::class,
            ProdukLokasi::class,
            'id',
            'id',
            'produk_lokasi_id',
            'produk_id'
        );
    }
    public function lokasi()
    {
        return $this->hasOneThrough(
            Lokasi::class,
            ProdukLokasi::class,
            'id',
            'id',
            'produk_lokasi_id',
            'lokasi_id'
        );
    }
}
