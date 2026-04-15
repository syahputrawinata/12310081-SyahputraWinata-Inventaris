<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris - Landing Page</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 flex flex-col min-h-screen font-sans">
    
    <nav class="w-full px-6 py-4 flex justify-between items-center bg-white shadow-sm">
        <div class="font-bold text-2xl text-blue-600">
            Inventaris App
        </div>
        <a href="/login" class="font-semibold text-gray-600 hover:text-blue-600">Log in</a>
    </nav>

    <main class="flex-1 flex flex-col items-center justify-center px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">
            Inventory Management of <br> <span class="text-blue-600">SMK Wikrama</span>
        </h1>
        
        <p class="text-lg text-gray-600 mb-8 max-w-2xl">
            Management of incoming and outgoing items at Wikrama Bogor. Sistem pengelolaan inventaris alat dan barang yang cepat, efisien, dan terintegrasi.
        </p>
        
        <a href="/login" class="px-8 py-4 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition">
            Masuk ke Sistem
        </a>
    </main>
    
    <footer class="w-full text-center py-6 text-gray-500 text-sm">
        &copy; 2026 Sistem Inventaris SMK Wikrama. All rights reserved.
    </footer>

</body>
</html>