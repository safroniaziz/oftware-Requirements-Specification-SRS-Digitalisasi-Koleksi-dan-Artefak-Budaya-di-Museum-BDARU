<template>
    <MainLayout>
        <!-- Hero Section with Video Background -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
            <!-- Animated Background -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/90 to-purple-900/90"></div>
                <div class="absolute inset-0 bg-black/50"></div>
                <!-- Animated particles -->
                <div class="absolute inset-0 opacity-30">
                    <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-blue-400 rounded-full animate-ping"></div>
                    <div class="absolute bottom-1/4 left-1/3 w-1.5 h-1.5 bg-purple-400 rounded-full animate-bounce"></div>
                </div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 text-center text-white max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="animate-fade-in-up">
                    <div class="mb-8">
                        <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-6">
                            <span class="text-sm font-medium">🏛️ Museum Digital Indonesia</span>
                        </div>
                    </div>

                    <h1 class="text-6xl md:text-8xl font-black mb-8 leading-tight">
                        <span class="bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 bg-clip-text text-transparent animate-pulse">
                            BDARU
                        </span>
                    </h1>

                    <p class="text-xl md:text-3xl mb-12 max-w-5xl mx-auto leading-relaxed text-gray-100 font-light">
                        Jelajahi kekayaan budaya Indonesia melalui
                        <span class="font-semibold text-yellow-400">teknologi digital</span> yang inovatif.
                        Temukan warisan budaya dalam format yang modern dan interaktif.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                        <Link
                            href="/collections"
                            class="group bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-5 rounded-full font-bold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-110 transition-all duration-300 shadow-2xl hover:shadow-indigo-500/50"
                        >
                            <span class="flex items-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                Jelajahi Koleksi
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </Link>
                        <Link
                            href="/about"
                            class="group border-2 border-white/30 text-white px-10 py-5 rounded-full font-bold text-lg hover:bg-white hover:text-indigo-900 transition-all duration-300 backdrop-blur-sm hover:border-white"
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

                <!-- Scroll Indicator -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <div class="flex flex-col items-center text-white/70">
                        <span class="text-sm mb-2">Scroll untuk jelajahi</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-20 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-800 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/50 to-purple-600/50"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">Statistik Museum</h2>
                    <p class="text-xl text-indigo-100">Pencapaian kami dalam melestarikan budaya Indonesia</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="group transform hover:scale-110 transition-all duration-300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                            <div class="text-5xl md:text-6xl font-black mb-4 text-yellow-400 group-hover:scale-110 transition-transform duration-300">
                                {{ stats.totalCollections }}+
                            </div>
                            <div class="text-indigo-100 font-semibold text-lg">Koleksi Digital</div>
                        </div>
                    </div>
                    <div class="group transform hover:scale-110 transition-all duration-300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                            <div class="text-5xl md:text-6xl font-black mb-4 text-green-400 group-hover:scale-110 transition-transform duration-300">
                                {{ stats.totalCategories }}
                            </div>
                            <div class="text-indigo-100 font-semibold text-lg">Kategori Budaya</div>
                        </div>
                    </div>
                    <div class="group transform hover:scale-110 transition-all duration-300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                            <div class="text-5xl md:text-6xl font-black mb-4 text-blue-400 group-hover:scale-110 transition-transform duration-300">
                                {{ stats.totalVisits }}+
                            </div>
                            <div class="text-indigo-100 font-semibold text-lg">Kunjungan</div>
                        </div>
                    </div>
                    <div class="group transform hover:scale-110 transition-all duration-300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                            <div class="text-5xl md:text-6xl font-black mb-4 text-purple-400 group-hover:scale-110 transition-transform duration-300">
                                {{ stats.featuredCollections }}
                            </div>
                            <div class="text-indigo-100 font-semibold text-lg">Koleksi Unggulan</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Collections Section -->
        <section class="py-24 bg-gradient-to-br from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium mb-6">
                        🏆 Koleksi Terbaik
                    </div>
                    <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-8">
                        Koleksi <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Unggulan</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Pilihan koleksi terbaik yang menampilkan keindahan dan kekayaan budaya Indonesia
                        dalam format digital yang modern dan interaktif.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="(collection, index) in featuredCollections"
                        :key="collection.id"
                        class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <div class="relative h-72 bg-gradient-to-br from-indigo-500 via-purple-600 to-indigo-700 flex items-center justify-center overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                            <div class="relative z-10 text-white text-center p-6">
                                <div class="w-20 h-20 mx-auto mb-6 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full border border-white/30">
                                    {{ collection.category.name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-indigo-600 transition-colors">
                                {{ collection.name }}
                            </h3>
                            <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {{ collection.description }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                                    {{ collection.year_period }}
                                </span>
                                <Link
                                    :href="`/collections/${collection.slug}`"
                                    class="group inline-flex items-center text-indigo-600 hover:text-indigo-800 font-bold text-sm transition-colors"
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

                <div class="text-center mt-20">
                    <Link
                        href="/collections"
                        class="group inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-12 py-5 rounded-full font-bold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-indigo-500/50"
                    >
                        <span class="mr-3">Lihat Semua Koleksi</span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- News & Activities Section -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                    <!-- Latest News -->
                    <div>
                        <div class="flex items-center justify-between mb-12">
                            <div>
                                <div class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-4">
                                    📰 Berita Terbaru
                                </div>
                                <h3 class="text-4xl font-black text-gray-900">Berita & Kegiatan</h3>
                            </div>
                            <Link
                                href="/news"
                                class="text-indigo-600 hover:text-indigo-800 font-bold text-sm flex items-center group"
                            >
                                Lihat Semua
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </Link>
                        </div>

                        <div class="space-y-8">
                            <div
                                v-for="news in recentNews.slice(0, 3)"
                                :key="news.id"
                                class="group bg-gradient-to-r from-gray-50 to-white rounded-2xl p-8 hover:from-gray-100 hover:to-white transition-all duration-300 border border-gray-100 hover:border-gray-200 hover:shadow-lg"
                            >
                                <div class="flex items-start gap-6">
                                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-3">
                                            <span
                                                class="text-xs font-bold px-3 py-1 rounded-full"
                                                :class="{
                                                    'bg-blue-100 text-blue-800': news.type === 'news',
                                                    'bg-green-100 text-green-800': news.type === 'activity',
                                                    'bg-purple-100 text-purple-800': news.type === 'event'
                                                }"
                                            >
                                                {{ getNewsTypeLabel(news.type) }}
                                            </span>
                                            <span class="text-xs text-gray-500 font-medium">
                                                {{ formatDate(news.published_at) }}
                                            </span>
                                        </div>
                                        <h4 class="font-bold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors line-clamp-2 text-lg">
                                            {{ news.title }}
                                        </h4>
                                        <p class="text-gray-600 text-sm line-clamp-2 mb-4 leading-relaxed">
                                            {{ news.content }}
                                        </p>
                                        <Link
                                            :href="`/news/${news.slug}`"
                                            class="text-indigo-600 hover:text-indigo-800 font-bold text-sm inline-flex items-center group"
                                        >
                                            Baca Selengkapnya
                                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Activities -->
                    <div>
                        <div class="mb-12">
                            <div class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium mb-4">
                                📅 Agenda Kegiatan
                            </div>
                            <h3 class="text-4xl font-black text-gray-900">Event & Kegiatan</h3>
                        </div>

                        <div class="space-y-6">
                            <div
                                v-for="news in recentNews.filter(n => n.type === 'activity' || n.type === 'event').slice(0, 4)"
                                :key="news.id"
                                class="group bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 hover:from-green-100 hover:to-emerald-100 transition-all duration-300 border border-green-100 hover:border-green-200"
                            >
                                <div class="flex items-start gap-4">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">
                                            {{ news.title }}
                                        </h4>
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2 leading-relaxed">
                                            {{ news.content }}
                                        </p>
                                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ news.event_date ? formatDate(news.event_date) : 'TBA' }}
                                            </span>
                                            <span v-if="news.location" class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ news.location }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-900 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/50 to-purple-900/50"></div>
            <!-- Animated background elements -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-yellow-400 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-40 h-40 bg-purple-400 rounded-full blur-3xl animate-bounce"></div>
            </div>

            <div class="relative z-10 max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-6">
                        <span class="text-sm font-medium">🚀 Mulai Petualangan Budaya</span>
                    </div>
                </div>

                <h2 class="text-5xl md:text-7xl font-black mb-8">
                    Siap Jelajahi <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Budaya Indonesia</span>?
                </h2>
                <p class="text-xl md:text-2xl text-gray-200 mb-12 leading-relaxed max-w-4xl mx-auto">
                    Bergabunglah dengan ribuan pengunjung yang telah menemukan kekayaan budaya Indonesia
                    melalui platform digital kami yang inovatif dan modern.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <Link
                        href="/collections"
                        class="group bg-gradient-to-r from-yellow-400 to-orange-500 text-indigo-900 px-12 py-5 rounded-full font-black text-lg hover:from-yellow-500 hover:to-orange-600 transform hover:scale-110 transition-all duration-300 shadow-2xl hover:shadow-yellow-500/50"
                    >
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Mulai Jelajahi
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </Link>
                    <Link
                        href="/contact"
                        class="group border-2 border-white/30 text-white px-12 py-5 rounded-full font-black text-lg hover:bg-white hover:text-indigo-900 transition-all duration-300 backdrop-blur-sm hover:border-white"
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
    </MainLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    featuredCollections: Array,
    recentNews: Array,
    stats: Object
});

const getNewsTypeLabel = (type) => {
    const labels = {
        'news': 'Berita',
        'activity': 'Kegiatan',
        'event': 'Event'
    };
    return labels[type] || type;
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.animate-fade-in-up {
    animation: fadeInUp 1s ease-out;
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

/* Add smooth scrolling */
html {
    scroll-behavior: smooth;
}
</style>
