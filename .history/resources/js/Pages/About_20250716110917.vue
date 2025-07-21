<template>
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative py-20 bg-gradient-to-r from-indigo-900 to-purple-900 text-white">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Profil Komunitas <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">BDARU</span>
                    </h1>
                    <p class="text-xl md:text-2xl max-w-4xl mx-auto text-gray-200 leading-relaxed">
                        Menjadi pusat pelestarian dan pengembangan budaya Indonesia melalui teknologi digital yang inovatif
                    </p>
                </div>
            </div>
        </section>

        <!-- Vision Mission Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-8">
                            Visi & Misi Kami
                        </h2>
                        <div class="space-y-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Visi</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Menjadi platform digital terdepan dalam pelestarian, dokumentasi, dan pengembangan budaya Indonesia yang dapat diakses oleh masyarakat global.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Misi</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Mengembangkan sistem dokumentasi budaya digital yang komprehensif, memfasilitasi pembelajaran budaya interaktif, dan membangun komunitas yang peduli terhadap pelestarian warisan budaya Indonesia.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-8 text-white">
                            <h3 class="text-2xl font-bold mb-6">Nilai-Nilai Kami</h3>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Pelestarian Budaya</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Inovasi Digital</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Aksesibilitas</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Kolaborasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- History Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Sejarah BDARU</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Perjalanan panjang kami dalam melestarikan dan mengembangkan budaya Indonesia
                    </p>
                </div>

                <div class="relative">
                    <!-- Timeline -->
                    <div class="space-y-12">
                        <div class="flex items-center gap-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                2020
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Awal Mula</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    BDARU didirikan sebagai inisiatif untuk melestarikan budaya Indonesia melalui teknologi digital. Dimulai dengan dokumentasi koleksi budaya tradisional.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                2021
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Pengembangan Platform</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Peluncuran platform digital pertama dengan fitur dokumentasi koleksi dan sistem QR Code untuk akses informasi budaya.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                2022
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Ekspansi Konten</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Penambahan fitur multimedia, dokumentasi video, dan kolaborasi dengan komunitas budaya di berbagai daerah Indonesia.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-red-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                2023
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Inovasi Digital</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Implementasi teknologi AI untuk katalogisasi otomatis, rekonstruksi 3D artefak, dan pengalaman virtual reality.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                2024
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Masa Depan</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Menuju platform budaya digital terdepan dengan integrasi teknologi blockchain untuk sertifikasi keaslian dan marketplace budaya.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Tim Kami</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Dipimpin oleh para ahli budaya dan teknologi yang berdedikasi untuk melestarikan warisan Indonesia
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="text-center group">
                        <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-4xl font-bold group-hover:scale-110 transition-transform duration-300">
                            AK
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ahmad Kurniawan</h3>
                        <p class="text-indigo-600 font-medium mb-3">Direktur Utama</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Ahli budaya dengan pengalaman 15 tahun dalam pelestarian warisan budaya Indonesia.
                        </p>
                    </div>

                    <div class="text-center group">
                        <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white text-4xl font-bold group-hover:scale-110 transition-transform duration-300">
                            SM
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Sarah Mulyani</h3>
                        <p class="text-indigo-600 font-medium mb-3">Kepala Kurator</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Kurator seni dengan spesialisasi dalam dokumentasi dan katalogisasi koleksi budaya.
                        </p>
                    </div>

                    <div class="text-center group">
                        <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center text-white text-4xl font-bold group-hover:scale-110 transition-transform duration-300">
                            RW
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Rizki Wahyudi</h3>
                        <p class="text-indigo-600 font-medium mb-3">Kepala Teknologi</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Ahli teknologi digital dengan fokus pada pengembangan platform budaya interaktif.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-indigo-900 to-purple-900 text-white">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-bold mb-6">Bergabunglah dengan Kami</h2>
                <p class="text-xl text-gray-200 mb-10 leading-relaxed">
                    Mari bersama-sama melestarikan dan mengembangkan budaya Indonesia untuk generasi mendatang
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <Link
                        :href="route('contact')"
                        class="group bg-white text-indigo-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-xl"
                    >
                        <span class="flex items-center justify-center gap-2">
                            Hubungi Kami
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </Link>
                    <Link
                        :href="route('collections.index')"
                        class="group border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-indigo-900 transition-all duration-300"
                    >
                        Jelajahi Koleksi
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
</script>
