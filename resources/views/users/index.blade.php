@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold text-gray-700">Manajemen Pengguna</h3>
        <p class="text-gray-500 text-sm mt-1">Kelola akun Admin dan Staff untuk sistem inventaris.</p>
    </div>
    <a href="{{ route('users.export') }}" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Export Excel
    </a>
</div>

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-sm">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-500 mb-8">
    @if (auth()->user()->role === 'admin')
    <h4 class="text-sm font-bold uppercase text-gray-500 mb-4 italic">+ Tambah Pengguna Baru</h4>
    <form action="{{ route('users.store') }}" method="POST" class="flex flex-wrap gap-4">
        @csrf
        <div class="flex-1 min-w-[200px]">
            <input type="text" name="name" placeholder="Nama Lengkap" required
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2 text-sm">
        </div>

        <div class="flex-1 min-w-[200px]">
            <input type="email" name="email" placeholder="Alamat Email" required
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2 text-sm">
        </div>

        <div class="flex-1 min-w-[150px]">
            <select name="role" required 
                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2 text-sm">
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition duration-200 text-sm">
            Tambah
        </button>
    </form>
    @endif
    
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b text-gray-700 uppercase text-xs">
                    <th class="p-4 font-bold w-16 text-center">No</th>
                    <th class="p-4 font-bold">Nama</th>
                    <th class="p-4 font-bold">Email</th>
                    <th class="p-4 font-bold text-center">Role</th>
                    <th class="p-4 font-bold text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($users as $index => $user)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-4 text-sm text-center text-gray-400">{{ $index + 1 }}</td>
                    <td class="p-4 text-sm font-semibold text-gray-800">{{ $user->name }}</td>
                    <td class="p-4 text-sm">{{ $user->email }}</td>
                    <td class="p-4 text-sm text-center">
                        @if($user->role == 'admin')
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Admin</span>
                        @else
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Staff</span>
                        @endif
                    </td>
                    <td class="p-4 text-sm">
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-600 hover:text-yellow-800 font-bold uppercase text-xs transition">Edit</a>
                            
                            @if(auth()->id() !== $user->id) {{-- Mencegah menghapus diri sendiri --}}
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-bold uppercase text-xs transition">Hapus</button>
                            </form>
                            @else
                            <span class="text-gray-300 text-xs italic font-bold uppercase">Aktif</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400 italic">Belum ada data pengguna terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection