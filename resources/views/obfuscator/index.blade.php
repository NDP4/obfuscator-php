<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengacak Kode PHP</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 mb-2">
                Pengacak Kode PHP
            </h1>
            <p class="text-gray-400">Amankan kode PHP Anda melalui enkripsi dan pengacakan lanjutan</p>
        </div>

        <!-- Main Content -->
        <div class="space-y-6">
            <!-- Code Editor Section -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Original Code -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-cyan-400">Kode Asli</h2>
                        <button onclick="pasteFromClipboard()" class="text-xs text-cyan-500 hover:text-cyan-400 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Tempel
                        </button>
                    </div>
                    <div class="relative">
                        <textarea id="source_code" 
                                class="w-full h-96 bg-gray-800 border border-gray-700 rounded-lg p-4 font-mono text-gray-300 focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                placeholder="Paste your PHP code here..."
                                spellcheck="false"></textarea>
                        <div class="absolute top-2 right-2">
                            <div class="flex space-x-1">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Obfuscated Code -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-blue-400">Hasil Pengacakan</h2>
                        <button onclick="copyToClipboard()" class="text-xs text-blue-500 hover:text-blue-400 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                            </svg>
                            Salin
                        </button>
                    </div>
                    <div class="relative">
                        <textarea id="obfuscated_code" 
                                class="w-full h-96 bg-gray-800 border border-gray-700 rounded-lg p-4 font-mono text-blue-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                readonly></textarea>
                        <div class="absolute top-2 right-2">
                            <div class="flex space-x-1">
                                <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                                <div class="w-3 h-3 rounded-full bg-indigo-500"></div>
                                <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Options Section -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-gray-300 mb-4">Opsi Pengacakan</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <label class="flex items-center space-x-3 text-sm">
                        <input type="checkbox" id="obfuscate_functions" 
                               class="rounded bg-gray-700 border-gray-600 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-gray-800"
                               checked>
                        <span class="text-gray-300">Fungsi</span>
                    </label>
                    <label class="flex items-center space-x-3 text-sm">
                        <input type="checkbox" id="obfuscate_variables"
                               class="rounded bg-gray-700 border-gray-600 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-gray-800"
                               checked>
                        <span class="text-gray-300">Variabel</span>
                    </label>
                    <label class="flex items-center space-x-3 text-sm">
                        <input type="checkbox" id="encrypt_strings"
                               class="rounded bg-gray-700 border-gray-600 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-gray-800"
                               checked>
                        <span class="text-gray-300">String</span>
                    </label>
                    <label class="flex items-center space-x-3 text-sm">
                        <input type="checkbox" id="minify"
                               class="rounded bg-gray-700 border-gray-600 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-gray-800"
                               checked>
                        <span class="text-gray-300">Minifikasi</span>
                    </label>
                </div>
            </div>

            <!-- Action Button -->
            <div class="text-center">
                <button id="obfuscate_btn" 
                        class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-lg hover:from-cyan-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-900 transform transition hover:scale-105">
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Acak Kode</span>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Copy to clipboard function
        async function copyToClipboard() {
            const code = document.getElementById('obfuscated_code').value;
            try {
                await navigator.clipboard.writeText(code);
                showNotification('Kode berhasil disalin!', 'success');
            } catch (err) {
                showNotification('Gagal menyalin kode', 'error');
            }
        }

        // Paste from clipboard function
        async function pasteFromClipboard() {
            try {
                const text = await navigator.clipboard.readText();
                document.getElementById('source_code').value = text;
                showNotification('Kode berhasil ditempel!', 'success');
            } catch (err) {
                showNotification('Gagal menempel kode', 'error');
            }
        }

        // Notification function
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } transition-opacity duration-300`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 2000);
        }

        // Original click handler
        document.getElementById('obfuscate_btn').addEventListener('click', async () => {
            try {
                const btn = document.getElementById('obfuscate_btn');
                btn.disabled = true;
                btn.innerHTML = `<span class="flex items-center space-x-2">
                    <svg class="w-5 h-5 animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Memproses...</span>
                </span>`;

                const sourceCode = document.getElementById('source_code').value;
                const options = {
                    obfuscate_functions: document.getElementById('obfuscate_functions').checked,
                    obfuscate_variables: document.getElementById('obfuscate_variables').checked,
                    encrypt_strings: document.getElementById('encrypt_strings').checked,
                    minify: document.getElementById('minify').checked
                };
                
                const response = await fetch('/obfuscate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        source_code: sourceCode,
                        options: options
                    })
                });
                
                const data = await response.json();
                document.getElementById('obfuscated_code').value = data.obfuscated_code;
                showNotification('Kode berhasil diacak!', 'success');

                // Reset button state
                btn.disabled = false;
                btn.innerHTML = `<span class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Acak Kode</span>
                </span>`;
            } catch (error) {
                console.error(error);
                showNotification('Terjadi kesalahan saat mengacak kode', 'error');
            }
        });
    </script>
</body>
</html>
