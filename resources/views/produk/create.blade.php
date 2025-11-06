@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

    <form action="{{ route('produk.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="kode_produk" class="block font-medium">Kode Produk</label>
            <input type="text" name="kode_produk" id="kode_produk" class="border p-2 w-full" value="{{ old('kode_produk') }}">
            @error('kode_produk') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="nama_produk" class="block font-medium">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" class="border p-2 w-full" value="{{ old('nama_produk') }}">
            @error('nama_produk') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="kategori" class="block font-medium">Kategori</label>
            <input type="text" name="kategori" id="kategori" class="border p-2 w-full" value="{{ old('kategori') }}">
            @error('kategori') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="satuan" class="block font-medium">Satuan</label>
            <input type="text" name="satuan" id="satuan" class="border p-2 w-full" value="{{ old('satuan') }}">
            @error('satuan') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="harga" class="block font-medium">Harga</label>
            <input type="number" name="harga" id="harga" class="border p-2 w-full" value="{{ old('harga') }}">
            @error('harga') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="min_stok" class="block font-medium">Minimal Stok</label>
            <input type="number" name="min_stok" id="min_stok" class="border p-2 w-full" value="{{ old('min_stok') }}">
            @error('min_stok') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="deskripsi" class="block font-medium">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="border p-2 w-full">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <span class="text-red-500">{{ $messa
