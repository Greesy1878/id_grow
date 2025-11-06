<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Mutasi;
use App\Models\ProdukLokasi;

class MutasiApiController extends Controller
{
    /**
     * Tampilkan semua data mutasi beserta relasi.
     */
    public function index()
    {
        $mutasis = Mutasi::with([
            'user:id,name',
            'produkLokasi.produk:id,nama_produk',
            'produkLokasi.lokasi:id,nama_lokasi'
        ])
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data mutasi berhasil diambil',
            'data' => $mutasis
        ]);
    }

    /**
     * Simpan mutasi baru dan update stok.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'produk_id' => 'required|exists:produk,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // Ambil atau buat pivot Produk-Lokasi
            $produkLokasi = ProdukLokasi::firstOrCreate(
                [
                    'produk_id' => $validated['produk_id'],
                    'lokasi_id' => $validated['lokasi_id']
                ],
                ['stok' => 0]
            );

            // Update stok
            if ($validated['jenis_mutasi'] === 'masuk') {
                $produkLokasi->stok += $validated['jumlah'];
            } else {
                if ($produkLokasi->stok < $validated['jumlah']) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Stok tidak mencukupi'
                    ], 400);
                }
                $produkLokasi->stok -= $validated['jumlah'];
            }
            $produkLokasi->save();

            // Simpan mutasi
            $mutasi = Mutasi::create([
                'user_id' => Auth::id(),
                'produk_lokasi_id' => $produkLokasi->id,
                'tanggal' => Carbon::parse($validated['tanggal']),
                'jenis_mutasi' => $validated['jenis_mutasi'],
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'] ?? null
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Mutasi berhasil ditambahkan',
                'data' => $mutasi->load(['user', 'produkLokasi.produk', 'produkLokasi.lokasi'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Riwayat mutasi berdasarkan produk tertentu.
     */
    public function historyByProduk($produkId)
    {
        $mutasis = Mutasi::with(['user:id,name', 'produkLokasi.lokasi:id,nama_lokasi'])
            ->whereHas('produkLokasi.produk', function ($q) use ($produkId) {
                $q->where('id', $produkId);
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Riwayat mutasi produk berhasil diambil',
            'data' => $mutasis
        ]);
    }

    /**
     * Riwayat mutasi berdasarkan user tertentu.
     */
    public function historyByUser($userId)
    {
        $mutasis = Mutasi::with(['produkLokasi.produk:id,nama_produk', 'produkLokasi.lokasi:id,nama_lokasi'])
            ->where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Riwayat mutasi user berhasil diambil',
            'data' => $mutasis
        ]);
    }
}
