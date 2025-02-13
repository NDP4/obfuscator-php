<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Obfuscator - Pengaman Kode PHP</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Hero Section -->
    <div class="min-h-screen flex flex-col">
        <div class="flex-grow container mx-auto px-4 py-16">
            <div class="text-center max-w-4xl mx-auto space-y-8">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo.svg') }}" alt="PHP Obfuscator Logo" class="w-24 h-24">
                </div>
                <h1 class="text-5xl font-bold">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600">
                        PHP Obfuscator
                    </span>
                </h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Lindungi kode PHP Anda dengan teknologi pengacakan dan enkripsi tingkat lanjut. 
                    Amankan logika bisnis Anda dari decompiler dan reverse engineering.
                </p>
                
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('obfuscator.index') }}" 
                       class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-lg hover:from-cyan-600 hover:to-blue-600 transform transition hover:scale-105 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Mulai Mengacak</span>
                    </a>
                </div>
            </div>

            <!-- Features Section -->
            <div class="mt-24 grid md:grid-cols-3 gap-8">
                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                    <div class="text-cyan-400 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pengacakan Variabel</h3>
                    <p class="text-gray-400">Otomatis mengacak nama variabel untuk menyembunyikan logika program.</p>
                </div>

                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                    <div class="text-blue-400 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Enkripsi String</h3>
                    <p class="text-gray-400">Mengenkripsi string dengan algoritma AES-256 untuk keamanan maksimal.</p>
                </div>

                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                    <div class="text-purple-400 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pengacakan Fungsi</h3>
                    <p class="text-gray-400">Mengacak nama fungsi sambil mempertahankan fungsionalitas kode.</p>
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-24 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} NDP. All rights reserved.</p>
            </footer>
        </div>
    </div>
</body>
</html>
