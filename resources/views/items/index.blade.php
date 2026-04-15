@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold text-gray-700">Daftar Inventaris Barang</h3>
        <p class="text-gray-500 text-sm mt-1">Manajemen stok, barang rusak, dan peminjaman.</p>
    </div>
    <div class="flex gap-2">
        <a class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export Excel
        </a>
        <a class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
            + Tambah Data
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-sm">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 font-semibold text-sm w-12 text-center">No</th>
                    <th class="p-3 font-semibold text-sm">Nama Barang</th>
                    <th class="p-3 font-semibold text-sm">Kategori</th>
                    <th class="p-3 font-semibold text-sm text-center">Total Aset</th>
                    <th class="p-3 font-semibold text-sm text-center text-green-600">Tersedia</th>
                    <th class="p-3 font-semibold text-sm text-center text-blue-600">Dipinjam</th>
                    <th class="p-3 font-semibold text-sm text-center text-red-600">Rusak</th>
                    <th class="p-3 font-semibold text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- logic -->
                
                    <!-- @php perhitungan -->


                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3 text-sm text-center text-gray-500">1</td>
                        <td class="p-3 text-sm font-medium text-gray-800">Nama</td>
                        <td class="p-3 text-sm">
                            <span class="bg-gray-100 px-2 py-1 rounded text-xs text-gray-600 uppercase font-semibold">
                                Kategori
                            </span>
                        </td>
                        <td class="p-3 text-sm text-center font-bold">Total</td>
                        <td class="p-3 text-sm text-center font-bold text-green-600">10</td>
                        <td class="p-3 text-sm text-center font-bold text-blue-600">
                            <!-- logic jumlah peminjaman -->
                                <a class="underline decoration-blue-300 hover:text-blue-800">
                                    1
                                </a>
                                0
                        </td>
                        <td class="p-3 text-sm text-center font-bold text-red-600">2</td>
                        <td class="p-3 text-sm">
                            <div class="flex justify-center gap-3">
                                <a class="text-yellow-600 hover:text-yellow-800 font-bold uppercase text-xs transition">Edit</a>
                                
                                <!-- form delete -->
                                <button type="submit" class="text-red-600 hover:text-red-800 font-bold uppercase text-xs transition">Hapus</button>
                            </div>
                        </td>
                    </tr>
                
                    <tr>
                        <td colspan="8" class="p-6 text-center text-gray-400 italic">Belum ada data barang tersedia.</td>
                    </tr>
                    
            </tbody>
        </table>
    </div>
</div>
@endsection