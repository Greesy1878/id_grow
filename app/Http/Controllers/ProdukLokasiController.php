<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Lokasi;
use App\Models\ProdukLokasi;

class ProdukLokasiController extends Controller
{
    public function index()
    {
        $data = ProdukLokasi::with(['produk', 'lokasi'])->get();
        return view('produk-lokasi.index', compact('data'));
    }

    public function create()
    {
        $produks = Produk::all();
        $lokasis = Lokasi::all();
        return view('produk-lokasi.create', compact('produks', 'lokasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'stok' => 'required|integer|min:0'
        ]);

        ProdukLokasi::create($request->all());
        return redirect()->route('produk-lokasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = ProdukLokasi::findOrFail($id);
        $produks = Produk::all();
        $lokasis = Lokasi::all();
        return view('produk-lokasi.edit', compact('item', 'produks', 'lokasis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'stok' => 'required|integer|min:0'
        ]);

        $item = ProdukLokasi::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('produk-lokasi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $item = ProdukLokasi::findOrFail($id);
        $item->delete();

        return redirect()->route('produk-lokasi.index')->with('success', 'Data berhasil dihapus');
    }
}
