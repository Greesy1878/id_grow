@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Mutasi</h1>

    <form action="{{ route('mutasi.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="produk_id" class="block font-medium">Produk</label>
            <select name="produk_id" id="produk_id" class="border p-2 w-full">
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                @endforeach
            </select>
            @error('produk_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="lokasi_asal_id" class="block font-medium">Lokasi Asal</label>
            <select name="lokasi_asal_id" id="lokasi_asal_id" class="border p-2 w-full">
                @foreach($lokasis as $lokasi)
                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                @endforeach
            </select>
            @error('lokasi_asal_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="lokasi_tujuan_id" class="block font-medium">Lokasi Tujuan</label>
            <select name="lokasi_tujuan_id" id="lokasi_tujuan_id" class="border p-2 w-full">
                @foreach($lokasis as $lokasi)
                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                @endforeach
            </select>
            @error('lokasi_tujuan_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="jumlah" class="block font-medium">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="border p-2 w-full" value="{{ old('jumlah') }}">
            @error('jumlah') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="tanggal" class="block font-medium">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="border p-2 w-full" value="{{ old('tanggal') }}">
            @error('tanggal') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('mutasi.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
    </form>
</div>
@endsection
