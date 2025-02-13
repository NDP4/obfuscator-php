<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex items-center justify-center">
    <div class="text-center space-y-6">
        <div class="space-y-2">
            <h1 class="text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">404</h1>
            <h2 class="text-2xl font-semibold text-gray-300">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-400">Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
        </div>
        
        <div class="flex justify-center space-x-4">
            <a href="{{ url('/') }}" 
               class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">
                Kembali ke Beranda
            </a>
            <a href="{{ route('obfuscator.index') }}" 
               class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg hover:from-cyan-600 hover:to-blue-600 transition-colors">
                Ke Pengacak Kode
            </a>
        </div>

        <div class="mt-8">
            <div class="inline-flex items-center space-x-2 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>PHP Obfuscator</span>
            </div>
        </div>
    </div>
</body>
</html>
