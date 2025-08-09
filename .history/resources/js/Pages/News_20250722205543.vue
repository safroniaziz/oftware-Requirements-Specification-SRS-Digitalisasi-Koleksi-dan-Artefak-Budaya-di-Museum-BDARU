<template>
    <Head title="Berita Terbaru - BDARU Museum Digital Balai Adat Rajo Penghulu" />

    <div class="min-h-screen bg-gray-50">

    <!-- Modern Fixed Navigation Bar -->
    <div class="fixed top-0 left-0 right-0 bg-white/98 backdrop-blur-xl border-b border-gray-200/50 shadow-lg z-50">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Enhanced Logo Section -->
                <div class="flex items-center group">
                    <div class="flex-shrink-0 relative">
                        <div class="flex items-center space-x-3">
                            <!-- Premium Logo Icon -->
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden">
                                    <!-- Premium Museum Icon -->
                                    <div class="w-8 h-6 bg-white/95 rounded-lg relative">
                                        <!-- Premium Building Structure -->
                                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-600 to-teal-600"></div>
                                        <div class="absolute top-2 left-1 right-1 h-0.5 bg-gray-800"></div>
                                        <div class="absolute top-4 left-1 right-1 h-0.5 bg-gray-800"></div>
                                        <!-- Premium Windows -->
                                        <div class="absolute top-1 left-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                                        <div class="absolute top-1 right-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                                        <div class="absolute top-3 left-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                                        <div class="absolute top-3 right-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
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
                                <h1 class="text-2xl font-black bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 bg-clip-text text-transparent group-hover:scale-105 transition-transform duration-300">
                                    BDARU
                                </h1>
                                <p class="text-xs text-gray-700 font-semibold tracking-wider uppercase opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                    Museum Digital Balai Adat Rajo Penghulu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <Link
                        v-if="canLogin"
                        :href="route('login')"
                        class="group relative px-8 py-3 text-gray-700 font-bold rounded-xl border-2 border-gray-200 hover:border-emerald-400 hover:text-emerald-600 transition-all duration-300 overflow-hidden"
                    >
                        <span class="relative z-10 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Login</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="group relative px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 overflow-hidden"
                    >
                        <span class="relative z-10 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <span>Register</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Navigation Menu -->
    <div class="w-full mt-20 bg-white/95 backdrop-blur-lg border-b border-gray-200/50 shadow-sm">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center py-6">
                <div class="flex items-center space-x-2 lg:space-x-8">
                    <!-- Beranda -->
                    <Link
                        href="/"
                        class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
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
                        class="group relative px-6 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <span>Berita Terbaru</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Tentang -->
                    <Link
                        href="/about"
                        class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Tentang</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-emerald-50 via-white to-teal-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-800 rounded-full text-sm font-medium mb-4">
                    📰 Berita Terbaru
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-4">
                    Berita <span class="text-emerald-600">Museum</span> Digital
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed mb-6">
                    Temukan berita terbaru seputar koleksi, pameran, dan perkembangan Museum Digital Balai Adat Rajo Penghulu
                </p>

                <!-- Search Bar -->
                <div class="max-w-xl mx-auto">
                    <div class="relative">
                        <input
                            v-model="searchQuery"
                            @input="handleSearch"
                            type="text"
                            placeholder="Cari berita..."
                            class="w-full px-4 py-3 pl-10 bg-white border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all duration-300"
                        >
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Filters -->
                    <div class="flex flex-wrap items-center justify-between mb-6 bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex flex-wrap items-center gap-3">
                            <!-- Category Filter -->
                            <div class="flex items-center space-x-2">
                                <label class="text-sm font-medium text-gray-700">Kategori:</label>
                                <select v-model="selectedCategory" @change="handleFilter" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="all">Semua Kategori</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.slug">
                                        {{ category.name }} ({{ category.news_count }})
                                    </option>
                                </select>
                            </div>

                            <!-- Sort Filter -->
                            <div class="flex items-center space-x-2">
                                <label class="text-sm font-medium text-gray-700">Urutkan:</label>
                                <select v-model="sortBy" @change="handleFilter" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="latest">Terbaru</option>
                                    <option value="oldest">Terlama</option>
                                    <option value="popular">Terpopuler</option>
                                    <option value="title">Judul A-Z</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ news.total }} berita
                        </div>
                    </div>

                    <!-- News Grid -->
                    <div v-if="news.data.length > 0" class="space-y-6">
                        <article
                            v-for="article in news.data"
                            :key="article.id"
                            class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100 group"
                        >
                            <div class="flex">
                                <!-- Image -->
                                <div class="w-32 h-32 md:w-40 md:h-32 flex-shrink-0">
                                    <img
                                        :src="article.image_path || placeholderImage"
                                        :alt="article.title"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        @error="handleImageError"
                                    >
                                </div>

                                <!-- Content -->
                                <div class="flex-1 p-4">
                                    <!-- Meta -->
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-3 text-xs text-gray-500">
                                            <span class="inline-flex items-center px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full font-medium">
                                                {{ article.category?.name || 'Berita' }}
                                            </span>
                                            <span>{{ formatDate(article.published_at) }}</span>
                                        </div>
                                        <div v-if="article.is_featured" class="flex items-center space-x-1">
                                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="text-xs text-yellow-600 font-medium">Featured</span>
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-600 transition-colors duration-200">
                                        {{ article.title }}
                                    </h3>

                                    <!-- Excerpt -->
                                    <p class="text-gray-600 text-sm leading-relaxed mb-3 line-clamp-2">
                                        {{ article.excerpt || article.content.substring(0, 120) + '...' }}
                                    </p>

                                    <!-- Footer -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2 text-xs text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span>{{ formatNumber(article.view_count || 0) }} views</span>
                                        </div>
                                        <Link
                                            :href="`/news/${article.id}`"
                                            class="inline-flex items-center text-emerald-600 font-semibold text-sm hover:text-emerald-700 transition-colors duration-200"
                                        >
                                            Baca Selengkapnya
                                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- No Results -->
                    <div v-else class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Berita Ditemukan</h3>
                        <p class="text-gray-600 mb-4">Coba ubah filter pencarian Anda atau lihat berita lainnya.</p>
                        <button @click="clearFilters" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                            Reset Filter
                        </button>
                    </div>

                    <!-- Pagination -->
                    <div v-if="news.data.length > 0" class="mt-8">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Menampilkan {{ news.from }} - {{ news.to }} dari {{ news.total }} berita
                            </div>
                            <div class="flex items-center space-x-2">
                                <Link
                                    v-if="news.prev_page_url"
                                    :href="news.prev_page_url"
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200"
                                >
                                    Sebelumnya
                                </Link>
                                <Link
                                    v-if="news.next_page_url"
                                    :href="news.next_page_url"
                                    class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition-colors duration-200"
                                >
                                    Selanjutnya
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Featured News -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            Berita Unggulan
                        </h3>
                        <div class="space-y-4">
                            <article v-for="article in featuredNews" :key="article.id" class="group">
                                <Link :href="`/news/${article.id}`" class="block">
                                    <div class="flex items-start space-x-3">
                                        <img
                                            :src="article.image_path || placeholderImage"
                                            :alt="article.title"
                                            class="w-12 h-12 object-cover rounded-lg flex-shrink-0"
                                            @error="handleImageError"
                                        >
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-semibold text-gray-900 line-clamp-2 group-hover:text-emerald-600 transition-colors duration-200">
                                                {{ article.title }}
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ formatDate(article.published_at) }}</p>
                                        </div>
                                    </div>
                                </Link>
                            </article>
                        </div>
                    </div>

                    <!-- Recent News -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Berita Terbaru
                        </h3>
                        <div class="space-y-4">
                            <article v-for="article in recentNews" :key="article.id" class="group">
                                <Link :href="`/news/${article.id}`" class="block">
                                    <div class="flex items-start space-x-3">
                                        <img
                                            :src="article.image_path || placeholderImage"
                                            :alt="article.title"
                                            class="w-12 h-12 object-cover rounded-lg flex-shrink-0"
                                            @error="handleImageError"
                                        >
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-semibold text-gray-900 line-clamp-2 group-hover:text-emerald-600 transition-colors duration-200">
                                                {{ article.title }}
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ formatDate(article.published_at) }}</p>
                                        </div>
                                    </div>
                                </Link>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-xl">B</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">BDARU</h3>
                            <p class="text-emerald-400 text-sm">Museum Digital Balai Adat Rajo Penghulu</p>
                        </div>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 max-w-md">
                        Platform digital untuk melestarikan dan memperkenalkan kekayaan budaya Indonesia melalui teknologi modern.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><Link href="/" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300">Beranda</Link></li>
                        <li><Link href="/collections" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300">Koleksi</Link></li>
                        <li><Link href="/news" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300">Berita</Link></li>
                        <li><Link href="/about" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300">Tentang</Link></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-300">+62 21 1234 5678</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-300">info@bdaru.id</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-300">Jakarta, Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 BDARU Museum Digital Balai Adat Rajo Penghulu. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button
        @click="scrollToTop"
        class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-110 transition-all duration-300 z-50 group"
        :class="{ 'opacity-0 pointer-events-none': !showBackToTop }"
    >
        <div class="relative w-full h-full flex items-center justify-center">
            <svg
                class="w-5 h-5 transform group-hover:-translate-y-1 transition-transform duration-300"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-700 to-teal-700 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
    </button>
    </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    news: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        default: () => [],
    },
    featuredNews: {
        type: Array,
        default: () => [],
    },
    recentNews: {
        type: Array,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const showBackToTop = ref(false);
const searchQuery = ref(props.filters.search || '');
const selectedCategory = ref(props.filters.category || 'all');
const sortBy = ref(props.filters.sort || 'latest');

// Simple placeholder image using data URI
const placeholderImage = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYwIiBoZWlnaHQ9IjEyOCIgdmlld0JveD0iMCAwIDE2MCAxMjgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxNjAiIGhlaWdodD0iMTI4IiBmaWxsPSIjNEY0NkU1Ii8+Cjx0ZXh0IHg9IjgwIiB5PSI2NCIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjE0IiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5ld3M8L3RleHQ+Cjwvc3ZnPgo=';

function handleSearch() {
    router.get('/news', {
        search: searchQuery.value,
        category: selectedCategory.value,
        sort: sortBy.value,
    }, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
}

function handleFilter() {
    router.get('/news', {
        search: searchQuery.value,
        category: selectedCategory.value,
        sort: sortBy.value,
    }, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
}

function clearFilters() {
    searchQuery.value = '';
    selectedCategory.value = 'all';
    sortBy.value = 'latest';
    router.get('/news', {}, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
}

function handleImageError(event) {
    event.target.src = placeholderImage;
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

onMounted(() => {
    const handleScroll = () => {
        showBackToTop.value = window.scrollY > 300;
    };
    window.addEventListener('scroll', handleScroll);
    return () => {
        window.removeEventListener('scroll', handleScroll);
    };
});
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
