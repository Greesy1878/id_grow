@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Lokasi</h1>

    <a href="{{ route('lokasi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Lokasi</a>

    <table class="table-auto w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Kode Lokasi</th>
                <th class="px-4 py-2 border">Nama Lokasi</th>
                <th class="px-4 py-2 border">Keterangan</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lokasis as $lokasi)
            <tr>
                <td class="px-4 py-2 border">{{ $lokasi->kode_lokasi }}</td>
                <td class="px-4 py-2 border">{{ $lokasi->nama_lokasi }}</td>
                <td class="px-4 py-2 border">{{ $lokasi->keterangan }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('lokasi.edit', $lokasi->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>

                    <form action="{{ route('lokasi.destroy', $lokasi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus lokasi ini?')">
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
