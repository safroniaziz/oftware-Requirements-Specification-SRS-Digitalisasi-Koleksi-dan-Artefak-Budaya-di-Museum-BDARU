<template>
    <Head title="Agenda Kegiatan - BDARU Museum Digital Balai Adat Rajo Penghulu" />

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
                            class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <span>Berita Terbaru</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                        </Link>

                        <!-- Agenda Kegiatan -->
                        <Link
                            href="/agenda"
                            class="group relative px-6 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Agenda Kegiatan</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-100 transition-transform duration-300"></div>
                        </Link>

                        <!-- Kontak Kami -->
                        <Link
                            href="/contact"
                            class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>Kontak Kami</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                        </Link>

                        <!-- Profil Kami -->
                        <Link
                            href="/about"
                            class="group relative px-6 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Profil Kami</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="relative py-20 lg:py-32 bg-gradient-to-br from-emerald-900 via-teal-800 to-cyan-900 overflow-hidden">
            <!-- Particle System Canvas -->
            <canvas id="particleCanvas" class="absolute inset-0 w-full h-full pointer-events-none"></canvas>
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
                        <span class="text-sm font-bold">📅 Agenda Kegiatan</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-8 leading-tight">
                        Agenda <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Kegiatan</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-xl md:text-2xl text-emerald-100 mb-12 max-w-4xl mx-auto leading-relaxed">
                        Temukan kegiatan menarik seputar pameran, workshop, seminar, dan pertunjukan di Museum BDARU.
                        <br>
                        <span class="text-lg text-emerald-200">Dari pameran seni hingga workshop budaya, semua kegiatan ada di sini.</span>
                    </p>

                    <!-- Search Bar -->
                    <div class="max-w-2xl mx-auto mb-12">
                        <div class="relative">
                            <input
                                v-model="searchQuery"
                                @input="handleSearch"
                                type="text"
                                placeholder="Cari kegiatan..."
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
                            <div class="text-3xl font-black text-emerald-300">{{ events.total }}+</div>
                            <div class="text-sm text-emerald-200 font-semibold">Total Kegiatan</div>
                        </div>
                        <div class="group hover:scale-110 transition-transform duration-300">
                            <div class="text-3xl font-black text-teal-300">{{ Object.keys(eventTypes).length }}</div>
                            <div class="text-sm text-teal-200 font-semibold">Jenis Kegiatan</div>
                        </div>
                        <div class="group hover:scale-110 transition-transform duration-300">
                            <div class="text-3xl font-black text-cyan-300">1K+</div>
                            <div class="text-sm text-cyan-200 font-semibold">Peserta</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filters and Controls Section -->
        <section class="py-8 bg-white border-b border-gray-200 sticky top-0 z-40">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                    <!-- Type Filter -->
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 scrollbar-hide">
                        <button
                            v-for="(label, type) in eventTypes"
                            :key="type"
                            @click="selectedType = type"
                            :class="[
                                'flex items-center gap-2 px-4 py-2 rounded-xl font-semibold text-sm whitespace-nowrap transition-all duration-300',
                                selectedType === type
                                    ? 'bg-emerald-600 text-white shadow-lg'
                                    : 'bg-gray-100 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700'
                            ]"
                        >
                            <span class="text-lg">{{ getEventTypeIcon(type) }}</span>
                            <span>{{ label }}</span>
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
                                <option value="upcoming">Akan Datang</option>
                                <option value="oldest">Terlama</option>
                                <option value="title">A-Z</option>
                                <option value="price_low">Harga Terendah</option>
                                <option value="price_high">Harga Tertinggi</option>
                                <option value="featured">Unggulan</option>
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

        <!-- News Grid/List Section -->
        <section class="py-16 bg-gray-50">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Results Info -->
                <div class="flex items-center justify-between mb-8">
                    <div class="text-gray-600">
                        Menampilkan <span class="font-semibold text-emerald-600">{{ filteredEvents.length }}</span> dari <span class="font-semibold">{{ events?.total || 0 }}</span> kegiatan
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ loading ? 'Memuat...' : 'Selesai dimuat' }}
                    </div>
                </div>

            <!-- Events Grid -->
            <div v-if="viewMode === 'grid'" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="event in filteredEvents"
                        :key="event.id"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100"
                        data-aos="fade-up"
                    >
                        <!-- Image Container -->
                        <div class="relative h-64 overflow-hidden">
                            <!-- Loading State -->
                            <div v-if="imageLoadingStates[event.id] !== false" class="absolute inset-0 bg-gradient-to-r from-gray-200 to-gray-300 animate-pulse rounded-t-2xl">
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="w-8 h-8 bg-gray-400 rounded-full animate-spin mx-auto mb-2"></div>
                                        <p class="text-gray-500 text-xs">Loading...</p>
                                    </div>
                                </div>
                            </div>

                            <img
                                :src="event.image || placeholderImage"
                                :alt="event.title"
                                :data-event-id="event.id"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                :class="{ 'opacity-0': imageLoadingStates[event.id] !== false, 'opacity-100': imageLoadingStates[event.id] === false }"
                                @error="handleImageError"
                                @load="handleImageLoad"
                                @loadstart="startImageLoading(event.id)"
                            >

                            <!-- Overlay Pattern -->
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20 z-10"></div>

                            <!-- Featured Badge -->
                            <div v-if="event.is_featured" class="absolute top-4 left-4 z-20">
                                <span class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-full">
                                    ⭐ Featured
                                </span>
                            </div>

                            <!-- Type Badge -->
                            <div class="absolute top-4 right-4 z-20">
                                <span class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                    {{ eventTypes[event.type] || 'Kegiatan' }}
                                </span>
                            </div>

                            <!-- Status Badge -->
                            <div class="absolute top-12 right-4 z-20">
                                <span class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                    {{ eventStatuses[event.status] || 'Akan Datang' }}
                                </span>
                            </div>

                            <!-- Content Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-20">
                                <h3 class="text-xl font-bold text-white mb-2">{{ event.title }}</h3>
                                <p class="text-white/90 text-sm leading-relaxed">{{ event.description.substring(0, 100) }}...</p>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Event Info -->
                            <div class="space-y-3 mb-4">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-600 font-medium">{{ formatDate(event.event_date) }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-600 font-medium">{{ formatTime(event.start_time) }} - {{ formatTime(event.end_time) }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-600 font-medium">{{ event.location }}</span>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">{{ event.description.substring(0, 120) + '...' }}</p>

                            <!-- Price and Action -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ formatPrice(event.price) }}</span>
                                </div>
                                <Link
                                    :href="`/agenda/${event.id}`"
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
            </div>

            <!-- Latest News Tab -->
            <div v-else-if="activeTab === 'latest' && viewMode === 'grid'" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="article in filteredNews"
                        :key="article.id"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100"
                        data-aos="fade-up"
                    >
                        <!-- Image Container -->
                        <div class="relative h-64 overflow-hidden">
                            <!-- Loading State -->
                            <div v-if="imageLoadingStates[article.id] !== false" class="absolute inset-0 bg-gradient-to-r from-gray-200 to-gray-300 animate-pulse rounded-t-2xl">
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="w-8 h-8 bg-gray-400 rounded-full animate-spin mx-auto mb-2"></div>
                                        <p class="text-gray-500 text-xs">Loading...</p>
                                    </div>
                                </div>
                            </div>

                            <img
                                :src="article.image_path || placeholderImage"
                                :alt="article.title"
                                :data-article-id="article.id"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                :class="{ 'opacity-0': imageLoadingStates[article.id] !== false, 'opacity-100': imageLoadingStates[article.id] === false }"
                                @error="handleImageError"
                                @load="handleImageLoad"
                                @loadstart="startImageLoading(article.id)"
                            >

                            <!-- Overlay Pattern -->
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20 z-10"></div>

                            <!-- Category Badge -->
                            <div class="absolute top-4 right-4 z-20">
                                <span class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                    {{ article.news_category?.name || 'Berita' }}
                                </span>
                            </div>

                            <!-- Content Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-20">
                                <h3 class="text-xl font-bold text-white mb-2">{{ article.title }}</h3>
                                <p class="text-white/90 text-sm leading-relaxed">{{ article.excerpt || article.content.substring(0, 100) }}...</p>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Stats Row -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                    <span class="text-xs text-gray-500 font-medium">{{ formatDate(article.published_at) }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-600 font-medium">{{ formatNumber(article.view_count || 0) }} views</span>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">{{ article.excerpt || article.content.substring(0, 120) + '...' }}</p>

                            <!-- Action Button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ formatNumber(article.view_count || 0) }} views</span>
                                </div>
                                <Link
                                    :href="`/news/${article.id}`"
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
            </div>

            <!-- List View (when viewMode is list) -->
            <div v-if="viewMode === 'list' && filteredNews.length > 0" class="space-y-6">
                    <div
                        v-for="article in filteredNews"
                        :key="article.id"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100"
                        data-aos="fade-up"
                    >
                        <div class="flex flex-col lg:flex-row">
                            <!-- Image -->
                            <div class="relative lg:w-80 h-64 lg:h-auto overflow-hidden">
                                <!-- Loading State -->
                                <div v-if="imageLoadingStates[article.id] !== false" class="absolute inset-0 bg-gradient-to-r from-gray-200 to-gray-300 animate-pulse">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="w-8 h-8 bg-gray-400 rounded-full animate-spin mx-auto mb-2"></div>
                                            <p class="text-gray-500 text-xs">Loading...</p>
                                        </div>
                                    </div>
                                </div>

                                <img
                                    :src="article.image_path || placeholderImage"
                                    :alt="article.title"
                                    :data-article-id="article.id"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                    :class="{ 'opacity-0': imageLoadingStates[article.id] !== false, 'opacity-100': imageLoadingStates[article.id] === false }"
                                    @error="handleImageError"
                                    @load="handleImageLoad"
                                    @loadstart="startImageLoading(article.id)"
                                >
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20"></div>

                                <!-- Featured Badge -->
                                <div v-if="article.is_featured" class="absolute top-4 left-4">
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
                                            {{ article.title }}
                                        </h3>
                                        <p class="text-lg text-gray-600 mb-3">{{ article.excerpt || article.content.substring(0, 100) }}...</p>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span class="text-lg font-semibold text-gray-700">{{ formatNumber(article.view_count || 0) }} views</span>
                                    </div>
                                </div>

                                <p class="text-gray-600 leading-relaxed mb-4">{{ article.excerpt || article.content.substring(0, 200) + '...' }}</p>

                                <!-- Details Grid -->
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ formatDate(article.published_at) }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ article.news_category?.name || 'Berita' }}</span>
                                    </div>
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
                                        <span class="text-xs text-gray-500">{{ formatNumber(article.view_count || 0) }} views</span>
                                    </div>
                                    <Link
                                        :href="`/news/${article.id}`"
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



                <!-- Empty State -->
                <div v-if="filteredNews.length === 0" class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ activeTab === 'featured' ? 'Tidak ada berita unggulan' : 'Tidak ada berita ditemukan' }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        {{ activeTab === 'featured' ? 'Belum ada berita yang diunggulkan saat ini.' : 'Coba ubah filter atau kata kunci pencarian Anda.' }}
                    </p>
                    <button
                        @click="clearFilters"
                        class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-colors duration-200"
                    >
                        Reset Filter
                    </button>
                </div>
            </div>
        </section>
    </div>
    <!-- Modern Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Enhanced Logo & Description -->
                <div class="lg:col-span-2">
                    <div class="flex items-center group mb-6">
                        <div class="flex-shrink-0 relative">
                            <div class="flex items-center space-x-3">
                                <!-- Premium Logo Icon -->
                                <div class="relative">
                                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden">
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
                                    <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-400 bg-clip-text text-transparent group-hover:scale-105 transition-transform duration-300">
                                        BDARU
                                    </h1>
                                    <p class="text-sm text-gray-300 font-semibold tracking-wider uppercase opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Museum Digital Balai Adat Rajo Penghulu
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 max-w-md">
                        Platform digital terdepan untuk melestarikan dan memperkenalkan kekayaan budaya Indonesia kepada dunia melalui teknologi modern dan inovasi digital.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center hover:scale-110 transition-transform duration-300 shadow-lg hover:shadow-emerald-500/25">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center hover:scale-110 transition-transform duration-300 shadow-lg hover:shadow-emerald-500/25">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center hover:scale-110 transition-transform duration-300 shadow-lg hover:shadow-emerald-500/25">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center hover:scale-110 transition-transform duration-300 shadow-lg hover:shadow-emerald-500/25">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-6">Quick Links</h3>
                    <ul class="space-y-4">
                        <li>
                            <Link href="/" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Beranda</span>
                            </Link>
                        </li>
                        <li>
                            <Link href="/collections" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Koleksi Budaya</span>
                            </Link>
                        </li>
                        <li>
                            <Link href="/news" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Berita Terbaru</span>
                            </Link>
                        </li>
                        <li>
                            <Link href="/about" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Profil Kami</span>
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-6">Kontak Kami</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-300 text-sm">Jl. Museum Nasional No. 1</p>
                                <p class="text-gray-300 text-sm">Jakarta Pusat, 10110</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-300 text-sm">info@bdaru-museum.id</p>
                                <p class="text-gray-300 text-sm">support@bdaru-museum.id</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-300 text-sm">+62 21 386 8172</p>
                                <p class="text-gray-300 text-sm">+62 21 386 8173</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Bottom Bar -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm text-center md:text-left">
                        © 2024 BDARU Museum Digital Balai Adat Rajo Penghulu. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-6 mt-4 md:mt-0">
                        <Link href="/privacy" class="text-gray-400 hover:text-emerald-400 text-sm transition-colors duration-300">
                            Privacy Policy
                        </Link>
                        <Link href="/terms" class="text-gray-400 hover:text-emerald-400 text-sm transition-colors duration-300">
                            Terms of Service
                        </Link>
                        <Link href="/sitemap" class="text-gray-400 hover:text-emerald-400 text-sm transition-colors duration-300">
                            Sitemap
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button
        @click="scrollToTop"
        class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300 z-50 group"
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
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, computed, watch } from 'vue';

const props = defineProps({
    events: {
        type: Object,
        required: true,
    },
    eventTypes: {
        type: Object,
        default: () => ({}),
    },
    eventStatuses: {
        type: Object,
        default: () => ({}),
    },
    featuredEvents: {
        type: Array,
        default: () => [],
    },
    upcomingEvents: {
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
const selectedType = ref(props.filters.type || 'all');
const sortBy = ref(props.filters.sort || 'upcoming');
const viewMode = ref('grid');
const imageLoadingStates = ref({});
const loading = ref(false);

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

// Alternative placeholder images for better reliability
const fallbackImages = [
    'https://via.placeholder.com/800x600/10b981/ffffff?text=Museum+News',
    'https://via.placeholder.com/800x600/0d9488/ffffff?text=Cultural+Event',
    'https://via.placeholder.com/800x600/14b8a6/ffffff?text=Heritage+News',
    'https://via.placeholder.com/800x600/06b6d4/ffffff?text=Art+Exhibition',
    'https://via.placeholder.com/800x600/0891b2/ffffff?text=Workshop',
    'https://via.placeholder.com/800x600/0e7490/ffffff?text=Education',
    'https://via.placeholder.com/800x600/155e75/ffffff?text=Digital+Archive',
    'https://via.placeholder.com/800x600/164e63/ffffff?text=Festival'
];

// Computed properties
const categoriesWithCounts = computed(() => {
    // Get the appropriate data based on active tab
    const currentData = activeTab.value === 'featured'
        ? (props.featuredNews || [])
        : (props.news?.data || []);

    const allCategory = {
        id: 'all',
        icon: '📰',
        label: activeTab.value === 'featured' ? 'Semua Featured' : 'Semua Berita',
        count: currentData.length
    };

    const categoryList = (props.categories || []).map(category => {
        // Count news in current tab data for this category
        const categoryCount = currentData.filter(article =>
            article.news_category?.slug === (category.slug || category.id)
        ).length;

        return {
            id: category.slug || category.id,
            icon: '📄',
            label: category.name,
            count: categoryCount
        };
    });

    return [allCategory, ...categoryList];
});

const filteredNews = computed(() => {
    // Get the appropriate data based on active tab
    let filtered = activeTab.value === 'featured'
        ? (props.featuredNews || [])
        : (props.news?.data || []);

    // Filter by category
    if (selectedCategory.value !== 'all') {
        filtered = filtered.filter(article => article.news_category?.slug === selectedCategory.value);
    }

    // Filter by search
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(article =>
            article.title?.toLowerCase().includes(query) ||
            article.content?.toLowerCase().includes(query) ||
            article.excerpt?.toLowerCase().includes(query)
        );
    }

    return filtered;
});

function handleImageError(event) {
    const articleId = event.target.dataset.articleId;
    const fallbackIndex = (parseInt(articleId) % fallbackImages.length);
    event.target.src = fallbackImages[fallbackIndex];
    imageLoadingStates.value[articleId] = false;
}

function handleImageLoad(event) {
    imageLoadingStates.value[event.target.dataset.articleId] = false;
}

function startImageLoading(articleId) {
    imageLoadingStates.value[articleId] = true;
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

// Watch for tab changes and reset filters
watch(activeTab, () => {
    // Reset filters when switching tabs
    searchQuery.value = '';
    selectedCategory.value = 'all';
    sortBy.value = 'latest';
});

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
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
