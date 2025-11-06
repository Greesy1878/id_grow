<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukApiController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return response()->json([
            'status' => true,
            'message' => 'Data produk berhasil diambil',
            'data' => $produks
        ]);
    }

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
        ]);

        $produk = Produk::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dibuat',
            'data' => $produk
        ], 201);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json($produk);
    }

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
        ]);

        $produk->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
