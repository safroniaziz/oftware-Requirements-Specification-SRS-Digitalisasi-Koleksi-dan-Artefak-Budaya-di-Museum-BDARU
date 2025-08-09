<template>
    <Head title="Kontak Kami" />

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
                        class="group relative px-6 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Kontak Kami</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full scale-x-100"></div>
                    </Link>

                    <!-- Profil Kami -->
                    <Link
                        href="/about"
                        class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Profil Kami</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-600 py-20">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6">
                Hubungi Kami
            </h1>
            <p class="text-xl text-emerald-100 mb-8 max-w-3xl mx-auto">
                Kami siap membantu Anda. Silakan hubungi tim kami untuk pertanyaan, saran, atau kolaborasi terkait Museum Digital Balai Adat Rajo Penghulu.
            </p>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-gradient-to-br from-gray-50 to-emerald-50 rounded-3xl p-8 shadow-xl border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300"
                                    placeholder="contoh@email.com"
                                    required
                                >
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Subjek</label>
                            <input
                                v-model="form.subject"
                                type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300"
                                placeholder="Subjek pesan"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan</label>
                            <textarea
                                v-model="form.message"
                                rows="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300 resize-none"
                                placeholder="Tulis pesan Anda di sini..."
                                required
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-4 px-6 rounded-xl hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 transform hover:scale-105 shadow-lg"
                        >
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                        <p class="text-gray-600 mb-8">
                            Tim kami siap melayani Anda dengan profesional. Jangan ragu untuk menghubungi kami melalui berbagai saluran komunikasi yang tersedia.
                        </p>
                    </div>

                    <!-- Contact Cards -->
                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Alamat</h3>
                                    <p class="text-gray-600">Jl. Museum Nasional No. 1</p>
                                    <p class="text-gray-600">Jakarta Pusat, 10110</p>
                                    <p class="text-gray-600">Indonesia</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Email</h3>
                                    <a href="mailto:info@bdaru-museum.id" class="text-emerald-600 hover:text-emerald-700 transition-colors">info@bdaru-museum.id</a>
                                    <br>
                                    <a href="mailto:support@bdaru-museum.id" class="text-emerald-600 hover:text-emerald-700 transition-colors">support@bdaru-museum.id</a>
                                </div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Telepon</h3>
                                    <a href="tel:+62213868172" class="text-emerald-600 hover:text-emerald-700 transition-colors">+62 21 386 8172</a>
                                    <br>
                                    <a href="tel:+62213868173" class="text-emerald-600 hover:text-emerald-700 transition-colors">+62 21 386 8173</a>
                                </div>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Jam Operasional</h3>
                                    <p class="text-gray-600">Senin - Jumat: 08:00 - 17:00</p>
                                    <p class="text-gray-600">Sabtu: 09:00 - 15:00</p>
                                    <p class="text-gray-600">Minggu: Tutup</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Lokasi Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Museum Digital Balai Adat Rajo Penghulu BDARU berlokasi strategis di pusat Jakarta, mudah dijangkau dari berbagai arah.
                </p>
            </div>
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="h-96 bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-emerald-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-gray-600 font-semibold">Peta Lokasi</p>
                        <p class="text-sm text-gray-500">Jl. Museum Nasional No. 1, Jakarta Pusat</p>
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
                            <Link href="/about" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Profil Kami</span>
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
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// Form data
const form = ref({
    name: '',
    email: '',
    subject: '',
    message: ''
});

// Submit form
const submitForm = () => {
    // Here you would typically send the form data to your backend
    console.log('Form submitted:', form.value);
    alert('Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');

    // Reset form
    form.value = {
        name: '',
        email: '',
        subject: '',
        message: ''
    };
};
</script>
