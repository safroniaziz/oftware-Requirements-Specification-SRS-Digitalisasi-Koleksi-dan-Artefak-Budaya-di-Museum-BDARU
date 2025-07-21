<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDARU - Museum Digital Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-blue-600">BDARU</h1>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-4">
                            <a href="/" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                            <a href="/collections" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Koleksi Budaya</a>
                            <a href="/news" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Berita & Kegiatan</a>
                            <a href="/about" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Profil Komunitas</a>
                            <a href="/contact" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Kontak</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="/admin" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Admin Panel</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 text-center text-white max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full border border-white/30 mb-6">
                    <span class="text-sm font-medium text-white">🏛️ Museum Digital Indonesia</span>
                </div>
            </div>

            <h1 class="text-6xl md:text-8xl font-black mb-8 leading-tight">
                <span class="text-yellow-400">BDARU</span>
            </h1>

            <p class="text-xl md:text-3xl mb-12 max-w-4xl mx-auto leading-relaxed text-white font-light">
                Jelajahi kekayaan budaya Indonesia melalui
                <span class="font-semibold text-yellow-400">teknologi digital</span> yang inovatif.
                Temukan warisan budaya dalam format yang modern dan interaktif.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                <a href="/collections" class="bg-yellow-500 hover:bg-yellow-600 text-black px-10 py-5 rounded-full font-bold text-lg transform hover:scale-105 transition-all duration-300 shadow-2xl">
                    <span class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Jelajahi Koleksi
                    </span>
                </a>
                <a href="/about" class="border-2 border-white text-white px-10 py-5 rounded-full font-bold text-lg hover:bg-white hover:text-blue-900 transition-all duration-300">
                    <span class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang Kami
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-white">Statistik Museum</h2>
                <p class="text-xl text-blue-100">Pencapaian kami dalam melestarikan budaya Indonesia</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="bg-white/10 rounded-2xl p-8 border border-white/20">
                    <div class="text-5xl md:text-6xl font-black mb-4 text-yellow-400">150+</div>
                    <div class="text-blue-100 font-semibold text-lg">Koleksi Digital</div>
                </div>
                <div class="bg-white/10 rounded-2xl p-8 border border-white/20">
                    <div class="text-5xl md:text-6xl font-black mb-4 text-green-400">25</div>
                    <div class="text-blue-100 font-semibold text-lg">Kategori Budaya</div>
                </div>
                <div class="bg-white/10 rounded-2xl p-8 border border-white/20">
                    <div class="text-5xl md:text-6xl font-black mb-4 text-blue-300">10,000+</div>
                    <div class="text-blue-100 font-semibold text-lg">Kunjungan</div>
                </div>
                <div class="bg-white/10 rounded-2xl p-8 border border-white/20">
                    <div class="text-5xl md:text-6xl font-black mb-4 text-purple-300">50</div>
                    <div class="text-blue-100 font-semibold text-lg">Koleksi Unggulan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Collections Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-6">
                    🏆 Koleksi Terbaik
                </div>
                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-8">
                    Koleksi <span class="text-blue-600">Unggulan</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Pilihan koleksi terbaik yang menampilkan keindahan dan kekayaan budaya Indonesia
                    dalam format digital yang modern dan interaktif.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100">
                    <div class="relative h-72 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <div class="absolute inset-0 bg-black/30"></div>
                        <div class="relative z-10 text-white text-center p-6">
                            <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center border border-white/30">
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-bold bg-white/20 px-4 py-2 rounded-full border border-white/30">
                                Seni Rupa
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-blue-600 transition-colors">
                            Lukisan Klasik Indonesia
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Koleksi lukisan klasik yang menggambarkan keindahan alam dan budaya Indonesia dari berbagai era.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                                1800-1950
                            </span>
                            <a href="/collections/lukisan-klasik" class="text-blue-600 hover:text-blue-800 font-bold text-sm">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100">
                    <div class="relative h-72 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                        <div class="absolute inset-0 bg-black/30"></div>
                        <div class="relative z-10 text-white text-center p-6">
                            <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center border border-white/30">
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-bold bg-white/20 px-4 py-2 rounded-full border border-white/30">
                                Arkeologi
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-green-600 transition-colors">
                            Artefak Kuno Nusantara
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Peninggalan arkeologi yang menceritakan sejarah panjang peradaban Indonesia.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                                Pra-Sejarah
                            </span>
                            <a href="/collections/artefak-kuno" class="text-green-600 hover:text-green-800 font-bold text-sm">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100">
                    <div class="relative h-72 bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center">
                        <div class="absolute inset-0 bg-black/30"></div>
                        <div class="relative z-10 text-white text-center p-6">
                            <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center border border-white/30">
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-bold bg-white/20 px-4 py-2 rounded-full border border-white/30">
                                Tekstil
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-red-600 transition-colors">
                            Batik Tradisional
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Koleksi batik tradisional dari berbagai daerah yang menampilkan keunikan motif dan filosofi.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                                Tradisional
                            </span>
                            <a href="/collections/batik-tradisional" class="text-red-600 hover:text-red-800 font-bold text-sm">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Museum BDARU</h3>
                    <p class="text-gray-300">
                        Pusat dokumentasi dan pelestarian budaya Indonesia yang berkomitmen untuk melestarikan warisan budaya bangsa.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-gray-300">
                        <p>Jl. Budaya No. 123, Jakarta</p>
                        <p>Email: info@bdaru.com</p>
                        <p>Telp: (021) 1234-5678</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Jam Operasional</h3>
                    <div class="space-y-2 text-gray-300">
                        <p>Senin - Jumat: 09:00 - 17:00</p>
                        <p>Sabtu - Minggu: 10:00 - 18:00</p>
                        <p>Hari Libur Nasional: Tutup</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-300">
                <p>&copy; 2024 Museum BDARU. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
