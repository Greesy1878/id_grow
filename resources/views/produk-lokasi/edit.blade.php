@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Produk Lokasi</h1>

    <form action="{{ route('produk-lokasi.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Produk</label>
            <select name="produk_id" class="form-control" required>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}" {{ $item->produk_id == $produk->id ? 'selected' : '' }}>{{ $produk->nama_produk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <select name="lokasi_id" class="form-control" required>
                @foreach($lokasis as $lokasi)
                    <option value="{{ $lokasi->id }}" {{ $item->lokasi_id == $lokasi->id ? 'selected' : '' }}>{{ $lokasi->nama_lokasi }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $item->stok }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('produk-lokasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
