<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;

class LokasiApiController extends Controller
{
    public function index()
    {
        return response()->json(Lokasi::with('produk')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_lokasi' => 'required|string|max:100|unique:lokasi,kode_lokasi',
            'nama_lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tipe' => 'required|string',
            'alamat' => 'nullable|string', 
            'kapasitas' => 'required|integer|min:0',
            
        ]);

        $lokasi = Lokasi::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Lokasi berhasil dibuat',
            'data' => $lokasi
        ], 201);
    }

    public function show($id)
    {
        $lokasi = Lokasi::with('produk')->findOrFail($id);
        return response()->json($lokasi);
    }

    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $validated = $request->validate([
            'kode_lokasi' => 'required|string|max:100|unique:lokasi,kode_lokasi,' . $lokasi->id,
            'nama_lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tipe' => 'required|string',
            'alamat' => 'nullable|string', 
            'kapasitas' => 'required|integer|min:0',
            
        ]);

        $lokasi->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Lokasi berhasil diperbarui',
            'data' => $lokasi
        ]);
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return response()->json(['status' => true, 'message' => 'Lokasi berhasil dihapus']);
    }

    public function produkList($lokasiId)
    {
        $lokasi = Lokasi::with('produk')->findOrFail($lokasiId);
        return response()->json($lokasi->produk);
    }

    public function addProduk(Request $request, $lokasiId)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'stok' => 'required|integer|min:0',
        ]);

        $pivot = ProdukLokasi::firstOrCreate(
            ['produk_id' => $request->produk_id, 'lokasi_id' => $lokasiId],
            ['stok' => 0]
        );

        $pivot->stok += (int)$request->stok;
        $pivot->save();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditambahkan/diupdate di lokasi',
            'data' => $pivot
        ]);
    }
}
