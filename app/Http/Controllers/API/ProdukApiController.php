<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class ProdukApiController extends Controller
{
    // Tampilkan semua produk beserta lokasi
    public function index()
    {
        $produks = Produk::with('lokasis')->get(); // relasi Many-to-Many

        return response()->json([
            'status' => true,
            'message' => 'Data produk berhasil diambil',
            'data' => $produks
        ]);
    }

    // Simpan produk baru beserta lokasi (opsional)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|string|max:100|unique:produk,kode_produk',
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'satuan' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric|min:0',
            'min_stok' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100',
            'lokasi_ids' => 'nullable|array', // array ID lokasi
            'lokasi_ids.*' => 'exists:lokasi,id',
        ]);

        $produk = Produk::create($validated);

        // Jika ada lokasi, attach ke pivot table
        if (!empty($validated['lokasi_ids'])) {
            $produk->lokasis()->attach($validated['lokasi_ids']);
        }

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dibuat',
            'data' => $produk->load('lokasis')
        ], 201);
    }

    // Tampilkan produk tertentu beserta lokasi
    public function show($id)
    {
        $produk = Produk::with('lokasis')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $produk
        ]);
    }

    // Update produk dan relasi lokasi
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'kode_produk' => 'required|string|max:100|unique:produk,kode_produk,' . $produk->id,
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'satuan' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric|min:0',
            'min_stok' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100',
            'lokasi_ids' => 'nullable|array',
            'lokasi_ids.*' => 'exists:lokasi,id',
        ]);

        $produk->update($validated);

        // Sync lokasi jika diberikan
        if (isset($validated['lokasi_ids'])) {
            $produk->lokasis()->sync($validated['lokasi_ids']);
        }

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk->load('lokasis')
        ]);
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // detach semua lokasi terkait sebelum hapus
        $produk->lokasis()->detach();

        $produk->delete();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
