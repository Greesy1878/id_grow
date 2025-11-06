<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Produk;
use App\Models\Lokasi;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MutasiController extends Controller
{
    public function index()
    {
        // ambil mutasi beserta relasi user, produk, dan lokasi melalui pivot
        $mutasis = Mutasi::with([
            'user',
            'produkLokasi.produk',
            'produkLokasi.lokasi'
        ])->orderBy('tanggal', 'desc')->get();

        return view('mutasi.index', compact('mutasis'));
    }

    public function create()
    {
        $produks = Produk::all();
        $lokasis = Lokasi::all();
        return view('mutasi.create', compact('produks', 'lokasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {
            // cari atau buat stok produk di lokasi tertentu
            $produkLokasi = ProdukLokasi::firstOrCreate(
                ['produk_id' => $request->produk_id, 'lokasi_id' => $request->lokasi_id],
                ['stok' => 0]
            );

            // update stok sesuai jenis mutasi
            if ($request->jenis_mutasi === 'masuk') {
                $produkLokasi->stok += $request->jumlah;
            } else {
                if ($produkLokasi->stok < $request->jumlah) {
                    abort(400, 'Stok tidak mencukupi.');
                }
                $produkLokasi->stok -= $request->jumlah;
            }
            $produkLokasi->save();

            // simpan mutasi
            Mutasi::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'produk_lokasi_id' => $produkLokasi->id,
                'tanggal' => Carbon::parse($request->tanggal),
                'jenis_mutasi' => $request->jenis_mutasi,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil ditambahkan.');
    }

    public function edit(Mutasi $mutasi)
    {
        $produks = Produk::all();
        $lokasis = Lokasi::all();
        return view('mutasi.edit', compact('mutasi', 'produks', 'lokasis'));
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $mutasi) {
            // rollback stok lama
            if ($mutasi->jenis_mutasi === 'masuk') {
                $mutasi->produkLokasi->stok -= $mutasi->jumlah;
            } else {
                $mutasi->produkLokasi->stok += $mutasi->jumlah;
            }
            $mutasi->produkLokasi->save();

            // ambil pivot baru
            $produkLokasi = ProdukLokasi::firstOrCreate(
                ['produk_id' => $request->produk_id, 'lokasi_id' => $request->lokasi_id],
                ['stok' => 0]
            );

            // update stok baru
            if ($request->jenis_mutasi === 'masuk') {
                $produkLokasi->stok += $request->jumlah;
            } else {
                if ($produkLokasi->stok < $request->jumlah) {
                    abort(400, 'Stok tidak mencukupi.');
                }
                $produkLokasi->stok -= $request->jumlah;
            }
            $produkLokasi->save();

            // update data mutasi
            $mutasi->update([
                'produk_lokasi_id' => $produkLokasi->id,
                'tanggal' => Carbon::parse($request->tanggal),
                'jenis_mutasi' => $request->jenis_mutasi,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil diperbarui.');
    }

    public function destroy(Mutasi $mutasi)
    {
        DB::transaction(function () use ($mutasi) {
            // rollback stok sebelum hapus mutasi
            if ($mutasi->jenis_mutasi === 'masuk') {
                $mutasi->produkLokasi->stok -= $mutasi->jumlah;
            } else {
                $mutasi->produkLokasi->stok += $mutasi->jumlah;
            }
            $mutasi->produkLokasi->save();

            $mutasi->delete();
        });

        return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil dihapus.');
    }
}
