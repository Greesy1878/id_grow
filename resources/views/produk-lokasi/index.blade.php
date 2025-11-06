@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Produk Lokasi</h1>
    <a href="{{ route('produk-lokasi.create') }}" class="btn btn-primary mb-3">Tambah Produk Lokasi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produk</th>
                <th>Lokasi</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                <td>{{ $item->lokasi->nama_lokasi ?? '-' }}</td>
                <td>{{ $item->stok }}</td>
                <td>
                    <a href="{{ route('produk-lokasi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('produk-lokasi.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
