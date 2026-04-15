@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-700">Tambah Barang Baru</h3>
    <p class="text-gray-500 text-sm mt-1">Masukkan data inventaris barang ke dalam sistem.</p>
</div>

<div class="max-w-2xl">
    <div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-t-4 border-blue-600">
        
        <form action="{{ route('items.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori Barang</label>
                <select name="category_id" required 
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                <input type="text" name="name" placeholder="Contoh: Laptop MacBook Air" required
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Total Stok Awal</label>
                <div class="flex items-center">
                    <input type="number" name="total" min="1" placeholder="0" required
                        class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                    <span class="ml-3 text-gray-500 text-sm italic">Unit</span>
                </div>
                <p class="text-xs text-gray-400 mt-1">*Stok ini akan otomatis masuk ke kategori "Tersedia".</p>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded shadow transition duration-200">
                    Simpan Barang
                </button>
                <a href="{{ route('items.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-8 rounded transition duration-200">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection