<template>
    <MainLayout>
        <!-- Hero Section with Video Background -->
        <section class="relative h-screen flex items-center justify-center overflow-hidden">
            <!-- Video Background -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/80 to-purple-900/80"></div>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 text-center text-white max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="animate-fade-in-up">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                            Museum Digital
                        </span>
                        <br>
                        <span class="text-white">BDARU</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 max-w-4xl mx-auto leading-relaxed text-gray-200">
                        Jelajahi kekayaan budaya Indonesia melalui teknologi digital yang inovatif.
                        Temukan warisan budaya dalam format yang modern dan interaktif.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <Link
                            href="/collections"
                            class="group bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-2xl"
                        >
                            <span class="flex items-center gap-2">
                                Jelajahi Koleksi
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </Link>
                        <Link
                            href="/about"
                            class="group border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-indigo-900 transition-all duration-300"
                        >
                            <span class="flex items-center gap-2">
                                Tentang Kami
                                <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                        </Link>
                    </div>
                </div>

                <!-- Scroll Indicator -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-gradient-to-r from-indigo-600 to-purple-600 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-bold mb-2 group-hover:scale-110 transition-transform duration-300">
                            {{ stats.totalCollections }}+
                        </div>
                        <div class="text-indigo-200 font-medium">Koleksi Digital</div>
                    </div>
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-bold mb-2 group-hover:scale-110 transition-transform duration-300">
                            {{ stats.totalCategories }}
                        </div>
                        <div class="text-indigo-200 font-medium">Kategori Budaya</div>
                    </div>
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-bold mb-2 group-hover:scale-110 transition-transform duration-300">
                            {{ stats.totalVisits }}+
                        </div>
                        <div class="text-indigo-200 font-medium">Kunjungan</div>
                    </div>
                    <div class="group">
                        <div class="text-4xl md:text-5xl font-bold mb-2 group-hover:scale-110 transition-transform duration-300">
                            {{ stats.featuredCollections }}
                        </div>
                        <div class="text-indigo-200 font-medium">Koleksi Unggulan</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Collections Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
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
                        class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <div class="relative h-64 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center overflow-hidden">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                            <div class="relative z-10 text-white text-center">
                                <div class="w-16 h-16 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium bg-white/20 px-3 py-1 rounded-full">
                                    {{ collection.category.name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors">
                                {{ collection.name }}
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                {{ collection.description }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 font-medium">{{ collection.year_period }}</span>
                                <Link
                                    :href="`/collections/${collection.slug}`"
                                    class="group inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition-colors"
                                >
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-16">
                    <Link
                        href="/collections"
                        class="group inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-full font-semibold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-xl"
                    >
                        <span class="mr-2">Lihat Semua Koleksi</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- News & Activities Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                    <!-- Latest News -->
                    <div>
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-3xl font-bold text-gray-900">Berita Terbaru</h3>
                            <Link
                                href="/news"
                                class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm flex items-center"
                            >
                                Lihat Semua
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </Link>
                        </div>

                        <div class="space-y-6">
                            <div
                                v-for="news in recentNews.slice(0, 3)"
                                :key="news.id"
                                class="group bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-all duration-300"
                            >
                                <div class="flex items-start gap-4">
                                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span
                                                class="text-xs font-medium px-2.5 py-0.5 rounded-full"
                                                :class="{
                                                    'bg-blue-100 text-blue-800': news.type === 'news',
                                                    'bg-green-100 text-green-800': news.type === 'activity',
                                                    'bg-purple-100 text-purple-800': news.type === 'event'
                                                }"
                                            >
                                                {{ getNewsTypeLabel(news.type) }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ formatDate(news.published_at) }}
                                            </span>
                                        </div>
                                        <h4 class="font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors line-clamp-2">
                                            {{ news.title }}
                                        </h4>
                                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                                            {{ news.content }}
                                        </p>
                                        <Link
                                            :href="`/news/${news.slug}`"
                                            class="text-indigo-600 hover:text-indigo-800 font-medium text-sm inline-flex items-center"
                                        >
                                            Baca Selengkapnya
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-3xl font-bold text-gray-900">Agenda Kegiatan</h3>
                            <Link
                                href="/news"
                                class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm flex items-center"
                            >
                                Lihat Semua
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </Link>
                        </div>

                        <div class="space-y-4">
                            <div
                                v-for="news in recentNews.filter(n => n.type === 'activity' || n.type === 'event').slice(0, 4)"
                                :key="news.id"
                                class="group bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 hover:from-indigo-100 hover:to-purple-100 transition-all duration-300 border border-indigo-100"
                            >
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">
                                            {{ news.title }}
                                        </h4>
                                        <p class="text-gray-600 text-sm mb-2 line-clamp-2">
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
        <section class="py-20 bg-gradient-to-r from-indigo-900 to-purple-900 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    Siap Jelajahi Budaya Indonesia?
                </h2>
                <p class="text-xl text-gray-200 mb-10 leading-relaxed">
                    Bergabunglah dengan ribuan pengunjung yang telah menemukan kekayaan budaya Indonesia
                    melalui platform digital kami yang inovatif.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <Link
                        :href="route('collections.index')"
                        class="group bg-white text-indigo-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-xl"
                    >
                        <span class="flex items-center justify-center gap-2">
                            Mulai Jelajahi
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </Link>
                    <Link
                        :href="route('contact')"
                        class="group border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-indigo-900 transition-all duration-300"
                    >
                        Hubungi Kami
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
