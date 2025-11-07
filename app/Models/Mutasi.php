<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasi';

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

    // Relasi ke ProdukLokasi (pivot)
    public function produkLokasi()
    {
        return $this->belongsTo(ProdukLokasi::class);
    }
}
