@extends('layouts.app')

@section('content')
{{-- <div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-700">Daftar Kategori</h3>
    <p class="text-gray-500 text-sm mt-1">Kelola kategori barang dan penanggung jawabnya.</p>
</div> --}}

<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold text-gray-700">Manajemen Pengguna</h3>
        <p class="text-gray-500 text-sm mt-1">Kelola akun Admin dan Staff untuk sistem inventaris.</p>
    </div>
    <a href="{{ route('categories.export') }}" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Export Excel
    </a>
</div>

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm">
    {{ session('success') }}
</div>
@endif

<div class="bg-white overflow-hidden shadow-md rounded-lg p-6">
    <form action="{{ route('categories.store') }}" method="POST" class="mb-8 flex flex-wrap gap-4 items-end">
        @csrf
        <div class="w-full md:w-1/4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
            <input type="text" name="name" placeholder="Contoh: Elektronik" required
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
        </div>

        <div class="w-full md:w-1/4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Penanggung Jawab</label>
            <select name="user_id" required class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                <option value="">-- Pilih PJ --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition duration-200">
            + Tambah Kategori
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="border border-gray-200 px-4 py-3 w-16 text-center text-sm uppercase">No</th>
                    <th class="border border-gray-200 px-4 py-3 text-left text-sm uppercase">Nama Kategori</th>
                    <th class="border border-gray-200 px-4 py-3 text-left text-sm uppercase">Penanggung Jawab</th>
                    <th class="border border-gray-200 px-4 py-3 text-left text-sm uppercase">Jumlah Barang</th>
                    <th class="border border-gray-200 px-4 py-3 w-40 text-center text-sm uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($categories as $index => $category)
                <tr class="hover:bg-gray-50 transition">
                    <td class="border border-gray-200 px-4 py-3 text-center">{{ $index + 1 }}</td>
                    <td class="border border-gray-200 px-4 py-3 font-medium">{{ $category->name }}</td>
                    <td class="border border-gray-200 px-4 py-3">
                        <span class="px-2 py-1 bg-gray-100 rounded text-xs">
                            {{ $category->user->name ?? 'Tidak Ada PJ' }}
                        </span>
                    </td>
                    <td class="border border-gray-200 px-4 py-3 font-medium">{{ $category->item_count }}</td>
                    <td class="border border-gray-200 px-4 py-3">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}" 
                               class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-3 rounded text-xs transition">
                                Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border border-gray-200 px-4 py-8 text-center text-gray-400 italic">
                        Belum ada data kategori yang terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection