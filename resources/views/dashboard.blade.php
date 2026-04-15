@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-700">Dashboard Overview</h3>
        <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, {{ Auth::user()->name }}!</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500 mb-8">
        <p class="text-gray-600">
            Anda saat ini login dengan hak akses sebagai: 
            <span class="uppercase font-bold text-blue-600">{{ Auth::user()->role }}</span>.
        </p>
    </div>
@endsection