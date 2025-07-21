<template>
    <MainLayout>
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
                    <Link
                        href="/collections"
                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-10 py-5 rounded-full font-bold text-lg transform hover:scale-105 transition-all duration-300 shadow-2xl"
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
                        class="border-2 border-white text-white px-10 py-5 rounded-full font-bold text-lg hover:bg-white hover:text-blue-900 transition-all duration-300"
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
                        <div class="text-5xl md:text-6xl font-black mb-4 text-yellow-400">
                            {{ stats.totalCollections }}+
                        </div>
                        <div class="text-blue-100 font-semibold text-lg">Koleksi Digital</div>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-8 border border-white/20">
                        <div class="text-5xl md:text-6xl font-black mb-4 text-green-400">
                            {{ stats.totalCategories }}
                        </div>
                        <div class="text-blue-100 font-semibold text-lg">Kategori Budaya</div>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-8 border border-white/20">
                        <div class="text-5xl md:text-6xl font-black mb-4 text-blue-300">
                            {{ stats.totalVisits }}+
                        </div>
                        <div class="text-blue-100 font-semibold text-lg">Kunjungan</div>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-8 border border-white/20">
                        <div class="text-5xl md:text-6xl font-black mb-4 text-purple-300">
                            {{ stats.featuredCollections }}
                        </div>
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
                    <div
                        v-for="(collection, index) in featuredCollections"
                        :key="collection.id"
                        class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100"
                    >
                        <div class="relative h-72 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <div class="absolute inset-0 bg-black/30"></div>
                            <div class="relative z-10 text-white text-center p-6">
                                <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center border border-white/30">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold bg-white/20 px-4 py-2 rounded-full border border-white/30">
                                    {{ collection.category.name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-blue-600 transition-colors">
                                {{ collection.name }}
                            </h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ collection.description }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                                    {{ collection.year_period }}
                                </span>
                                <Link
                                    :href="`/collections/${collection.slug}`"
                                    class="text-blue-600 hover:text-blue-800 font-bold text-sm"
                                >
                                    Lihat Detail →
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-20">
                    <Link
                        href="/collections"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-12 py-5 rounded-full font-bold text-lg transform hover:scale-105 transition-all duration-300 shadow-xl"
                    >
                        <span class="mr-3">Lihat Semua Koleksi</span>
                        <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- News Section -->
        <section class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium mb-6">
                        📰 Berita Terbaru
                    </div>
                    <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-8">
                        Berita & <span class="text-green-600">Kegiatan</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Dapatkan informasi terbaru tentang kegiatan dan perkembangan museum digital kami.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="news in recentNews.slice(0, 3)"
                        :key="news.id"
                        class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100"
                    >
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-blue-100 text-blue-800">
                                        {{ getNewsTypeLabel(news.type) }}
                                    </span>
                                    <span class="text-xs text-gray-500 font-medium">
                                        {{ formatDate(news.published_at) }}
                                    </span>
                                </div>
                                <h4 class="font-bold text-gray-900 mb-3 hover:text-blue-600 transition-colors text-lg">
                                    {{ news.title }}
                                </h4>
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    {{ news.content }}
                                </p>
                                <Link
                                    :href="`/news/${news.slug}`"
                                    class="text-blue-600 hover:text-blue-800 font-bold text-sm"
                                >
                                    Baca Selengkapnya →
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-blue-900 text-white">
            <div class="max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
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
/* Add smooth scrolling */
html {
    scroll-behavior: smooth;
}
</style>
