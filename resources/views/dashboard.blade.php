<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Halo, {{ Auth::user()->name }}!</h3>
                <p class="mt-2 text-sm text-gray-600">
                    You're logged in!
                </p>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Daftar Produk</h3>
                @if($produks->count() > 0)
                    <table class="min-w-full border">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2 text-left">Kode</th>
                                <th class="px-4 py-2 text-left">Nama</th>
                                <th class="px-4 py-2 text-left">Kategori</th>
                                <th class="px-4 py-2 text-left">Satuan</th>
                                <th class="px-4 py-2 text-left">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produks as $produk)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $produk->kode_produk }}</td>
                                    <td class="px-4 py-2">{{ $produk->nama_produk }}</td>
                                    <td class="px-4 py-2">{{ $produk->kategori }}</td>
                                    <td class="px-4 py-2">{{ $produk->satuan }}</td>
                                    <td class="px-4 py-2">{{ number_format($produk->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada produk.</p>
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Daftar Lokasi</h3>
                @if($lokasis->count() > 0)
                    <table class="min-w-full border">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2 text-left">Kode</th>
                                <th class="px-4 py-2 text-left">Nama</th>
                                <th class="px-4 py-2 text-left">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lokasis as $lokasi)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $lokasi->kode_lokasi }}</td>
                                    <td class="px-4 py-2">{{ $lokasi->nama_lokasi }}</td>
                                    <td class="px-4 py-2">{{ $lokasi->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada lokasi.</p>
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Riwayat Mutasi</h3>
                @if($mutasis->count() > 0)
                    <table class="min-w-full border">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">User</th>
                                <th class="px-4 py-2 text-left">Produk</th>
                                <th class="px-4 py-2 text-left">Lokasi</th>
                                <th class="px-4 py-2 text-left">Jenis Mutasi</th>
                                <th class="px-4 py-2 text-left">Jumlah</th>
                                <th class="px-4 py-2 text-left">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mutasis as $mutasi)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $mutasi->tanggal }}</td>
                                    <td class="px-4 py-2">{{ $mutasi->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $mutasi->produk->nama_produk ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $mutasi->lokasi->nama_lokasi ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $mutasi->jenis_mutasi }}</td>
                                    <td class="px-4 py-2">{{ $mutasi->jumlah }}</td>
                                    <td class="px-4 py-2">{{ $mutasi->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada mutasi.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
