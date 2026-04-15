@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold text-gray-700">Riwayat Peminjaman Barang</h3>
        <p class="text-gray-500 text-sm mt-1">Daftar seluruh aktivitas peminjaman inventaris.</p>
    </div>
    <a href="{{ route('lendings.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Catat Peminjaman
    </a>
</div>

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-sm">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-sm">
    {{ session('error') }}
</div>
@endif

<div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-indigo-500">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 font-semibold text-sm w-12 text-center">No</th>
                    <th class="p-3 font-semibold text-sm">Nama Peminjam</th>
                    <th class="p-3 font-semibold text-sm">Nama Barang</th>
                    <th class="p-3 font-semibold text-sm">Staff(Pinjam)</th>
                    <th class="p-3 font-semibold text-sm text-center">Jumlah</th>
                    <th class="p-3 font-semibold text-sm text-center">Tgl Pinjam</th>
                    <th class="p-3 font-semibold text-sm text-center">Tgl Kembali</th>
                    <th class="p-3 font-semibold text-sm">Staff(Kembali)</th>
                    <th class="p-3 font-semibold text-sm text-center">Status</th>
                    <th class="p-3 font-semibold text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($lendings as $index => $lending)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 text-sm text-center text-gray-400">{{ $index + 1 }}</td>
                    <td class="p-3 text-sm font-bold text-gray-800">{{ $lending->borrower_name }}</td>
                    <td class="p-3 text-sm font-medium">{{ $lending->item->name }}</td>
                    <td class="p-3 text-sm font-medium">{{ $lending->user->name }}</td>
                    <td class="p-3 text-sm text-center">{{ $lending->amount_borrowed }}</td>
                    <td class="p-3 text-sm text-center">{{ \Carbon\Carbon::parse($lending->borrow_date)->format('d/m/Y') }}</td>
                    <td class="p-3 text-sm text-center">
                        {{ $lending->return_date ? \Carbon\Carbon::parse($lending->return_date)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="p-3 text-sm font-medium">{{ $lending->staffPenerima->name ?? '-' }}</td>
                    <td class="p-3 text-sm text-center">
                        @if($lending->status == 'borrowed')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold uppercase">Dipinjam</span>
                        @else
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold uppercase">Dikembalikan</span>
                        @endif
                    </td>
                    <td class="p-3 text-sm text-center">
                        @if($lending->status == 'borrowed')
                            <form action="{{ route('lendings.return', $lending->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pengembalian barang ini?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1 px-3 rounded text-xs transition shadow-sm">
                                    Kembalikan
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs italic">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-8 text-center text-gray-400 italic">Belum ada riwayat peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
