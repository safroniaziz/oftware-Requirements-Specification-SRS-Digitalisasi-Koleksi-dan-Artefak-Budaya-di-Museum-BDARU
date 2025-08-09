<template>
    <Head :title="`${news.title} - BDARU Museum Digital Balai Adat Rajo Penghulu`" />

    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <Link href="/" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                            <span class="text-white font-bold text-lg">B</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">BDARU</h1>
                            <p class="text-xs text-gray-500 -mt-1">Museum Digital</p>
                        </div>
                    </Link>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <Link href="/" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors duration-200">
                        Beranda
                    </Link>
                    <Link href="/collections" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors duration-200">
                        Koleksi
                    </Link>
                    <Link href="/news" class="text-emerald-600 font-semibold border-b-2 border-emerald-600">
                        Berita
                    </Link>
                    <Link href="/about" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors duration-200">
                        Tentang
                    </Link>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <Link v-if="canLogin" href="/login" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors duration-200">
                        Masuk
                    </Link>
                    <Link v-if="canRegister" href="/register" class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-emerald-700 transition-colors duration-200">
                        Daftar
                    </Link>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-emerald-50 via-white to-teal-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-8">
                <Link href="/" class="hover:text-emerald-600 transition-colors duration-200">Beranda</Link>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <Link href="/news" class="hover:text-emerald-600 transition-colors duration-200">Berita</Link>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900">{{ news.title }}</span>
            </nav>

            <!-- Article Header -->
            <div class="text-center">
                <!-- Category Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-800 rounded-full text-sm font-medium mb-6">
                    {{ news.category?.name || 'Berita' }}
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 mb-6 leading-tight">
                    {{ news.title }}
                </h1>

                <!-- Meta -->
                <div class="flex items-center justify-center space-x-6 text-gray-600 mb-8">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ formatDate(news.published_at) }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span>{{ formatNumber(news.view_count || 0) }} views</span>
                    </div>
                    <div v-if="news.is_featured" class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="text-yellow-600 font-medium">Featured</span>
                    </div>
                </div>

                <!-- Excerpt -->
                <p v-if="news.excerpt" class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                    {{ news.excerpt }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Article Content -->
                <div class="lg:col-span-3">
                    <!-- Featured Image -->
                    <div class="mb-8">
                        <img
                            :src="news.image_path || 'https://via.placeholder.com/1200/600/4F46E5/FFFFFF?text=BDARU+News'"
                            :alt="news.title"
                            class="w-full h-96 lg:h-[500px] object-cover rounded-2xl shadow-lg"
                            @error="handleImageError"
                        >
                    </div>

                    <!-- Article Body -->
                    <article class="prose prose-lg max-w-none">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <div v-html="news.content" class="text-gray-700 leading-relaxed"></div>
                        </div>
                    </article>

                    <!-- Share Section -->
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan Artikel</h3>
                        <div class="flex items-center space-x-4">
                            <button class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                                <span>Twitter</span>
                            </button>
                            <button class="flex items-center space-x-2 px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span>Facebook</span>
                            </button>
                            <button class="flex items-center space-x-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                <span>WhatsApp</span>
                            </button>
                        </div>
                    </div>

                    <!-- Related News -->
                    <div v-if="relatedNews.length > 0" class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Berita Terkait</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <article
                                v-for="article in relatedNews"
                                :key="article.id"
                                class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 group"
                            >
                                <Link :href="`/news/${article.id}`">
                                    <div class="relative h-48 overflow-hidden">
                                        <img
                                            :src="article.image_path || 'https://via.placeholder.com/400/300/4F46E5/FFFFFF?text=News'"
                                            :alt="article.title"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            @error="handleImageError"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="text-lg font-semibold text-gray-900 line-clamp-2 group-hover:text-emerald-600 transition-colors duration-200">
                                            {{ article.title }}
                                        </h4>
                                        <p class="text-sm text-gray-500 mt-2">{{ formatDate(article.published_at) }}</p>
                                    </div>
                                </Link>
                            </article>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Recent News -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
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
                                            :src="article.image_path || 'https://via.placeholder.com/80/60/4F46E5/FFFFFF?text=News'"
                                            :alt="article.title"
                                            class="w-16 h-12 object-cover rounded-lg flex-shrink-0"
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

                    <!-- Back to News -->
                    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Kembali ke Berita</h3>
                        <p class="text-gray-600 text-sm mb-4">Jelajahi berita terbaru lainnya dari Museum Digital Balai Adat Rajo Penghulu.</p>
                        <Link
                            href="/news"
                            class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors duration-200"
                        >
                            Lihat Semua Berita
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 2.567-1.653 0-2.646-1.02-4.2-2.445-4.2zM12.017 24C5.396 24 .029 18.633.029 12.013c0-5.079 3.158-9.417 7.618-11.174.937.948 1.397 2.4 1.397 3.348 0 1.425-5.958 1.425-11.916 0-17.874C18.641 2.634 24 7.968 24 14.587c0 5.079-3.158 9.417-7.618 11.174z"/>
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

            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 BDARU Museum Digital Balai Adat Rajo Penghulu. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button
        @click="scrollToTop"
        class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 hover:scale-110 transition-all duration-300 z-50 group"
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
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-700 to-teal-700 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
    </button>
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
});

const showBackToTop = ref(false);

function handleImageError(event) {
    event.target.src = 'https://via.placeholder.com/1200/600/4F46E5/FFFFFF?text=BDARU+News';
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

.prose a:hover {
    color: #047857;
}
</style>
