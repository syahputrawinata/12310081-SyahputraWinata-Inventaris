@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold text-gray-700">Riwayat Peminjaman</h3>
        <p class="text-gray-500 text-sm mt-1">
            Barang: <span class="font-bold text-blue-600">{{ $items->name }}</span>
        </p>
    </div>
    <a href="{{ route('items.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow transition duration-200 text-sm">
        ← Kembali
    </a>
</div>

<div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-t-4 border-blue-500">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 font-semibold text-sm w-12 text-center">No</th>
                    <th class="p-3 font-semibold text-sm">Nama Peminjam</th>
                    <th class="p-3 font-semibold text-sm text-center">Jumlah</th>
                    <th class="p-3 font-semibold text-sm text-center">Tgl Pinjam</th>
                    <th class="p-3 font-semibold text-sm text-center">Tgl Kembali</th>
                    <th class="p-3 font-semibold text-sm text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lendings as $index => $lending)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 text-sm text-center text-gray-500">{{ $index + 1 }}</td>
                    <td class="p-3 text-sm font-medium text-gray-800">{{ $lending->borrower_name }}</td>
                    <td class="p-3 text-sm text-center font-bold text-gray-700">{{ $lending->amount_borrowed }}</td>
                    <td class="p-3 text-sm text-center text-gray-600">
                        {{ \Carbon\Carbon::parse($lending->borrow_date)->format('d M Y') }}
                    </td>
                    <td class="p-3 text-sm text-center text-gray-600">
                        @if($lending->return_date)
                            {{ \Carbon\Carbon::parse($lending->return_date)->format('d M Y') }}
                        @else
                            <span class="text-gray-400 italic">Belum Kembali</span>
                        @endif
                    </td>
                    <td class="p-3 text-sm text-center">
                        @if($lending->status == 'dipinjam')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                Dipinjam
                            </span>
                        @else
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                Selesai
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400 italic">
                        Belum ada riwayat peminjaman untuk barang ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection