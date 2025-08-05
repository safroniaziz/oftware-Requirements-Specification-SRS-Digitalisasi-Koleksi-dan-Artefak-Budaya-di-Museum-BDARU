<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Navigation, Pagination, EffectFade } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

// Reactive data
const selectedCategory = ref('all');
const searchQuery = ref('');
const sortBy = ref('latest');
const viewMode = ref('grid'); // 'grid' or 'list'
const showFilters = ref(false);
const loading = ref(false);

// Sample collection data
const collections = ref([
    {
        id: 1,
        name: 'Lukisan Klasik Indonesia',
        description: 'Koleksi lukisan klasik yang menggambarkan keindahan alam dan budaya Indonesia dari berbagai era, termasuk karya-karya maestro seni rupa Indonesia.',
        category: { name: 'Seni Rupa', slug: 'seni-rupa' },
        image_path: 'https://picsum.photos/800/600?random=1',
        year_period: '1800-1950',
        origin_location: 'Jawa Tengah',
        view_count: 2540,
        is_featured: true,
        created_at: '2024-01-15'
    },
    {
        id: 2,
        name: 'Artefak Kerajaan Majapahit',
        description: 'Peninggalan arkeologi dari era Kerajaan Majapahit yang menceritakan kejayaan peradaban Indonesia pada masa lampau.',
        category: { name: 'Arkeologi', slug: 'arkeologi' },
        image_path: 'https://picsum.photos/800/600?random=2',
        year_period: '1293-1527',
        origin_location: 'Jawa Timur',
        view_count: 1890,
        is_featured: true,
        created_at: '2024-01-10'
    },
    {
        id: 3,
        name: 'Batik Parang Kraton',
        description: 'Batik parang kraton dengan motif geometris yang melambangkan kekuatan dan kesinambungan dalam budaya Jawa.',
        category: { name: 'Tekstil', slug: 'tekstil' },
        image_path: 'https://picsum.photos/800/600?random=3',
        year_period: '1700-1900',
        origin_location: 'Yogyakarta',
        view_count: 3200,
        is_featured: true,
        created_at: '2024-01-20'
    },
    {
        id: 4,
        name: 'Wayang Kulit Purwa',
        description: 'Koleksi wayang kulit purwa yang menggambarkan tokoh-tokoh dalam epos Mahabharata dan Ramayana.',
        category: { name: 'Wayang', slug: 'wayang' },
        image_path: 'https://picsum.photos/800/600?random=4',
        year_period: '1600-1900',
        origin_location: 'Jawa Tengah',
        view_count: 2100,
        is_featured: false,
        created_at: '2024-01-05'
    },
    {
        id: 5,
        title: 'Keris Pusaka',
        subtitle: 'Senjata Tradisional Sakral',
        description: 'Keris pusaka dengan pamor dan dapur yang unik, melambangkan kekuatan spiritual dan kebanggaan budaya.',
        category: 'keris',
        categoryLabel: 'Keris',
        image: 'https://picsum.photos/800/600?random=5',
        year: '1400-1800',
        artist: 'Empu Keris',
        location: 'Jawa',
        material: 'Besi & Nikel',
        dimensions: '35 x 3 cm',
        status: 'Konservasi',
        views: 1650,
        likes: 134,
        rating: 4.6,
        tags: ['Pusaka', 'Sakral', 'Empu'],
        featured: false,
        createdAt: '2024-01-12'
    },
    {
        id: 6,
        title: 'Gamelan Jawa',
        subtitle: 'Ensambel Musik Tradisional',
        description: 'Gamelan Jawa lengkap dengan berbagai instrumen yang menghasilkan harmoni musik tradisional yang khas.',
        category: 'musik',
        categoryLabel: 'Musik',
        image: 'https://picsum.photos/800/600?random=6',
        year: '1700-1900',
        artist: 'Pengrajin Gamelan',
        location: 'Jawa Tengah',
        material: 'Perunggu & Kayu',
        dimensions: 'Set Lengkap',
        status: 'Dipamerkan',
        views: 2800,
        likes: 212,
        rating: 4.8,
        tags: ['Ensambel', 'Musik', 'Tradisional'],
        featured: false,
        createdAt: '2024-01-18'
    }
]);

// Categories
const categories = [
    { id: 'all', label: 'Semua Kategori', icon: '🏛️', count: collections.value.length },
    { id: 'seni-rupa', label: 'Seni Rupa', icon: '🎨', count: collections.value.filter(c => c.category === 'seni-rupa').length },
    { id: 'arkeologi', label: 'Arkeologi', icon: '🏺', count: collections.value.filter(c => c.category === 'arkeologi').length },
    { id: 'tekstil', label: 'Tekstil', icon: '🧵', count: collections.value.filter(c => c.category === 'tekstil').length },
    { id: 'wayang', label: 'Wayang', icon: '🎭', count: collections.value.filter(c => c.category === 'wayang').length },
    { id: 'keris', label: 'Keris', icon: '⚔️', count: collections.value.filter(c => c.category === 'keris').length },
    { id: 'musik', label: 'Musik', icon: '🎵', count: collections.value.filter(c => c.category === 'musik').length }
];

// Computed properties
const filteredCollections = computed(() => {
    let filtered = collections.value;

    // Filter by category
    if (selectedCategory.value !== 'all') {
        filtered = filtered.filter(collection => collection.category === selectedCategory.value);
    }

    // Filter by search query
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(collection =>
            collection.title.toLowerCase().includes(query) ||
            collection.subtitle.toLowerCase().includes(query) ||
            collection.description.toLowerCase().includes(query) ||
            collection.tags.some(tag => tag.toLowerCase().includes(query))
        );
    }

    // Sort collections
    switch (sortBy.value) {
        case 'latest':
            filtered = [...filtered].sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
            break;
        case 'oldest':
            filtered = [...filtered].sort((a, b) => new Date(a.createdAt) - new Date(b.createdAt));
            break;
        case 'rating':
            filtered = [...filtered].sort((a, b) => b.rating - a.rating);
            break;
        case 'views':
            filtered = [...filtered].sort((a, b) => b.views - a.views);
            break;
        case 'title':
            filtered = [...filtered].sort((a, b) => a.title.localeCompare(b.title));
            break;
    }

    return filtered;
});

// Methods
const handleImageError = (event) => {
    event.target.src = 'https://via.placeholder.com/800x600/4F46E5/FFFFFF?text=BDARU+Museum';
};

const toggleViewMode = () => {
    viewMode.value = viewMode.value === 'grid' ? 'list' : 'grid';
};

const toggleFilters = () => {
    showFilters.value = !showFilters.value;
};

const clearFilters = () => {
    selectedCategory.value = 'all';
    searchQuery.value = '';
    sortBy.value = 'latest';
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
    <Head title="Koleksi Budaya - BDARU Museum Digital Indonesia" />

    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-emerald-900 via-teal-800 to-cyan-900 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-teal-500/20 rounded-full blur-3xl animate-float-medium"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-56 h-56 bg-cyan-500/20 rounded-full blur-3xl animate-float-fast"></div>
        </div>

        <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Badge -->
                <div class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-md text-white rounded-full border border-white/20 mb-8 group hover:bg-white/20 transition-all duration-300">
                    <div class="w-2 h-2 bg-emerald-400 rounded-full mr-3 animate-pulse"></div>
                    <span class="text-sm font-bold">🏛️ Museum Digital Indonesia</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-8 leading-tight">
                    Koleksi <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Budaya</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-emerald-100 mb-12 max-w-4xl mx-auto leading-relaxed">
                    Jelajahi ribuan koleksi budaya Indonesia yang telah didigitalisasi dengan teknologi terkini.
                    <br>
                    <span class="text-lg text-emerald-200">Dari artefak kuno hingga karya seni modern, semua ada di sini.</span>
                </p>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto mb-12">
                    <div class="relative">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Cari koleksi budaya..."
                            class="w-full px-6 py-4 bg-white/10 backdrop-blur-md text-white placeholder-emerald-200 rounded-2xl border-2 border-white/20 focus:border-emerald-400 focus:outline-none transition-all duration-300 text-lg"
                        >
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                            <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="flex justify-center gap-8 text-center">
                    <div class="group hover:scale-110 transition-transform duration-300">
                        <div class="text-3xl font-black text-emerald-300">{{ collections.length }}+</div>
                        <div class="text-sm text-emerald-200 font-semibold">Total Koleksi</div>
                    </div>
                    <div class="group hover:scale-110 transition-transform duration-300">
                        <div class="text-3xl font-black text-teal-300">{{ categories.length - 1 }}</div>
                        <div class="text-sm text-teal-200 font-semibold">Kategori</div>
                    </div>
                    <div class="group hover:scale-110 transition-transform duration-300">
                        <div class="text-3xl font-black text-cyan-300">10K+</div>
                        <div class="text-sm text-cyan-200 font-semibold">Pengunjung</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters and Controls Section -->
    <section class="py-8 bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <!-- Category Filter -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 scrollbar-hide">
                    <button
                        v-for="category in categories"
                        :key="category.id"
                        @click="selectedCategory = category.id"
                        :class="[
                            'flex items-center gap-2 px-4 py-2 rounded-xl font-semibold text-sm whitespace-nowrap transition-all duration-300',
                            selectedCategory === category.id
                                ? 'bg-emerald-600 text-white shadow-lg'
                                : 'bg-gray-100 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'
                        ]"
                    >
                        <span class="text-lg">{{ category.icon }}</span>
                        <span>{{ category.label }}</span>
                        <span class="bg-white/20 px-2 py-0.5 rounded-full text-xs">{{ category.count }}</span>
                    </button>
                </div>

                <!-- Controls -->
                <div class="flex items-center gap-4">
                    <!-- Sort Dropdown -->
                    <div class="relative">
                        <select
                            v-model="sortBy"
                            class="appearance-none px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-semibold text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-300"
                        >
                            <option value="latest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="rating">Rating Tertinggi</option>
                            <option value="views">Terpopuler</option>
                            <option value="title">A-Z</option>
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- View Mode Toggle -->
                    <div class="flex items-center bg-gray-100 rounded-xl p-1">
                        <button
                            @click="viewMode = 'grid'"
                            :class="[
                                'p-2 rounded-lg transition-all duration-300',
                                viewMode === 'grid' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                        <button
                            @click="viewMode = 'list'"
                            :class="[
                                'p-2 rounded-lg transition-all duration-300',
                                viewMode === 'list' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Clear Filters -->
                    <button
                        @click="clearFilters"
                        class="px-4 py-2 text-gray-600 hover:text-emerald-600 font-semibold text-sm transition-colors duration-300"
                    >
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Collections Grid/List Section -->
    <section class="py-16 bg-gray-50">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Results Info -->
            <div class="flex items-center justify-between mb-8">
                <div class="text-gray-600">
                    Menampilkan <span class="font-semibold text-emerald-600">{{ filteredCollections.length }}</span> dari <span class="font-semibold">{{ collections.length }}</span> koleksi
                </div>
                <div class="text-sm text-gray-500">
                    {{ loading ? 'Memuat...' : 'Selesai dimuat' }}
                </div>
            </div>

            <!-- Grid View -->
            <div v-if="viewMode === 'grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="collection in filteredCollections"
                    :key="collection.id"
                    class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100"
                    data-aos="fade-up"
                >
                    <!-- Image Container -->
                    <div class="relative h-64 overflow-hidden">
                        <img
                            :src="collection.image"
                            :alt="collection.title"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            @error="handleImageError"
                        >

                        <!-- Overlay Pattern -->
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20 z-10"></div>

                        <!-- Featured Badge -->
                        <div v-if="collection.featured" class="absolute top-4 left-4 z-20">
                            <span class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-full">
                                ⭐ Featured
                            </span>
                        </div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 right-4 z-20">
                            <span class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                {{ collection.categoryLabel }}
                            </span>
                        </div>

                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-20">
                            <h3 class="text-xl font-bold text-white mb-2">{{ collection.title }}</h3>
                            <p class="text-white/90 text-sm leading-relaxed">{{ collection.subtitle }}</p>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">
                        <!-- Stats Row -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                <span class="text-xs text-gray-500 font-medium">{{ collection.year }}</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-xs text-gray-600 font-medium">{{ collection.rating }}/5</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">{{ collection.description }}</p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span
                                v-for="tag in collection.tags"
                                :key="tag"
                                class="inline-flex items-center px-2 py-1 bg-emerald-50 text-emerald-700 text-xs font-medium rounded-md"
                            >
                                {{ tag }}
                            </span>
                        </div>

                        <!-- Action Button -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-500">{{ collection.views.toLocaleString() }} views</span>
                            </div>
                            <Link
                                :href="`/collections/${collection.id}`"
                                class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-colors duration-200 group-hover:shadow-lg"
                            >
                                Detail
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List View -->
            <div v-else class="space-y-6">
                <div
                    v-for="collection in filteredCollections"
                    :key="collection.id"
                    class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100"
                    data-aos="fade-up"
                >
                    <div class="flex flex-col lg:flex-row">
                        <!-- Image -->
                        <div class="relative lg:w-80 h-64 lg:h-auto overflow-hidden">
                            <img
                                :src="collection.image"
                                :alt="collection.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                @error="handleImageError"
                            >
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20"></div>

                            <!-- Featured Badge -->
                            <div v-if="collection.featured" class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-full">
                                    ⭐ Featured
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors">
                                        {{ collection.title }}
                                    </h3>
                                    <p class="text-lg text-gray-600 mb-3">{{ collection.subtitle }}</p>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="text-lg font-semibold text-gray-700">{{ collection.rating }}/5</span>
                                </div>
                            </div>

                            <p class="text-gray-600 leading-relaxed mb-4">{{ collection.description }}</p>

                            <!-- Details Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                <div class="text-sm">
                                    <span class="text-gray-500">Tahun:</span>
                                    <span class="font-semibold text-gray-900 ml-1">{{ collection.year }}</span>
                                </div>
                                <div class="text-sm">
                                    <span class="text-gray-500">Seniman:</span>
                                    <span class="font-semibold text-gray-900 ml-1">{{ collection.artist }}</span>
                                </div>
                                <div class="text-sm">
                                    <span class="text-gray-500">Lokasi:</span>
                                    <span class="font-semibold text-gray-900 ml-1">{{ collection.location }}</span>
                                </div>
                                <div class="text-sm">
                                    <span class="text-gray-500">Status:</span>
                                    <span class="font-semibold text-emerald-600 ml-1">{{ collection.status }}</span>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span
                                    v-for="tag in collection.tags"
                                    :key="tag"
                                    class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-700 text-sm font-medium rounded-lg"
                                >
                                    {{ tag }}
                                </span>
                            </div>

                            <!-- Action Row -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span>{{ collection.views.toLocaleString() }} views</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        <span>{{ collection.likes }} likes</span>
                                    </div>
                                </div>

                                <Link
                                    :href="`/collections/${collection.id}`"
                                    class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-all duration-200 group-hover:shadow-lg"
                                >
                                    Lihat Detail
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="filteredCollections.length === 0" class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak ada koleksi ditemukan</h3>
                <p class="text-gray-600 mb-8">Coba ubah filter atau kata kunci pencarian Anda.</p>
                <button
                    @click="clearFilters"
                    class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-colors duration-200"
                >
                    Reset Filter
                </button>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-20 bg-gradient-to-br from-emerald-50 via-white to-teal-50">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-8">
                Ingin <span class="text-emerald-600">Kontribusi</span>?
            </h2>
            <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                Apakah Anda memiliki koleksi budaya yang ingin didigitalisasi?
                Mari bergabung dengan kami dalam melestarikan warisan budaya Indonesia.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <Link
                    href="/contact"
                    class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-bold rounded-xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Hubungi Kami
                </Link>
                <Link
                    href="/about"
                    class="inline-flex items-center px-8 py-4 border-2 border-emerald-300 text-emerald-700 font-bold rounded-xl hover:bg-emerald-50 hover:border-emerald-400 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Pelajari Lebih Lanjut
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

@keyframes float-fast {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-medium {
    animation: float-medium 4s ease-in-out infinite;
}

.animate-float-fast {
    animation: float-fast 3s ease-in-out infinite;
}

/* Hide scrollbar for category filter */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* Line clamp utility */
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

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}
</style>
