@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-700">Edit Pengguna</h3>
    <p class="text-gray-500 text-sm mt-1">Perbarui informasi akun atau ubah hak akses pengguna.</p>
</div>

<div class="max-w-2xl">
    <div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-t-4 border-yellow-500">
        
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name }}" required
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ $user->email }}" required
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2 bg-gray-50">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Role / Hak Akses</label>
                <select name="role" required 
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
            </div>

            <div class="pt-2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru (Opsional)</label>
                <input type="password" name="password" 
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                <p class="text-xs text-gray-400 mt-1 italic">*Kosongkan jika tidak ingin mengubah password.</p>
            </div>

            <div class="flex items-center gap-3 pt-6 border-t">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded shadow transition duration-200">
                    Simpan Perubahan
                </button>
                <a href="{{ route('users.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-8 rounded transition duration-200">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection