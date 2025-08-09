<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Navigation, Pagination, EffectFade } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

const props = defineProps({
    collection: {
        type: Object,
        required: true
    },
    relatedCollections: {
        type: Array,
        default: () => []
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

// Reactive data
const activeTab = ref('overview');
const showFullDescription = ref(false);
const imageLoaded = ref(false);

// Methods
const handleImageError = (event) => {
    event.target.src = 'https://via.placeholder.com/800x600/4F46E5/FFFFFF?text=BDARU+Museum';
};

const handleImageLoad = () => {
    imageLoaded.value = true;
};

const toggleDescription = () => {
    showFullDescription.value = !showFullDescription.value;
};

const formatNumber = (num) => {
    if (typeof num === 'number') {
        return num.toLocaleString('id-ID');
    }
    if (typeof num === 'string' && !isNaN(Number(num))) {
        return Number(num).toLocaleString('id-ID');
    }
    return '0';
};

// Lifecycle
onMounted(() => {
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true,
            offset: 50
        });
    }
});
</script>

<template>
    <Head :title="`${collection.name} - BDARU Museum Digital Balai Adat Rajo Penghulu`" />

    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-emerald-900 via-teal-800 to-cyan-900 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-teal-500/20 rounded-full blur-3xl animate-float-medium"></div>
        </div>

        <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <!-- Image Section -->
                <div class="w-full lg:w-1/2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-gray-200">
                        <!-- Loading State -->
                        <div v-if="!imageLoaded" class="absolute inset-0 bg-gradient-to-r from-gray-200 to-gray-300 animate-pulse rounded-2xl">
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-gray-400 rounded-full animate-spin mx-auto mb-3"></div>
                                    <p class="text-gray-500 text-sm">Loading image...</p>
                                </div>
                            </div>
                        </div>

                        <img
                            :src="collection.image_path"
                            :alt="collection.name"
                            class="w-full h-96 lg:h-[500px] object-cover transition-opacity duration-500"
                            :class="{ 'opacity-0': !imageLoaded, 'opacity-100': imageLoaded }"
                            @error="handleImageError"
                            @load="handleImageLoad"
                        >

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>

                        <!-- Featured Badge -->
                        <div v-if="collection.is_featured" class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-full">
                                ⭐ Featured Collection
                            </span>
                        </div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                {{ collection.category?.name || 'Uncategorized' }}
                            </span>
                        </div>

                        <!-- View Count -->
                        <div class="absolute bottom-4 left-4">
                            <div class="flex items-center space-x-2 bg-black/50 backdrop-blur-sm rounded-full px-3 py-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span class="text-white text-sm font-medium">{{ formatNumber(collection.view_count) }} views</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center justify-center lg:justify-start space-x-2 mb-6">
                        <Link href="/" class="text-emerald-300 hover:text-white transition-colors">Beranda</Link>
                        <span class="text-emerald-300">/</span>
                        <Link href="/collections" class="text-emerald-300 hover:text-white transition-colors">Koleksi</Link>
                        <span class="text-emerald-300">/</span>
                        <span class="text-white">{{ collection.name }}</span>
                    </nav>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4 leading-tight">
                        {{ collection.name }}
                    </h1>

                    <!-- Description -->
                    <p class="text-xl text-emerald-100 mb-6">{{ collection.description }}</p>

                    <!-- View Count -->
                    <div class="flex items-center justify-center lg:justify-start space-x-2 mb-6">
                        <span class="text-emerald-200">({{ formatNumber(collection.view_count) }} views)</span>
                    </div>

                    <!-- Quick Info -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="text-emerald-300 text-sm font-medium">Periode Tahun</div>
                            <div class="text-white font-bold">{{ collection.year_period }}</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="text-emerald-300 text-sm font-medium">Kategori</div>
                            <div class="text-white font-bold">{{ collection.category?.name || 'Uncategorized' }}</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="text-emerald-300 text-sm font-medium">Lokasi Asal</div>
                            <div class="text-white font-bold">{{ collection.origin_location }}</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="text-emerald-300 text-sm font-medium">Status</div>
                            <div class="text-white font-bold">{{ collection.is_active ? 'Aktif' : 'Tidak Aktif' }}</div>
                        </div>
                    </div>



                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <button class="inline-flex items-center justify-center px-6 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition-all duration-300 group">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Simpan ke Favorit
                        </button>
                        <button class="inline-flex items-center justify-center px-6 py-3 border-2 border-emerald-400 text-emerald-300 font-bold rounded-xl hover:bg-emerald-400 hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Tabs Section -->
    <section class="py-16 bg-white">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tab Navigation -->
            <div class="flex flex-wrap justify-center border-b border-gray-200 mb-12">
                <button
                    @click="activeTab = 'overview'"
                    :class="[
                        'px-6 py-3 font-semibold text-sm border-b-2 transition-all duration-300',
                        activeTab === 'overview'
                            ? 'border-emerald-500 text-emerald-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    ]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Overview</span>
                    </span>
                </button>
                <button
                    @click="activeTab = 'details'"
                    :class="[
                        'px-6 py-3 font-semibold text-sm border-b-2 transition-all duration-300',
                        activeTab === 'details'
                            ? 'border-emerald-500 text-emerald-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    ]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Detail Teknis</span>
                    </span>
                </button>
                <button
                    @click="activeTab = 'history'"
                    :class="[
                        'px-6 py-3 font-semibold text-sm border-b-2 transition-all duration-300',
                        activeTab === 'history'
                            ? 'border-emerald-500 text-emerald-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    ]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Sejarah</span>
                    </span>
                </button>
                <button
                    @click="activeTab = 'gallery'"
                    :class="[
                        'px-6 py-3 font-semibold text-sm border-b-2 transition-all duration-300',
                        activeTab === 'gallery'
                            ? 'border-emerald-500 text-emerald-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    ]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Galeri</span>
                    </span>
                </button>
            </div>

            <!-- Tab Content -->
            <div class="min-h-[400px]">
                <!-- Overview Tab -->
                <div v-if="activeTab === 'overview'" class="space-y-8" data-aos="fade-up">
                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Deskripsi Koleksi</h2>
                        <div class="text-gray-700 leading-relaxed">
                            <p v-if="!showFullDescription" class="mb-4">
                                {{ collection.description.substring(0, 300) }}...
                            </p>
                            <p v-else class="mb-4">
                                {{ collection.description }}
                            </p>
                            <button
                                @click="toggleDescription"
                                class="text-emerald-600 hover:text-emerald-700 font-semibold transition-colors"
                            >
                                {{ showFullDescription ? 'Sembunyikan' : 'Baca Selengkapnya' }}
                            </button>
                        </div>
                    </div>

                    <!-- Cultural Significance -->
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-8 border border-emerald-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Signifikansi Budaya</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Koleksi ini memiliki nilai budaya yang tinggi dan merupakan bagian penting dari warisan budaya Indonesia.
                            Setiap detail dan elemen dalam koleksi ini menceritakan kisah tentang peradaban, tradisi, dan nilai-nilai
                            yang telah diwariskan dari generasi ke generasi.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Nilai Historis</h4>
                                <p class="text-sm text-gray-600">Menggambarkan periode sejarah penting dalam perkembangan budaya Indonesia</p>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Lokasi Asal</h4>
                                <p class="text-sm text-gray-600">Berasal dari daerah yang kaya akan tradisi dan budaya lokal</p>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Nilai Edukatif</h4>
                                <p class="text-sm text-gray-600">Memberikan pembelajaran tentang teknik dan filosofi budaya tradisional</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details Tab -->
                <div v-if="activeTab === 'details'" class="space-y-8" data-aos="fade-up">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Technical Specifications -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Spesifikasi Teknis</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Material</span>
                                    <span class="text-gray-900 font-semibold">-</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Dimensi</span>
                                    <span class="text-gray-900 font-semibold">-</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Tahun Pembuatan</span>
                                    <span class="text-gray-900 font-semibold">{{ collection.year_period }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Status Konservasi</span>
                                    <span class="text-gray-900 font-semibold">{{ collection.is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Kategori</span>
                                    <span class="text-gray-900 font-semibold">{{ collection.category?.name || 'Uncategorized' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3">
                                    <span class="text-gray-600 font-medium">Rating</span>
                                    <span class="text-gray-900 font-semibold">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Conservation Information -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Konservasi</h3>
                            <div class="space-y-4">
                                <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                                    <h4 class="font-semibold text-emerald-800 mb-2">Kondisi Saat Ini</h4>
                                    <p class="text-emerald-700 text-sm">Koleksi ini telah melalui proses konservasi dan digitalisasi yang ketat untuk memastikan kelestariannya.</p>
                                </div>
                                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                    <h4 class="font-semibold text-blue-800 mb-2">Metode Digitalisasi</h4>
                                    <p class="text-blue-700 text-sm">Menggunakan teknologi fotografi resolusi tinggi dan pemindaian 3D untuk dokumentasi yang akurat.</p>
                                </div>
                                <div class="bg-purple-50 rounded-xl p-4 border border-purple-200">
                                    <h4 class="font-semibold text-purple-800 mb-2">Penyimpanan</h4>
                                    <p class="text-purple-700 text-sm">Disimpan dalam kondisi terkontrol dengan suhu dan kelembaban yang optimal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Tab -->
                <div v-if="activeTab === 'history'" class="space-y-8" data-aos="fade-up">
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Sejarah Koleksi</h3>
                        <div class="space-y-6">
                            <div class="relative pl-8 border-l-4 border-emerald-500">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-emerald-500 rounded-full transform -translate-x-2"></div>
                                <h4 class="font-semibold text-gray-900 mb-2">{{ collection.year_period }}</h4>
                                <p class="text-gray-700">Periode pembuatan koleksi ini, menggambarkan konteks historis dan budaya pada masa tersebut.</p>
                            </div>
                            <div class="relative pl-8 border-l-4 border-teal-500">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-teal-500 rounded-full transform -translate-x-2"></div>
                                                        <h4 class="font-semibold text-gray-900 mb-2">Era Tradisional</h4>
                        <p class="text-gray-700">Dibuat dengan teknik tradisional, menandakan periode keahlian dan tradisi yang berkembang pada masa itu.</p>
                            </div>
                            <div class="relative pl-8 border-l-4 border-cyan-500">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-cyan-500 rounded-full transform -translate-x-2"></div>
                                <h4 class="font-semibold text-gray-900 mb-2">Lokasi Asal</h4>
                                <p class="text-gray-700">Berasal dari {{ collection.origin_location }}, menunjukkan pengaruh budaya dan tradisi lokal yang khas.</p>
                            </div>
                            <div class="relative pl-8 border-l-4 border-purple-500">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-purple-500 rounded-full transform -translate-x-2"></div>
                                <h4 class="font-semibold text-gray-900 mb-2">Era Modern</h4>
                                <p class="text-gray-700">Koleksi ini telah melalui proses digitalisasi dan konservasi untuk memastikan kelestariannya bagi generasi mendatang.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Tab -->
                <div v-if="activeTab === 'gallery'" class="space-y-8" data-aos="fade-up">
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Galeri Detail</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="group relative overflow-hidden rounded-xl">
                                <img
                                                                :src="collection.image_path"
                            :alt="collection.name"
                                    class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                                    @error="handleImageError"
                                >
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <button class="text-white font-semibold">Lihat Detail</button>
                                </div>
                            </div>
                            <!-- Additional gallery images would go here -->
                            <div class="group relative overflow-hidden rounded-xl bg-gray-100 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Gambar tambahan akan ditampilkan di sini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Collections Section -->
    <section v-if="relatedCollections.length > 0" class="py-16 bg-gray-50">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Koleksi <span class="text-emerald-600">Terkait</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jelajahi koleksi lain yang serupa atau berasal dari kategori yang sama
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="related in relatedCollections"
                    :key="related.id"
                    class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100"
                    data-aos="fade-up"
                >
                    <div class="relative h-48 overflow-hidden">
                        <img
                            :src="related.image"
                            :alt="related.title"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            @error="handleImageError"
                        >
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/60 via-black/20 to-transparent">
                            <h3 class="text-lg font-bold text-white mb-1">{{ related.title }}</h3>
                            <p class="text-white/90 text-sm">{{ related.subtitle }}</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-500">{{ related.year }}</span>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">{{ related.rating }}/5</span>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">{{ related.description }}</p>

                        <Link
                            :href="`/collections/${related.id}`"
                            class="inline-flex items-center w-full justify-center px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-colors duration-200"
                        >
                            Lihat Detail
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-20 bg-gradient-to-br from-emerald-50 via-white to-teal-50">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-8">
                Ingin <span class="text-emerald-600">Jelajahi</span> Lebih Banyak?
            </h2>
            <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                Temukan ribuan koleksi budaya Indonesia lainnya yang telah didigitalisasi dengan teknologi terkini.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <Link
                    href="/collections"
                    class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-bold rounded-xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Lihat Semua Koleksi
                </Link>
                <Link
                    href="/about"
                    class="inline-flex items-center px-8 py-4 border-2 border-emerald-300 text-emerald-700 font-bold rounded-xl hover:bg-emerald-50 hover:border-emerald-400 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tentang Museum
                </Link>
            </div>
        </div>
    </section>
</template>

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
</style>
