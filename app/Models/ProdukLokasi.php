<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukLokasi extends Model
{
    use HasFactory;

    protected $table = 'produk_lokasi';

    protected $fillable = [
        'produk_id',
        'lokasi_id',
        'stok',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function mutasis()
    {
        return $this->hasMany(Mutasi::class);
    }
}
