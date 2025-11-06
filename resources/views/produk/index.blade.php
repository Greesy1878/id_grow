@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

    <a href="{{ route('produk.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Produk</a>

    <table class="table-auto w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Kode</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Kategori</th>
                <th class="px-4 py-2 border">Satuan</th>
                <th class="px-4 py-2 border">Harga</th>
                <th class="px-4 py-2 border">Min Stok</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
            <tr>
                <td class="px-4 py-2 border">{{ $produk->kode_produk }}</td>
                <td class="px-4 py-2 border">{{ $produk->nama_produk }}</td>
                <td class="px-4 py-2 border">{{ $produk->kategori }}</td>
                <td class="px-4 py-2 border">{{ $produk->satuan }}</td>
                <td class="px-4 py-2 border">{{ number_format($produk->harga, 0, ',', '.') }}</td>
                <td class="px-4 py-2 border">{{ $produk->min_stok }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('produk.edit', $produk->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus produk ini?')">
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
