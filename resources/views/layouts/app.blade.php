<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris App</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 bg-blue-800 text-white flex flex-col">
            <div class="p-4 text-2xl font-bold border-b border-blue-700">INVENTARIS</div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li><a class="block p-2 hover:bg-blue-700 rounded">Dashboard</a></li>
                        <li><a class="block p-2 hover:bg-blue-700 rounded">Data Barang</a></li>
                        <li><a class="block p-2 hover:bg-blue-700 rounded">Data Kategori</a></li>
                    <li><a class="block p-2 hover:bg-blue-700 rounded">Peminjaman</a></li>
                    <li><a class="block p-2 hover:bg-blue-700 rounded">Pengguna</a></li>
                </ul>
            </nav>
            <div class="p-4 border-t border-blue-700">
                <!-- Form -->
                    <button class="w-full text-left p-2 hover:bg-red-600 rounded">Logout</button>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Admin Panel</h2>
                <span class="text-gray-600 italic">Halo, Selamat Datang</span>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>