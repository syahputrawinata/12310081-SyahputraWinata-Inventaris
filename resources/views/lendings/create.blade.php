@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-700">Catat Peminjaman Baru</h3>
    <p class="text-gray-500 text-sm mt-1">Gunakan form ini untuk mendata barang yang keluar/dipinjam.</p>
</div>

<div class="max-w-2xl">
    <div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-t-4 border-blue-600">
        
        <form action="{{ route('lendings.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Barang</label>
                <select name="item_id" required 
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                    <option value="">-- Pilih Barang --</option>
                    @foreach($items as $item)
                        @php
                            $stokTersedia = $item->total - $item->repair - $item->lending;
                        @endphp
                        <option value="{{ $item->id }}" {{ $stokTersedia <= 0 ? 'disabled' : '' }} {{ old('item_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }} (Tersedia: {{ $stokTersedia }})
                        </option>
                    @endforeach
                </select>
                @if($items->isEmpty())
                    <p class="text-red-500 text-xs mt-1 italic">*Belum ada data barang di inventaris.</p>
                @endif
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Peminjam</label>
                <input type="text" name="borrower_name" value="{{ old('borrower_name') }}" placeholder="Masukkan nama siswa atau guru" required
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Pinjam</label>
                    <input type="number" name="amount_borrowed" value="{{ old('amount_borrowed', 1) }}" min="1" required
                        class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                    @error('amount_borrowed')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pinjam</label>
                    <input type="date" name="borrow_date" value="{{ date('Y-m-d') }}" required
                        class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Catatan (Opsional)</label>
                <textarea name="notes" rows="3" placeholder="Contoh: Digunakan di Ruang Lab 1"
                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm border p-2">{{ old('notes') }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded shadow transition duration-200">
                    Proses Peminjaman
                </button>
                <a href="{{ route('lendings.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-8 rounded transition duration-200">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection