<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|string|max:100|unique:produk,kode_produk',
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'satuan' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric',
            'min_stok' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:produk,sku',
        ]);

        Produk::create($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|string|max:100|unique:produk,kode_produk,' . $produk->id,
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'satuan' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric',
            'min_stok' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:produk,sku,' . $produk->id,
        ]);

        $produk->update($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
