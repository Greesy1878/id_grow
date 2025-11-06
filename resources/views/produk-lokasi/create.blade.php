@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Produk Lokasi</h1>

    <form action="{{ route('produk-lokasi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Produk</label>
            <select name="produk_id" class="form-control" required>
                <option value="">Pilih Produk</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <select name="lokasi_id" class="form-control" required>
                <option value="">Pilih Lokasi</option>
                @foreach($lokasis as $lokasi)
                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="0" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('produk-lokasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
