<template>
    <Head :title="`${props.news?.title || 'Berita'} - ${props.museumSettings?.museum_name || 'BDARU Museum Digital Balai Adat Rajo Penghulu'}`" />

    <div class="min-h-screen bg-gray-50">

        <!-- Modern Fixed Navigation Bar -->
        <div class="fixed top-0 left-0 right-0 bg-white/98 backdrop-blur-xl border-b border-gray-200/50 shadow-lg z-50">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <!-- Enhanced Logo Section -->
                    <div class="flex items-center group">
                        <div class="flex-shrink-0 relative">
                            <div class="flex items-center space-x-3">
                                <!-- Dynamic Logo from Database -->
                                <div class="relative">
                                    <div v-if="props.museumSettings?.logo_url" class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden">
                                        <img
                                            :src="props.museumSettings.logo_url"
                                            :alt="props.museumSettings?.museum_name || 'Logo Museum'"
                                            class="w-full h-full object-cover rounded-2xl"
                                            @error="$event.target.style.display='none'; $event.target.nextElementSibling.style.display='flex'"
                                        />
                                        <!-- Fallback Icon if image fails to load -->
                                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden" style="display: none;">
                                            <!-- Premium Museum Icon -->
                                            <div class="w-10 h-8 bg-white/95 rounded-lg relative">
                                                <!-- Premium Building Structure -->
                                                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-600 to-teal-600"></div>
                                                <div class="absolute top-2 left-1 right-1 h-0.5 bg-gray-800"></div>
                                                <div class="absolute top-4 left-1 right-1 h-0.5 bg-gray-800"></div>
                                                <div class="absolute top-6 left-1 right-1 h-0.5 bg-gray-800"></div>
                                                <!-- Premium Windows -->
                                                <div class="absolute top-1 left-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                                                <div class="absolute top-1 right-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                                                <div class="absolute top-3 left-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                                                <div class="absolute top-3 right-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                                                <div class="absolute top-5 left-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
                                                <div class="absolute top-5 right-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
                                                <!-- Premium Door -->
                                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-700 rounded-t-sm"></div>
                                            </div>
                                            <!-- Enhanced Glow Effect -->
                                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/30 to-teal-500/30 rounded-2xl blur-sm group-hover:blur-md transition-all duration-500"></div>
                                        </div>
                                        <!-- Enhanced Floating Particles -->
                                        <div class="absolute -top-1 -right-1 w-2 h-2 bg-emerald-400 rounded-full animate-ping"></div>
                                        <div class="absolute -bottom-1 -left-1 w-1.5 h-1.5 bg-teal-400 rounded-full animate-ping delay-1000"></div>
                                        <div class="absolute top-1/2 -right-0.5 w-1 h-1 bg-cyan-400 rounded-full animate-ping delay-500"></div>
                                    </div>
                                    <!-- Default Icon if no logo -->
                                    <div v-else class="w-16 h-16 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden">
                                        <!-- Premium Museum Icon -->
                                        <div class="w-10 h-8 bg-white/95 rounded-lg relative">
                                            <!-- Premium Building Structure -->
                                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-600 to-teal-600"></div>
                                            <div class="absolute top-2 left-1 right-1 h-0.5 bg-gray-800"></div>
                                            <div class="absolute top-4 left-1 right-1 h-0.5 bg-gray-800"></div>
                                            <div class="absolute top-6 left-1 right-1 h-0.5 bg-gray-800"></div>
                                            <!-- Premium Windows -->
                                            <div class="absolute top-1 left-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                                            <div class="absolute top-1 right-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                                            <div class="absolute top-3 left-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                                            <div class="absolute top-3 right-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                                            <div class="absolute top-5 left-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
                                            <div class="absolute top-5 right-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
                                            <!-- Premium Door -->
                                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-700 rounded-t-sm"></div>
                                        </div>
                                        <!-- Enhanced Glow Effect -->
                                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/30 to-teal-500/30 rounded-2xl blur-sm group-hover:blur-md transition-all duration-500"></div>
                                    </div>
                                    <!-- Enhanced Floating Particles -->
                                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-emerald-400 rounded-full animate-ping"></div>
                                    <div class="absolute -bottom-1 -left-1 w-1.5 h-1.5 bg-teal-400 rounded-full animate-ping delay-1000"></div>
                                    <div class="absolute top-1/2 -right-0.5 w-1 h-1 bg-cyan-400 rounded-full animate-ping delay-500"></div>
                                </div>

                                <!-- Enhanced Typography -->
                                <div class="flex flex-col">
                                    <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 bg-clip-text text-transparent group-hover:scale-105 transition-transform duration-300">
                                        BDARU
                                    </h1>
                                    <p class="text-xs text-gray-700 font-semibold tracking-wider uppercase opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        {{ props.museumSettings?.museum_name || 'Museum Digital Balai Adat Rajo Penghulu BDARU' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Navigation Menu -->
        <div class="hidden lg:block w-full mt-20 bg-white/95 backdrop-blur-lg border-b border-gray-200/50 shadow-sm">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center items-center py-6">
                    <!-- Desktop Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Beranda -->
                        <Link
                            href="/"
                            class="group relative px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                <span>Beranda</span>
                            </span>
                        </Link>

                        <!-- Koleksi -->
                        <Link
                            href="/collections"
                            class="group relative px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <span>Koleksi</span>
                            </span>
                        </Link>

                        <!-- Berita -->
                        <Link
                            href="/news"
                            class="group relative px-4 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <span>Berita</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full scale-x-100"></div>
                        </Link>

                        <!-- Agenda -->
                        <Link
                            href="/events"
                            class="group relative px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Agenda</span>
                            </span>
                        </Link>

                        <!-- Kontak -->
                        <Link
                            href="/contact"
                            class="group relative px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>Kontak</span>
                            </span>
                        </Link>

                        <!-- Profil -->
                        <Link
                            href="/about"
                            class="group relative px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Profil</span>
                            </span>
                        </Link>

                        <!-- Testimoni -->
                        <Link
                            href="/testimonials"
                            class="group relative px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span>Testimoni</span>
                            </span>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="relative py-16 lg:py-24 bg-gradient-to-br from-white via-emerald-50 to-teal-100 overflow-hidden min-h-[80vh]" :class="{ 'mt-16 lg:mt-0': !mobileMenuOpen, 'mt-0': mobileMenuOpen }">
            <!-- Enhanced Animated Background Elements -->
            <div class="absolute inset-0">
                <!-- Enhanced Floating Orbs -->
                <div class="absolute top-0 left-0 w-64 h-64 bg-emerald-300/40 rounded-full blur-3xl animate-float-slow"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 bg-teal-300/40 rounded-full blur-3xl animate-float-medium"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-56 h-56 bg-cyan-300/40 rounded-full blur-3xl animate-float-fast"></div>

                <!-- Enhanced Particle Effects -->
                <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-emerald-500 rounded-full animate-ping"></div>
                <div class="absolute top-3/4 right-1/4 w-1.5 h-1.5 bg-teal-500 rounded-full animate-ping delay-1000"></div>
                <div class="absolute bottom-1/4 left-3/4 w-2 h-2 bg-cyan-500 rounded-full animate-ping delay-2000"></div>

                <!-- Enhanced Geometric Shapes -->
                <div class="absolute top-1/3 right-1/3 w-8 h-8 border-2 border-emerald-400/40 rotate-45 animate-spin-slow"></div>
                <div class="absolute bottom-1/3 left-1/3 w-6 h-6 border-2 border-teal-400/40 rotate-45 animate-spin-medium"></div>
            </div>

            <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                    <!-- Left Content -->
                    <div class="w-full lg:w-1/2 text-center lg:text-left">
                        <!-- Enhanced Badge -->
                        <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 rounded-full border-2 border-emerald-200 mb-6 group hover:bg-gradient-to-r hover:from-emerald-200 hover:to-teal-200 transition-all duration-300 shadow-lg">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></div>
                            <span class="text-sm font-bold">📰 Detail Berita</span>
                        </div>

                        <!-- Enhanced Main Heading -->
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                            <span class="bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 bg-clip-text text-transparent animate-gradient">
                                {{ props.news?.title || 'Detail Berita' }}
                            </span>
                        </h1>

                        <!-- Enhanced Subtitle -->
                        <p class="text-lg md:text-xl mb-8 leading-relaxed text-gray-700 font-medium max-w-2xl mx-auto lg:mx-0">
                            {{ props.news?.excerpt || 'Temukan detail lengkap tentang berita ini. Dapatkan informasi terkini tentang kegiatan, pengumuman, dan perkembangan Museum Digital Balai Adat Rajo Penghulu BDARU.' }}
                        </p>

                        <!-- Enhanced CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="#news-detail" class="group relative px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                    <span>Lihat Detail</span>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
                        </div>
                    </div>

                    <!-- Right Content - Enhanced Illustration -->
                    <div class="w-full lg:w-1/2 flex justify-center lg:justify-end">
                        <div class="relative w-full max-w-lg">
                            <!-- Enhanced Main Illustration -->
                            <div class="relative w-full h-96 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-3xl shadow-2xl overflow-hidden transform rotate-3 hover:rotate-0 transition-transform duration-500">
                                <!-- Enhanced News Detail Design -->
                                <div class="absolute inset-4 bg-white rounded-2xl shadow-lg">
                                    <!-- News Detail Header -->
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white p-4 rounded-t-2xl">
                                        <div class="text-center">
                                            <h3 class="text-xl font-bold">Detail Berita</h3>
                                            <p class="text-sm opacity-90">Museum Digital Balai Adat Rajo Penghulu</p>
                                        </div>
                                    </div>

                                    <!-- News Detail Content -->
                                    <div class="p-4 space-y-3">
                                        <div class="flex items-center space-x-3 p-2 bg-emerald-50 rounded-lg">
                                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Kategori</p>
                                                <p class="text-xs text-gray-600">{{ props.news?.news_category?.name || 'Berita' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 p-2 bg-teal-50 rounded-lg">
                                            <div class="w-3 h-3 bg-teal-500 rounded-full"></div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Tanggal Publikasi</p>
                                                <p class="text-xs text-gray-600">{{ props.news?.published_at || 'TBA' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 p-2 bg-cyan-50 rounded-lg">
                                            <div class="w-3 h-3 bg-cyan-500 rounded-full"></div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Dilihat</p>
                                                <p class="text-xs text-gray-600">{{ props.news?.view_count || 0 }} kali</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Floating Elements -->
                            <div class="absolute -top-4 -right-4 w-16 h-16 bg-emerald-400/20 rounded-full blur-xl animate-float-slow"></div>
                            <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-teal-400/20 rounded-full blur-xl animate-float-medium"></div>
                            <div class="absolute top-1/2 -right-8 w-12 h-12 bg-cyan-400/20 rounded-full blur-xl animate-float-fast"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    news: {
        type: Object,
        required: true,
    },
    relatedNews: {
        type: Array,
        default: () => [],
    },
    recentNews: {
        type: Array,
        default: () => [],
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    museumSettings: {
        type: Object,
        default: () => ({}),
    },
});

const showBackToTop = ref(false);
const mobileMenuOpen = ref(false);
const imageLoaded = ref(props.news.image_url ? false : true); // If no image, set to true immediately

function handleImageError(event) {
    event.target.src = 'https://via.placeholder.com/1200/600/4F46E5/FFFFFF?text=BDARU+News';
}

function handleImageLoad() {
    imageLoaded.value = true;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}

function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'k';
    }
    return num.toString();
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Particle System Function
function initParticleSystem() {
    console.log('Initializing particle system...');
    const canvas = document.getElementById('particleCanvas');
    console.log('Canvas element:', canvas);
    if (!canvas) {
        console.error('Canvas element not found!');
        return;
    }

    const ctx = canvas.getContext('2d');
    let animationId;
    let particles = [];
    let mouse = { x: 0, y: 0 };

    // Set canvas size
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    // Particle class
    class Particle {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.size = Math.random() * 3 + 1;
            this.speedX = Math.random() * 2 - 1;
            this.speedY = Math.random() * 2 - 1;
            this.life = Math.random() * 100 + 50;
            this.maxLife = this.life;
            this.color = getRandomColor();
            this.opacity = Math.random() * 0.7 + 0.4;
        }

        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            this.life--;

            // Bounce off edges
            if (this.x > canvas.width || this.x < 0) this.speedX *= -1;
            if (this.y > canvas.height || this.y < 0) this.speedY *= -1;

            // Mouse interaction
            const dx = mouse.x - this.x;
            const dy = mouse.y - this.y;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < 100) {
                const angle = Math.atan2(dy, dx);
                this.x -= Math.cos(angle) * 2;
                this.y -= Math.sin(angle) * 2;
            }

            // Fade out as life decreases
            this.opacity = (this.life / this.maxLife) * 0.5 + 0.3;
        }

        draw() {
            ctx.save();
            ctx.globalAlpha = this.opacity;

            // Add glow effect
            ctx.shadowColor = this.color;
            ctx.shadowBlur = 10;
            ctx.fillStyle = this.color;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();

            // Reset shadow
            ctx.shadowBlur = 0;
            ctx.restore();
        }
    }

    // Get random color
    function getRandomColor() {
        const colors = [
            '#fbbf24', // yellow
            '#10b981', // emerald
            '#3b82f6', // blue
            '#f97316', // orange
            '#8b5cf6', // violet
            '#ec4899'  // pink
        ];
        return colors[Math.floor(Math.random() * colors.length)];
    }

    // Create particles
    function createParticles() {
        for (let i = 0; i < 80; i++) {
            particles.push(new Particle(
                Math.random() * canvas.width,
                Math.random() * canvas.height
            ));
        }
    }

    // Animation loop
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Update and draw particles
        particles.forEach((particle, index) => {
            particle.update();
            particle.draw();

            // Remove dead particles
            if (particle.life <= 0) {
                particles.splice(index, 1);
            }
        });

        // Draw connections between nearby particles
        particles.forEach((particle1, i) => {
            particles.slice(i + 1).forEach((particle2) => {
                const dx = particle1.x - particle2.x;
                const dy = particle1.y - particle2.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < 100) {
                    ctx.save();
                    ctx.globalAlpha = (100 - distance) / 100 * 0.5;
                    ctx.strokeStyle = '#10b981';
                    ctx.lineWidth = 1.5;
                    ctx.beginPath();
                    ctx.moveTo(particle1.x, particle1.y);
                    ctx.lineTo(particle2.x, particle2.y);
                    ctx.stroke();
                    ctx.restore();
                }
            });
        });

        // Add new particles if needed
        if (particles.length < 30) {
            createParticles();
        }

        animationId = requestAnimationFrame(animate);
    }

    // Mouse tracking
    canvas.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });

    // Initialize
    createParticles();
    animate();

    // Cleanup function
    return () => {
        if (animationId) {
            cancelAnimationFrame(animationId);
        }
    };
}

onMounted(() => {
    const handleScroll = () => {
        showBackToTop.value = window.scrollY > 300;
    };
    window.addEventListener('scroll', handleScroll);

    // Initialize particle system
    initParticleSystem();

    return () => {
        window.removeEventListener('scroll', handleScroll);
    };
});
</script>

<style scoped>
/* Custom animations */
@keyframes float-slow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes float-medium {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-medium {
    animation: float-medium 4s ease-in-out infinite;
}

/* Line clamp utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

.prose {
    max-width: none;
}

.prose img {
    border-radius: 0.5rem;
    margin: 1.5rem 0;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #1f2937;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose p {
    margin-bottom: 1.5rem;
    line-height: 1.75;
}

.prose a {
    color: #059669;
    text-decoration: underline;
}
</style>
