<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, EffectFade, Navigation, Pagination, Parallax } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const showBackToTop = ref(false);

// Sample museum images with better quality and variety
const heroImages = [
    {
        id: 1,
        src: 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80',
        alt: 'Museum Interior',
        title: 'Galeri Seni Rupa',
        subtitle: 'Koleksi Lukisan Klasik Indonesia',
        description: 'Jelajahi keindahan seni rupa tradisional dan kontemporer'
    },
    {
        id: 2,
        src: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80',
        alt: 'Ancient Artifacts',
        title: 'Artefak Kuno',
        subtitle: 'Peninggalan Sejarah Nusantara',
        description: 'Temukan harta karun arkeologi dari masa lalu'
    },
    {
        id: 3,
        src: 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80',
        alt: 'Traditional Textiles',
        title: 'Kain Tradisional',
        subtitle: 'Batik dan Tenun Nusantara',
        description: 'Warisan tekstil yang menceritakan budaya bangsa'
    },
    {
        id: 4,
        src: 'https://images.unsplash.com/photo-1518998053901-5348d3961a04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80',
        alt: 'Cultural Exhibition',
        title: 'Pameran Budaya',
        subtitle: 'Festival Seni dan Budaya',
        description: 'Pengalaman interaktif budaya Indonesia'
    },
    {
        id: 5,
        src: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80',
        alt: 'Digital Museum',
        title: 'Museum Digital',
        subtitle: 'Teknologi Modern & Budaya',
        description: 'Menggabungkan teknologi dengan warisan budaya'
    }
];

function handleScroll() {
    showBackToTop.value = window.scrollY > 300;
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <Head title="BDARU - Museum Digital Indonesia" />

    <div class="min-h-screen bg-gray-50">
                                        <!-- Fixed Logo Bar -->
        <div class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-md z-50">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <!-- Logo Section -->
                    <div class="flex items-center group">
                        <div class="flex-shrink-0 relative">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-105 transition-all duration-300 relative overflow-hidden">
                                    <!-- Camera Body -->
                                    <div class="w-8 h-6 bg-white/90 rounded-lg relative">
                                        <!-- Camera Lens -->
                                        <div class="absolute top-1 left-1 w-4 h-4 bg-gray-800 rounded-full flex items-center justify-center">
                                            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                        </div>
                                        <!-- Camera Flash -->
                                        <div class="absolute top-1 right-1 w-2 h-2 bg-yellow-400 rounded-sm"></div>
                                        <!-- Camera Button -->
                                        <div class="absolute -top-1 right-2 w-3 h-1 bg-gray-600 rounded-full"></div>
                                    </div>
                                    <!-- Camera Strap -->
                                    <div class="absolute -top-1 left-1/2 transform -translate-x-1/2 w-1 h-2 bg-white/70 rounded-full"></div>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-black bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                        BDARU
                                    </h1>
                                    <p class="text-xs text-gray-500 font-medium tracking-wide uppercase">
                                        Museum Digital Artefak Budaya
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-3">
                        <Link
                            v-if="canLogin"
                            :href="route('login')"
                            class="relative px-6 py-2.5 text-gray-700 font-semibold rounded-full border-2 border-gray-200 hover:border-blue-500 hover:text-blue-600 transition-all duration-300 group overflow-hidden"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Login</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="relative px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 group overflow-hidden"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                <span>Register</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-purple-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrollable Navigation Menu -->
        <div class="w-full mt-20">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="flex justify-center items-center py-4">
                    <div class="flex items-center space-x-8">
                        <Link
                            href="/"
                            class="relative px-3 py-2 text-blue-600 font-semibold transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                <span>Beranda</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
                        </Link>
                        <Link
                            href="/collections"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <span>Koleksi Budaya</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/news"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <span>Berita Terbaru</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/agenda"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Agenda Kegiatan</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/contact"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>Kontak Kami</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/about"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Profil Kami</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="relative min-h-screen bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900">
            <div class="absolute inset-0 bg-black/40"></div>

            <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="min-h-screen flex items-center">
                    <!-- Left Content -->
                    <div class="w-full lg:w-1/2 text-white pr-0 lg:pr-12">
                        <div class="mb-8">
                            <div class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full border border-white/30 mb-6">
                                <span class="text-sm font-medium text-white">🏛️ Museum Digital Indonesia</span>
                            </div>
                        </div>

                        <h1 class="text-5xl md:text-7xl font-black mb-8 leading-tight">
                            <span class="text-yellow-400">BDARU</span>
                        </h1>

                        <p class="text-lg md:text-2xl mb-12 leading-relaxed text-white font-light">
                            Jelajahi kekayaan budaya Indonesia melalui
                            <span class="font-semibold text-yellow-400">teknologi digital</span> yang inovatif.
                            Temukan warisan budaya dalam format yang modern dan interaktif.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-6 items-start">
                            <Link
                                href="/collections"
                                class="bg-yellow-500 hover:bg-yellow-600 text-black px-8 py-4 rounded-full font-bold text-lg transform hover:scale-105 transition-all duration-300 shadow-2xl"
                            >
                                <span class="flex items-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Jelajahi Koleksi
                                </span>
                            </Link>
                            <Link
                                href="/about"
                                class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-blue-900 transition-all duration-300"
                            >
                                <span class="flex items-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tentang Kami
                                </span>
                            </Link>
                        </div>
                    </div>

                    <!-- Right Image Slider -->
                    <div class="w-full lg:w-1/2 pl-0 lg:pl-12 mt-12 lg:mt-0">
                        <div class="relative h-96 lg:h-[500px] rounded-3xl overflow-hidden shadow-2xl">
                            <Swiper
                                :modules="[Autoplay, EffectFade, Navigation, Pagination, Parallax]"
                                :slides-per-view="1"
                                :loop="true"
                                :autoplay="{
                                    delay: 5000,
                                    disableOnInteraction: false,
                                }"
                                :effect="'fade'"
                                :fade-effect="{
                                    crossFade: true
                                }"
                                :navigation="{
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                }"
                                :pagination="{
                                    el: '.swiper-pagination',
                                    clickable: true,
                                    dynamicBullets: true,
                                }"
                                :parallax="true"
                                class="hero-swiper h-full"
                            >
                                <SwiperSlide
                                    v-for="image in heroImages"
                                    :key="image.id"
                                    class="relative"
                                >
                                    <div class="relative w-full h-full">
                                        <img
                                            :src="image.src"
                                            :alt="image.alt"
                                            class="w-full h-full object-cover"
                                            @error="handleImageError"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                                        <!-- Image Title Overlay -->
                                        <div class="absolute bottom-6 left-6 right-6">
                                            <div class="bg-white/20 backdrop-blur-md rounded-2xl p-4 border border-white/30">
                                                <h3 class="text-white font-bold text-xl mb-2">{{ image.title }}</h3>
                                                <p class="text-white/90 text-sm">{{ image.subtitle }}</p>
                                                <p class="text-white/80 text-xs mt-2">{{ image.description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </SwiperSlide>

                                <!-- Custom Navigation Arrows -->
                                <div class="swiper-button-prev !w-12 !h-12 !bg-white/20 !backdrop-blur-md !rounded-full !text-white hover:!bg-white/30 transition-all duration-300 group">
                                    <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </div>
                                <div class="swiper-button-next !w-12 !h-12 !bg-white/20 !backdrop-blur-md !rounded-full !text-white hover:!bg-white/30 transition-all duration-300 group">
                                    <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>

                                <!-- Custom Pagination -->
                                <div class="swiper-pagination !bottom-4"></div>
                            </Swiper>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-20 bg-blue-600 text-white">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
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
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
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
                                <Link href="/collections/lukisan-klasik" class="text-blue-600 hover:text-blue-800 font-bold text-sm">
                                    Lihat Detail →
                                </Link>
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
                                <Link href="/collections/artefak-kuno" class="text-green-600 hover:text-green-800 font-bold text-sm">
                                    Lihat Detail →
                                </Link>
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
                                <Link href="/collections/batik-tradisional" class="text-red-600 hover:text-red-800 font-bold text-sm">
                                    Lihat Detail →
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-blue-900 text-white">
            <div class="w-full lg:w-4/5 mx-auto text-center px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full border border-white/30 mb-6">
                        <span class="text-sm font-medium text-white">🚀 Mulai Petualangan Budaya</span>
                    </div>
                </div>

                <h2 class="text-5xl md:text-7xl font-black mb-8">
                    Siap Jelajahi <span class="text-yellow-400">Budaya Indonesia</span>?
                </h2>
                <p class="text-xl md:text-2xl text-blue-100 mb-12 leading-relaxed max-w-4xl mx-auto">
                    Bergabunglah dengan ribuan pengunjung yang telah menemukan kekayaan budaya Indonesia
                    melalui platform digital kami yang inovatif dan modern.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <Link
                        href="/collections"
                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-12 py-5 rounded-full font-black text-lg transform hover:scale-105 transition-all duration-300 shadow-2xl"
                    >
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Mulai Jelajahi
                        </span>
                    </Link>
                    <Link
                        href="/contact"
                        class="border-2 border-white text-white px-12 py-5 rounded-full font-black text-lg hover:bg-white hover:text-blue-900 transition-all duration-300"
                    >
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Hubungi Kami
                        </span>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="w-full lg:w-4/5 mx-auto py-12 px-4 sm:px-6 lg:px-8">
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

        <!-- Back to Top Button -->
        <button
            @click="scrollToTop"
            class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300 z-50 group"
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
                <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-purple-700 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
        </button>
    </div>
</template>

<style scoped>
/* Custom Swiper Styles */
.hero-swiper {
    border-radius: 1.5rem;
}

.hero-swiper .swiper-slide {
    border-radius: 1.5rem;
}

.hero-swiper .swiper-button-prev,
.hero-swiper .swiper-button-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 3rem;
    height: 3rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(8px);
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 10;
}

.hero-swiper .swiper-button-prev:hover,
.hero-swiper .swiper-button-next:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-50%) scale(1.1);
}

.hero-swiper .swiper-button-prev {
    left: 1rem;
}

.hero-swiper .swiper-button-next {
    right: 1rem;
}

.hero-swiper .swiper-button-prev::after,
.hero-swiper .swiper-button-next::after {
    display: none;
}

.hero-swiper .swiper-pagination {
    position: absolute;
    bottom: 1rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
    z-index: 10;
}

.hero-swiper .swiper-pagination-bullet {
    width: 0.75rem;
    height: 0.75rem;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
    cursor: pointer;
}

.hero-swiper .swiper-pagination-bullet-active {
    background: #fbbf24;
    transform: scale(1.25);
}

.hero-swiper .swiper-pagination-bullet:hover {
    background: rgba(255, 255, 255, 0.7);
}
</style>
