@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Mutasi</h1>

    <a href="{{ route('mutasi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Mutasi</a>

    <table class="table-auto w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Produk</th>
                <th class="px-4 py-2 border">Lokasi Asal</th>
                <th class="px-4 py-2 border">Lokasi Tujuan</th>
                <th class="px-4 py-2 border">Jumlah</th>
                <th class="px-4 py-2 border">Tanggal</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mutasis as $mutasi)
            <tr>
                <td class="px-4 py-2 border">{{ $mutasi->produk->nama_produk }}</td>
                <td class="px-4 py-2 border">{{ $mutasi->lokasiAsal->nama_lokasi }}</td>
                <td class="px-4 py-2 border">{{ $mutasi->lokasiTujuan->nama_lokasi }}</td>
                <td class="px-4 py-2 border">{{ $mutasi->jumlah }}</td>
                <td class="px-4 py-2 border">{{ $mutasi->tanggal }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('mutasi.edit', $mutasi->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('mutasi.destroy', $mutasi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus mutasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection