@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-700">Edit Kategori</h3>
    <p class="text-gray-500 text-sm mt-1">Ubah informasi kategori dan penanggung jawab.</p>
</div>

<div class="max-w-2xl">
    <div class="bg-white overflow-hidden shadow-md rounded-lg p-6">
        
        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ $category->name }}" required
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Penanggung Jawab</label>
                <select name="user_id" required 
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                    <option value="">-- Pilih Penanggung Jawab --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $category->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->role }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition duration-200">
                    Simpan Perubahan
                </button>
                <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded shadow transition duration-200">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection