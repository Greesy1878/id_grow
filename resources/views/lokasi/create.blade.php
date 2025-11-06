@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Lokasi</h1>

    <form action="{{ route('lokasi.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="kode_lokasi" class="block font-medium">Kode Lokasi</label>
            <input type="text" name="kode_lokasi" id="kode_lokasi" class="border p-2 w-full" value="{{ old('kode_lokasi') }}">
            @error('kode_lokasi') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="nama_lokasi" class="block font-medium">Nama Lokasi</label>
            <input type="text" name="nama_lokasi" id="nama_lokasi" class="border p-2 w-full" value="{{ old('nama_lokasi') }}">
            @error('nama_lokasi') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="keterangan" class="block font-medium">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="border p-2 w-full">{{ old('keterangan') }}</textarea>
            @error('keterangan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('lokasi.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
    </form>
</div>
@endsection
