@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-700">Edit Barang</h3>
    <p class="text-gray-500 text-sm mt-1">Perbarui informasi barang dan catat kerusakan baru.</p>
</div>

<div class="max-w-2xl">
    <div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-t-4 border-yellow-500">
        
        <form action="{{ route('items.update', $item->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                <select name="category_id" required 
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                <input type="text" name="name" value="{{ $item->name }}" required
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Total Stok Keseluruhan</label>
                <input type="number" name="total" value="{{ $item->total }}" min="1" required
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2 bg-gray-50">
                <p class="text-xs text-gray-400 mt-1">*Ubah ini jika ada penambahan/pengurangan aset fisik.</p>
            </div>

            <div class="bg-red-50 p-4 rounded-md border border-red-100">
                <label class="block text-red-700 font-bold mb-2 text-sm uppercase">Tambah Barang Rusak Baru (New Broke Item)</label>
                <input type="number" name="new_broke_item" value="0" min="0" 
                    class="w-full border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm border p-2 text-red-600 font-bold">
                
                @error('new_broke_item')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror

                @php
                    $stokTersedia = $item->total - $item->repair - $item->lending;
                @endphp
                <div class="mt-3 flex justify-between text-xs font-medium">
                    <span class="text-gray-600">Rusak Saat Ini: <b class="text-red-600">{{ $item->repair }}</b></span>
                    <span class="text-gray-600">Stok Tersedia: <b class="text-green-600">{{ $stokTersedia }}</b></span>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition duration-200">
                    Update Barang
                </button>
                <a href="{{ route('items.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow transition duration-200">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection