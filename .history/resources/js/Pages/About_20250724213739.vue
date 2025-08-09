<template>
    <Head title="Profil Kami" />

    <!-- Navigation -->
    <div class="bg-white/95 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <Link href="/" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                        <span class="text-white font-black text-lg">B</span>
                    </div>
                    <div>
                        <div class="text-xl font-black text-gray-900">BDARU</div>
                        <div class="text-xs text-emerald-600 font-semibold">Museum Digital Balai Adat Rajo Penghulu</div>
                    </div>
                </Link>

                <!-- Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-2">
                    <!-- Beranda -->
                    <Link
                        href="/"
                        class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Beranda</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Koleksi Budaya -->
                    <Link
                        href="/collections"
                        class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span>Koleksi Budaya</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Berita Terbaru -->
                    <Link
                        href="/news"
                        class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <span>Berita Terbaru</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Agenda Kegiatan -->
                    <Link
                        href="/events"
                        class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Agenda Kegiatan</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Kontak Kami -->
                    <Link
                        href="/contact"
                        class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Kontak Kami</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Profil Kami -->
                    <Link
                        href="/about"
                        class="group relative px-6 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Profil Kami</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full scale-x-100"></div>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-600 py-20 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-pulse"></div>
            <div class="absolute top-32 right-20 w-16 h-16 bg-white/5 rounded-full animate-ping"></div>
            <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/15 rounded-full animate-bounce"></div>
            <div class="absolute bottom-32 right-1/3 w-24 h-24 bg-white/8 rounded-full animate-pulse"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-white/5 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-fade-in-up">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6 animate-slide-in">
                    Tentang BDARU
                </h1>
                <p class="text-xl text-emerald-100 mb-8 max-w-3xl mx-auto animate-fade-in-delay">
                    Museum Digital Balai Adat Rajo Penghulu yang berkomitmen melestarikan dan memperkenalkan warisan budaya Indonesia melalui teknologi digital yang inovatif.
                </p>

                <!-- Interactive Stats -->
                <div class="flex justify-center gap-8 text-center animate-fade-in-delay-2">
                    <div class="group hover:scale-110 transition-transform duration-300">
                        <div class="text-3xl font-black text-emerald-300 counter" data-target="1000">0</div>
                        <div class="text-sm text-emerald-200 font-semibold">Koleksi Digital</div>
                    </div>
                    <div class="group hover:scale-110 transition-transform duration-300">
                        <div class="text-3xl font-black text-teal-300 counter" data-target="50">0</div>
                        <div class="text-sm text-teal-200 font-semibold">Provinsi</div>
                    </div>
                    <div class="group hover:scale-110 transition-transform duration-300">
                        <div class="text-3xl font-black text-cyan-300 counter" data-target="100">0</div>
                        <div class="text-sm text-cyan-200 font-semibold">Kategori</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Visi & Misi Kami</h2>
                    <div class="space-y-6">
                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-100">
                            <h3 class="text-xl font-bold text-emerald-800 mb-3">🏛️ Visi</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Menjadi platform digital terdepan dalam pelestarian, dokumentasi, dan penyebarluasan warisan budaya Indonesia kepada masyarakat global melalui teknologi yang inovatif dan aksesibel.
                            </p>
                        </div>
                        <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-2xl p-6 border border-teal-100">
                            <h3 class="text-xl font-bold text-teal-800 mb-3">🎯 Misi</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Mengembangkan sistem digitalisasi yang komprehensif untuk melestarikan koleksi budaya Indonesia, memfasilitasi pembelajaran interaktif, dan membangun kesadaran masyarakat akan pentingnya warisan budaya.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-emerald-100 to-teal-100 rounded-3xl p-8 shadow-xl">
                        <div class="text-center">
                            <div class="w-32 h-32 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <span class="text-white font-black text-4xl">B</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">BDARU</h3>
                            <p class="text-gray-600 mb-6">Museum Digital Balai Adat Rajo Penghulu</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="bg-white rounded-xl p-3">
                                    <div class="font-bold text-emerald-600">1000+</div>
                                    <div class="text-gray-600">Koleksi Digital</div>
                                </div>
                                <div class="bg-white rounded-xl p-3">
                                    <div class="font-bold text-teal-600">50K+</div>
                                    <div class="text-gray-600">Pengunjung</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Berdasarkan prinsip-prinsip yang menjadi fondasi dalam setiap langkah kami melestarikan budaya Indonesia.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Innovation -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Inovasi</h3>
                    <p class="text-gray-600 text-sm">
                        Menggunakan teknologi terkini untuk melestarikan dan menyajikan warisan budaya dengan cara yang menarik dan interaktif.
                    </p>
                </div>

                <!-- Preservation -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Pelestarian</h3>
                    <p class="text-gray-600 text-sm">
                        Berkomitmen untuk melindungi dan melestarikan warisan budaya Indonesia untuk generasi mendatang.
                    </p>
                </div>

                <!-- Education -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Pendidikan</h3>
                    <p class="text-gray-600 text-sm">
                        Menyediakan platform pembelajaran yang informatif dan mudah diakses untuk semua kalangan masyarakat.
                    </p>
                </div>

                <!-- Community -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Komunitas</h3>
                    <p class="text-gray-600 text-sm">
                        Membangun komunitas yang peduli terhadap pelestarian budaya dan saling mendukung dalam misi kami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Tim Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Dibalik BDARU ada tim yang berdedikasi tinggi dalam melestarikan warisan budaya Indonesia melalui teknologi digital.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300">
                    <div class="w-24 h-24 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <span class="text-white font-bold text-2xl">DR</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Dr. Rina Sari</h3>
                    <p class="text-emerald-600 font-semibold mb-3">Direktur Utama</p>
                    <p class="text-gray-600 text-sm">
                        Ahli arkeologi dengan pengalaman 15 tahun dalam pelestarian warisan budaya Indonesia.
                    </p>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300">
                    <div class="w-24 h-24 bg-gradient-to-br from-teal-600 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <span class="text-white font-bold text-2xl">AB</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Ahmad Budi</h3>
                    <p class="text-teal-600 font-semibold mb-3">Kepala Teknologi</p>
                    <p class="text-gray-600 text-sm">
                        Spesialis teknologi digital dengan fokus pada pengembangan platform museum digital.
                    </p>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-gradient-to-br from-cyan-50 to-purple-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300">
                    <div class="w-24 h-24 bg-gradient-to-br from-cyan-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <span class="text-white font-bold text-2xl">SM</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Siti Mawar</h3>
                    <p class="text-cyan-600 font-semibold mb-3">Kurator Senior</p>
                    <p class="text-gray-600 text-sm">
                        Kurator berpengalaman dalam pengelolaan koleksi dan dokumentasi artefak budaya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- History Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Timeline -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Perjalanan Kami</h2>
                    <div class="space-y-8">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">2020</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Awal Mula</h3>
                                <p class="text-gray-600">
                                    BDARU didirikan dengan visi melestarikan warisan budaya Indonesia melalui teknologi digital.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">2021</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Digitalisasi Pertama</h3>
                                <p class="text-gray-600">
                                    Meluncurkan platform digital pertama dengan 100 koleksi budaya yang telah didigitalisasi.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-cyan-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">2023</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Ekspansi</h3>
                                <p class="text-gray-600">
                                    Mengembangkan fitur interaktif dan menambahkan 500+ koleksi baru dari berbagai daerah.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">2024</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Masa Depan</h3>
                                <p class="text-gray-600">
                                    Berkomitmen untuk terus berkembang dan menjadi platform terdepan dalam pelestarian budaya digital.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="bg-white rounded-3xl p-8 shadow-xl">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Pencapaian Kami</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-black text-emerald-600 mb-2">1000+</div>
                            <div class="text-gray-600 text-sm">Koleksi Digital</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-teal-600 mb-2">50K+</div>
                            <div class="text-gray-600 text-sm">Pengunjung</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-cyan-600 mb-2">25+</div>
                            <div class="text-gray-600 text-sm">Provinsi</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-purple-600 mb-2">100+</div>
                            <div class="text-gray-600 text-sm">Kategori</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-black text-lg">B</span>
                        </div>
                        <div>
                            <div class="text-xl font-black">BDARU</div>
                            <div class="text-sm text-emerald-400 font-semibold">Museum Digital Balai Adat Rajo Penghulu</div>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm mb-6 max-w-md">
                        Melestarikan dan memperkenalkan warisan budaya Indonesia melalui teknologi digital yang inovatif dan aksesibel.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Menu Utama</h3>
                    <ul class="space-y-2">
                        <li>
                            <Link href="/" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Beranda</span>
                            </Link>
                        </li>
                        <li>
                            <Link href="/collections" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Koleksi Budaya</span>
                            </Link>
                        </li>
                        <li>
                            <Link href="/news" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Berita Terbaru</span>
                            </Link>
                        </li>
                        <li>
                            <Link href="/contact" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Kontak Kami</span>
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Kontak</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-300 text-sm">Jl. Museum Nasional No. 1</p>
                                <p class="text-gray-300 text-sm">Jakarta Pusat, 10110</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-300 text-sm">info@bdaru-museum.id</p>
                                <p class="text-gray-300 text-sm">support@bdaru-museum.id</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-300 text-sm">+62 21 386 8172</p>
                                <p class="text-gray-300 text-sm">+62 21 386 8173</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm text-center md:text-left">
                        © 2024 BDARU Museum Digital Balai Adat Rajo Penghulu. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-6 mt-4 md:mt-0">
                        <Link href="/privacy" class="text-gray-400 hover:text-emerald-400 text-sm transition-colors duration-300">
                            Privacy Policy
                        </Link>
                        <Link href="/terms" class="text-gray-400 hover:text-emerald-400 text-sm transition-colors duration-300">
                            Terms of Service
                        </Link>
                        <Link href="/sitemap" class="text-gray-400 hover:text-emerald-400 text-sm transition-colors duration-300">
                            Sitemap
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button
        @click="scrollToTop"
        class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300 z-50 group"
        :class="{ 'opacity-0 pointer-events-none': !showBackToTop }"
    >
        <div class="relative w-full h-full flex items-center justify-center">
            <svg
                class="w-6 h-6 transform group-hover:-translate-y-1 transition-transform duration-300"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-700 to-teal-700 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
    </button>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const showBackToTop = ref(false);

// Counter animation
const animateCounters = () => {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        updateCounter();
    });
};

// Interactive timeline
const initTimeline = () => {
    const timelineItems = document.querySelectorAll('.flex.items-start.space-x-4');
    timelineItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-50px)';

        setTimeout(() => {
            item.style.transition = 'all 0.6s ease-out';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, index * 200);
    });
};

// Team member hover effects
const initTeamEffects = () => {
    const teamCards = document.querySelectorAll('.bg-gradient-to-br');
    teamCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px) scale(1.02)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
        });
    });
};

// Values cards interaction
const initValuesInteraction = () => {
    const valueCards = document.querySelectorAll('.bg-white.rounded-2xl');
    valueCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            const icon = card.querySelector('.w-12.h-12');
            if (icon) {
                icon.style.transform = 'scale(1.1) rotate(5deg)';
            }
        });

        card.addEventListener('mouseleave', () => {
            const icon = card.querySelector('.w-12.h-12');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });
};

// Scroll to top function
const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

// Handle scroll for back to top button
const handleScroll = () => {
    showBackToTop.value = window.scrollY > 300;
};

onMounted(() => {
    // Animate counters when component mounts
    setTimeout(animateCounters, 500);

    // Add scroll event listener
    window.addEventListener('scroll', handleScroll);

    // Initialize interactive elements
    setTimeout(initTimeline, 1000);
    setTimeout(initTeamEffects, 1500);
    setTimeout(initValuesInteraction, 2000);

    // Add scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);

    // Observe all cards for animation
    document.querySelectorAll('.bg-white, .bg-gradient-to-br').forEach(card => {
        observer.observe(card);
    });
});
</script>

<style scoped>
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

.animate-slide-in {
    animation: slideIn 1s ease-out;
}

.animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.3s both;
}

.animate-fade-in-delay-2 {
    animation: fadeIn 1s ease-out 0.6s both;
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Hover effects for cards */
.bg-white.rounded-2xl:hover,
.bg-gradient-to-br:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Smooth transitions */
.bg-white.rounded-2xl,
.bg-gradient-to-br {
    transition: all 0.3s ease-in-out;
}

/* Icon animations */
.w-12.h-12 {
    transition: all 0.3s ease-in-out;
}
</style>
