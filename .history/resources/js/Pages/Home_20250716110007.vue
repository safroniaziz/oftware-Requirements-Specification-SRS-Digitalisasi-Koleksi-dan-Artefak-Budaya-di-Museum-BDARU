<template>
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Museum BDARU
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                        Temukan kekayaan budaya Indonesia melalui koleksi digital kami yang berharga
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link
                            :href="route('collections.index')"
                            class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300"
                        >
                            Jelajahi Koleksi
                        </Link>
                        <Link
                            :href="route('about')"
                            class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition duration-300"
                        >
                            Tentang Kami
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Collections -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Koleksi Unggulan</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Pilihan koleksi terbaik yang menampilkan keindahan dan kekayaan budaya Indonesia
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="collection in featuredCollections"
                        :key="collection.id"
                        class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300"
                    >
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500 text-sm">Gambar Koleksi</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ collection.category.name }}
                                </span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                {{ collection.name }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ collection.description }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ collection.year_period }}</span>
                                <Link
                                    :href="route('collections.show', collection.slug)"
                                    class="text-indigo-600 hover:text-indigo-800 font-medium text-sm"
                                >
                                    Lihat Detail →
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <Link
                        :href="route('collections.index')"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300"
                    >
                        Lihat Semua Koleksi
                    </Link>
                </div>
            </div>
        </section>

        <!-- Recent News -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Berita & Kegiatan Terkini</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Update terbaru tentang kegiatan, pameran, dan berita dari Museum BDARU
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="news in recentNews"
                        :key="news.id"
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300"
                    >
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded"
                                    :class="{
                                        'bg-blue-100 text-blue-800': news.type === 'news',
                                        'bg-green-100 text-green-800': news.type === 'activity',
                                        'bg-purple-100 text-purple-800': news.type === 'event'
                                    }"
                                >
                                    {{ getNewsTypeLabel(news.type) }}
                                </span>
                                <span class="text-xs text-gray-500 ml-2">
                                    {{ formatDate(news.published_at) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                {{ news.title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ news.content }}
                            </p>
                            <Link
                                :href="route('news.show', news.slug)"
                                class="text-indigo-600 hover:text-indigo-800 font-medium text-sm"
                            >
                                Baca Selengkapnya →
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <Link
                        :href="route('news.index')"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300"
                    >
                        Lihat Semua Berita
                    </Link>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-indigo-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <div class="text-3xl font-bold mb-2">{{ stats.totalCollections }}</div>
                        <div class="text-indigo-200">Total Koleksi</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">{{ stats.totalCategories }}</div>
                        <div class="text-indigo-200">Kategori Budaya</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">{{ stats.totalVisits }}</div>
                        <div class="text-indigo-200">Kunjungan</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">{{ stats.featuredCollections }}</div>
                        <div class="text-indigo-200">Koleksi Unggulan</div>
                    </div>
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
</style>
