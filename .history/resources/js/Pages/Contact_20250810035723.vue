<template>
    <Head :title="`Kontak - ${props.museumSettings?.museum_name || 'BDARU Museum Digital Balai Adat Rajo Penghulu'}`" />

    <div class="min-h-screen bg-gray-50">

        <!-- Modern Fixed Navigation Bar -->
        <div class="fixed top-0 left-0 right-0 bg-white/98 backdrop-blur-xl border-b border-gray-200/50 shadow-lg z-50">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <!-- Enhanced Logo Section -->
                    <div class="flex items-center group">
                        <div class="flex-shrink-0 relative">
                            <div class="flex items-center space-x-3">
                                <!-- Static BDARU Logo -->
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden">
                                        <img
                                            src="/assets/src/images/bdaru.jpeg"
                                            alt="BDARU Museum"
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

                    <!-- Desktop Auth Buttons -->
                    <div class="hidden lg:flex items-center space-x-4 flex-shrink-0">
                        <!-- Show user info and logout when logged in -->
                        <div v-if="$page.props.auth.user" class="flex items-center space-x-4">
                            <div class="flex items-center space-x-3 px-4 py-2 bg-emerald-50 rounded-xl border border-emerald-200">
                                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">{{ $page.props.auth.user.name }}</p>
                                    <p class="text-xs text-gray-500">{{ $page.props.auth.user.email }}</p>
                                </div>
                            </div>
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="group relative px-6 py-2 text-red-600 font-bold rounded-xl border-2 border-red-200 hover:border-red-400 hover:text-red-700 hover:bg-red-50 transition-all duration-300"
                            >
                                <span class="relative z-10 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Logout</span>
                                </span>
                            </Link>
                        </div>

                        <!-- Show login/register when not logged in -->
                        <template v-else>
                            <a
                                v-if="canLogin"
                                href="/login"
                                class="group relative px-8 py-3 text-gray-700 font-bold rounded-xl border-2 border-gray-200 hover:border-emerald-400 hover:text-emerald-600 transition-all duration-300 overflow-hidden"
                            >
                                <span class="relative z-10 flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>Login</span>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
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
                        </template>
                    </div>

                    <!-- Mobile Hamburger Menu Button -->
                    <div class="lg:hidden flex-shrink-0">
                        <button
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500 transition-all duration-300"
                        >
                            <svg
                                class="h-6 w-6"
                                :class="{ 'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg
                                class="h-6 w-6"
                                :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
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
                            class="group relative px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <span>Berita</span>
                            </span>
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
                            class="group relative px-4 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>Kontak</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full scale-x-100"></div>
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

        <!-- Mobile Menu Overlay -->
        <div
            v-if="mobileMenuOpen"
            class="fixed inset-0 z-[60] lg:hidden"
            @click="mobileMenuOpen = false"
        >
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

            <!-- Menu Panel -->
            <div class="absolute top-0 right-0 w-80 h-full bg-white shadow-2xl transform transition-transform duration-300">
                <div class="flex flex-col h-full">
                    <!-- Header -->
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900">Menu</h3>
                        <button
                            @click="mobileMenuOpen = false"
                            class="p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex-1 px-6 py-4 space-y-2 overflow-y-auto">
                        <!-- Beranda -->
                        <Link
                            href="/"
                            class="group flex items-center px-4 py-3 text-gray-700 font-bold rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300"
                            @click="mobileMenuOpen = false"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                            <span>Beranda</span>
                        </Link>

                        <!-- Koleksi -->
                        <Link
                            href="/collections"
                            class="group flex items-center px-4 py-3 text-gray-700 font-bold rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300"
                            @click="mobileMenuOpen = false"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span>Koleksi</span>
                        </Link>

                        <!-- Berita -->
                        <Link
                            href="/news"
                            class="group flex items-center px-4 py-3 text-gray-700 font-bold rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300"
                            @click="mobileMenuOpen = false"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <span>Berita</span>
                        </Link>

                        <!-- Agenda -->
                        <Link
                            href="/events"
                            class="group flex items-center px-4 py-3 text-gray-700 font-bold rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300"
                            @click="mobileMenuOpen = false"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Agenda</span>
                        </Link>

                        <!-- Kontak -->
                        <Link
                            href="/contact"
                            class="group flex items-center px-4 py-3 text-emerald-600 font-bold rounded-lg hover:bg-emerald-50 transition-all duration-300"
                            @click="mobileMenuOpen = false"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Kontak</span>
                        </Link>

                        <!-- Profil -->
                        <Link
                            href="/about"
                            class="group flex items-center px-4 py-3 text-gray-700 font-bold rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300"
                            @click="mobileMenuOpen = false"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Profil</span>
                        </Link>

                        <!-- Testimoni -->
                        <Link
                            href="/testimonials"
                            class="group flex items-center px-4 py-3 text-gray-700 font-bold rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300"
                            @click="mobileMenuOpen = false"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>Testimoni</span>
                        </Link>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="p-6 border-t border-gray-200 space-y-3">
                        <!-- Show user info and logout when logged in -->
                        <div v-if="$page.props.auth.user" class="space-y-3">
                            <div class="flex items-center space-x-3 px-4 py-3 bg-emerald-50 rounded-xl border border-emerald-200">
                                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $page.props.auth.user.name }}</p>
                                    <p class="text-sm text-gray-500">{{ $page.props.auth.user.email }}</p>
                                </div>
                            </div>
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="w-full flex items-center justify-center px-4 py-3 text-red-600 font-bold rounded-xl border-2 border-red-200 hover:border-red-400 hover:text-red-700 hover:bg-red-50 transition-all duration-300"
                                @click="mobileMenuOpen = false"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Logout</span>
                            </Link>
                        </div>

                        <!-- Show login/register when not logged in -->
                        <template v-else>
                            <a
                                v-if="canLogin"
                                href="/login"
                                class="w-full group relative px-4 py-3 text-gray-700 font-bold rounded-xl border-2 border-gray-200 hover:border-emerald-400 hover:text-emerald-600 transition-all duration-300 overflow-hidden flex items-center justify-center"
                                @click="mobileMenuOpen = false"
                            >
                                <span class="relative z-10 flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>Login</span>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="w-full group relative px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 overflow-hidden flex items-center justify-center"
                                @click="mobileMenuOpen = false"
                            >
                                <span class="relative z-10 flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    <span>Register</span>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </Link>
                        </template>
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
                            <span class="text-sm font-bold">📞 Hubungi Kami</span>
                        </div>

                        <!-- Enhanced Main Heading -->
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                            <span class="bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 bg-clip-text text-transparent animate-gradient">
                                Hubungi Kami
                            </span>
                        </h1>

                        <!-- Enhanced Subtitle -->
                        <p class="text-lg md:text-xl mb-8 leading-relaxed text-gray-700 font-medium max-w-2xl mx-auto lg:mx-0">
                            Kami siap membantu Anda. Hubungi tim kami untuk informasi lebih lanjut tentang koleksi, pameran, atau layanan Museum Digital Balai Adat Rajo Penghulu BDARU.
                        </p>

                        <!-- Enhanced CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="#contact" class="group relative px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Kirim Pesan</span>
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
                                <!-- Enhanced Contact Design -->
                                <div class="absolute inset-4 bg-white rounded-2xl shadow-lg">
                                    <!-- Contact Header -->
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white p-4 rounded-t-2xl">
                                        <div class="text-center">
                                            <h3 class="text-xl font-bold">Hubungi BDARU</h3>
                                            <p class="text-sm opacity-90">Museum Digital Balai Adat Rajo Penghulu</p>
                                        </div>
                                    </div>

                                    <!-- Contact Information -->
                                    <div class="p-4 space-y-3">
                                        <div class="flex items-center space-x-3 p-2 bg-emerald-50 rounded-lg">
                                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Email</p>
                                                <p class="text-xs text-gray-600">info@bdaru.id</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 p-2 bg-teal-50 rounded-lg">
                                            <div class="w-3 h-3 bg-teal-500 rounded-full"></div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Telepon</p>
                                                <p class="text-xs text-gray-600">0823-7355-5447</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 p-2 bg-cyan-50 rounded-lg">
                                            <div class="w-3 h-3 bg-cyan-500 rounded-full"></div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Alamat</p>
                                                <p class="text-xs text-gray-600">Jakarta, Indonesia</p>
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

        <!-- Contact Information Section -->
        <section class="py-12 lg:py-20 bg-gradient-to-br from-gray-50 to-emerald-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-12 lg:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up">Hubungi Kami</h2>
                    <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto px-4" data-aos="fade-up" data-aos-delay="200">
                        Tim profesional kami siap melayani Anda dengan berbagai saluran komunikasi yang tersedia 24/7
                    </p>
                </div>

                <!-- Contact Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-12 lg:mb-16">
                    <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-12 h-12 lg:w-16 lg:h-16 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4 lg:mb-6">
                            <svg class="w-6 h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-2">2 Saluran</h3>
                        <p class="text-gray-600 text-sm lg:text-base">Telepon Utama</p>
                        <div class="mt-4 space-y-1">
                            <p class="text-sm lg:text-base text-emerald-600 font-semibold">0823-7355-5447</p>
                            <p class="text-sm lg:text-base text-emerald-600 font-semibold">0823-7355-5447</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 text-center" data-aos="fade-up" data-aos-delay="400">
                        <div class="w-12 h-12 lg:w-16 lg:h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-4 lg:mb-6">
                            <svg class="w-6 h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-2">24 Jam</h3>
                        <p class="text-gray-600 text-sm lg:text-base">Waktu Respon</p>
                        <div class="mt-4">
                            <p class="text-sm lg:text-base text-teal-600 font-semibold">Email Support</p>
                            <p class="text-sm lg:text-base text-teal-600 font-semibold">Live Chat</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 text-center sm:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-delay="500">
                        <div class="w-12 h-12 lg:w-16 lg:h-16 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4 lg:mb-6">
                            <svg class="w-6 h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-2">5 Hari</h3>
                        <p class="text-gray-600 text-sm lg:text-base">Jam Operasional</p>
                        <div class="mt-4">
                            <p class="text-sm lg:text-base text-cyan-600 font-semibold">Senin - Jumat</p>
                            <p class="text-sm lg:text-base text-cyan-600 font-semibold">08:00 - 17:00</p>
                        </div>
                    </div>
                </div>

                <!-- Main Contact Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Contact Details -->
                    <div class="space-y-6 lg:space-y-8">
                        <div>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 lg:mb-6" data-aos="fade-up">Informasi Kontak</h3>
                            <p class="text-gray-600 mb-6 lg:mb-8 text-sm lg:text-base" data-aos="fade-up" data-aos-delay="200">
                                Museum Digital Balai Adat Rajo Penghulu BDARU berlokasi strategis di pusat Jakarta dengan akses transportasi yang mudah dan fasilitas yang lengkap.
                            </p>
                        </div>

                        <!-- Contact Cards -->
                        <div class="space-y-4 lg:space-y-6">
                            <!-- Address -->
                            <div class="bg-white rounded-2xl p-4 lg:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                                <div class="flex items-start space-x-3 lg:space-x-4">
                                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-base lg:text-lg font-bold text-gray-900 mb-2">Alamat Kantor</h4>
                                        <p class="text-gray-600 mb-1 text-sm lg:text-base">Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia</p>
                                        <p class="text-gray-600 mb-1 text-sm lg:text-base">Kota Bengkulu, Bengkulu</p>
                                        <p class="text-gray-600 text-sm lg:text-base">Indonesia</p>
                                        <div class="mt-3">
                                            <a href="https://maps.google.com/?q=-3.7956,102.2592" target="_blank" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold text-sm transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                                Lihat di Google Maps
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="bg-white rounded-2xl p-4 lg:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                                <div class="flex items-start space-x-3 lg:space-x-4">
                                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-base lg:text-lg font-bold text-gray-900 mb-2">Email</h4>
                                        <div class="space-y-2">
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Informasi Umum</p>
                                                <a :href="`mailto:${props.museumSettings?.email_info || 'balaiadatrajopenghulu@gmail.com'}`" class="text-teal-600 hover:text-teal-700 font-semibold transition-colors text-sm lg:text-base">balaiadatrajopenghulu@gmail.com</a>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Dukungan Teknis</p>
                                                <a :href="`mailto:${props.museumSettings?.email_support || 'balaiadatrajopenghulu@gmail.com'}`" class="text-teal-600 hover:text-teal-700 font-semibold transition-colors text-sm lg:text-base">balaiadatrajopenghulu@gmail.com</a>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Kerjasama</p>
                                                <a :href="`mailto:${props.museumSettings?.email_partnership || 'partnership@bdaru-museum.id'}`" class="text-teal-600 hover:text-teal-700 font-semibold transition-colors text-sm lg:text-base">balaiadatrajopenghulu@gmail.com</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="bg-white rounded-2xl p-4 lg:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="500">
                                <div class="flex items-start space-x-3 lg:space-x-4">
                                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-base lg:text-lg font-bold text-gray-900 mb-2">Telepon</h4>
                                        <div class="space-y-2">
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Layanan Pelanggan</p>
                                                <a :href="`tel:${props.museumSettings?.phone_1 || '+62213868172'}`" class="text-cyan-600 hover:text-cyan-700 font-semibold transition-colors text-sm lg:text-base">0823-7355-5447</a>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Dukungan Teknis</p>
                                                <a :href="`tel:${props.museumSettings?.phone_2 || '+62213868173'}`" class="text-cyan-600 hover:text-cyan-700 font-semibold transition-colors text-sm lg:text-base">0823-7355-5447</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hours -->
                            <div class="bg-white rounded-2xl p-4 lg:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="600">
                                <div class="flex items-start space-x-3 lg:space-x-4">
                                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-base lg:text-lg font-bold text-gray-900 mb-2">Jam Operasional</h4>
                                        <div class="space-y-1">
                                            <p class="text-gray-600 text-sm lg:text-base" v-if="props.museumSettings?.opening_hours">
                                                <span class="block">{{ props.museumSettings.opening_hours }}</span>
                                            </p>
                                            <p v-else class="text-gray-600 text-sm lg:text-base">
                                                <span class="block">Senin - Jumat: <span class="font-semibold text-blue-600">08:00 - 17:00</span></span>
                                                <span class="block">Sabtu: <span class="font-semibold text-blue-600">09:00 - 15:00</span></span>
                                                <span class="block">Minggu: <span class="font-semibold text-red-500">Tutup</span></span>
                                            </p>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-sm text-gray-500">*Dukungan online tersedia 24/7</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="space-y-6 lg:space-y-8">
                        <div>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 lg:mb-6" data-aos="fade-up">Hubungi Kami</h3>
                            <p class="text-gray-600 mb-6 lg:mb-8 text-sm lg:text-base" data-aos="fade-up" data-aos-delay="200">
                                Hubungi kami melalui berbagai saluran komunikasi yang tersedia. Tim kami siap membantu Anda.
                            </p>
                        </div>

                        <!-- Contact Information Cards -->
                        <div class="space-y-6">
                            <!-- Phone Contact -->
                            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h4>
                                        <p class="text-gray-600 mb-3">0823-7355-5447</p>
                                        <p class="text-gray-600 text-sm">0823-7355-5447</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Email Contact -->
                            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Email</h4>
                                        <p class="text-gray-600 mb-3">balaiadatrajopenghulu@gmail.com</p>
                                        <p class="text-gray-600 text-sm">balaiadatrajopenghulu@gmail.com</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Address Contact -->
                            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="500">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Alamat</h4>
                                        <p class="text-gray-600 mb-3">Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia</p>
                                        <p class="text-gray-600 text-sm">{{ props.museumSettings?.city || 'Belum tersedia' }}, Indonesia</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial Link -->
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-200 hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="600">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Berikan Testimoni</h4>
                                    <p class="text-gray-600 mb-4">Bagikan pengalaman Anda mengunjungi museum kami</p>
                                    <Link
                                        href="/testimonials"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105"
                                    >
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Lihat Testimoni
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Lokasi Kami</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Museum Digital Balai Adat Rajo Penghulu BDARU berlokasi strategis di pusat Jakarta, mudah dijangkau dari berbagai arah.
                    </p>
                </div>
                            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="h-96 relative">
                        <!-- Interactive Leaflet Map -->
                        <div id="museumMap" class="w-full h-full rounded-3xl"></div>

                        <!-- Map Overlay Info -->
                        <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm rounded-xl p-4 shadow-lg max-w-xs">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">{{ props.museumSettings?.museum_name || 'Museum Digital Balai Adat Rajo Penghulu BDARU' }}</h4>
                                    <p class="text-xs text-gray-600">Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia</p>
                                </div>
                            </div>

                            <!-- Coordinates -->
                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <div class="text-center">
                                    <p class="text-gray-500 font-medium">Latitude</p>
                                    <p class="text-emerald-600 font-bold">-3.7956°</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-500 font-medium">Longitude</p>
                                    <p class="text-emerald-600 font-bold">102.2592°</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-3 space-y-2">
                                <a href="https://maps.google.com/?q=-3.7956,102.2592"
                                   target="_blank"
                                   class="w-full inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-semibold rounded-lg hover:from-emerald-700 hover:to-teal-700 transition-all duration-300">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Google Maps
                                </a>
                                <button @click="getDirections"
                                        class="w-full inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-xs font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"></path>
                                    </svg>
                                    Petunjuk Arah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modern Footer -->
        <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                    <!-- Enhanced Logo & Description -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center group mb-6">
                            <div class="flex-shrink-0 relative">
                                <div class="flex items-center space-x-3">
                                    <!-- Static BDARU Logo -->
                                    <div class="relative">
                                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden">
                                            <img
                                                src="/assets/src/images/bdaru.jpeg"
                                                alt="BDARU Museum"
                                                class="w-full h-full object-cover rounded-2xl"
                                                @error="$event.target.style.display='none'; $event.target.nextElementSibling.style.display='flex'"
                                            />
                                            <!-- Fallback Icon if image fails to load -->
                                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden" style="display: none;">
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
                                                        <p class="text-gray-300 text-sm">Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia</p>
                        <p class="text-gray-300 text-sm">Kota Bengkulu, Bengkulu</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                                                            <div>
                                    <p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com</p>
                                </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-300 text-sm">0823-7355-5447</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <div>
                                <p class="text-gray-300 text-sm">@bdaru.official</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Bottom Bar -->
                <div class="border-t border-gray-800 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-400 text-sm text-center md:text-left">
                            © 2024 BDARU {{ props.museumSettings?.museum_name || 'Museum Digital Balai Adat Rajo Penghulu BDARU' }}. All rights reserved.
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
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, onMounted, watch, onUnmounted, nextTick } from 'vue';

// Props for live data from database
const props = defineProps({
    collections: Object,
    news: Object,
    events: Object,
    testimonials: Object,
    museumSettings: Object,
    canLogin: Boolean,
    canRegister: Boolean
});

const showBackToTop = ref(false);
const mobileMenuOpen = ref(false);
let map = null;
let marker = null;

// Scroll to top function
const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

// Handle scroll for back to top button
const handleScroll = () => {
    showBackToTop.value = window.scrollY > 300;
};

// Initialize Leaflet Map
const initMap = () => {
    // Wait for DOM to be ready
    nextTick(() => {
        const mapElement = document.getElementById('museumMap');
        if (!mapElement) return;

        // Get coordinates from props
        const lat = -3.7956;
        const lng = 102.2592;

        // Initialize map
        map = L.map('museumMap').setView([lat, lng], 15);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Clean and elegant museum icon
        const museumIcon = L.divIcon({
            className: 'custom-museum-marker',
            html: `
                <div class="museum-marker-simple">
                    <svg class="w-8 h-8" fill="#ff0000" viewBox="0 0 24 24" style="filter: drop-shadow(0 4px 8px rgba(255, 0, 0, 0.3));">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
            `,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        // Add marker
        marker = L.marker([lat, lng], { icon: museumIcon }).addTo(map);

        // Debug: Log museum settings
        console.log('Museum Settings:', props.museumSettings);
        console.log('Phone:', props.museumSettings?.phone_1);
        console.log('Email:', props.museumSettings?.email_info);

        // Enhanced popup with more information
        const popupContent = `
            <div class="museum-popup">
                <div class="popup-header">
                    <div class="popup-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="popup-title">
                        <h3 class="font-bold text-gray-900">${props.museumSettings?.museum_name || 'Museum Digital Balai Adat Rajo Penghulu BDARU'}</h3>
                        <p class="text-sm text-emerald-600 font-semibold">🏛️ Museum Digital</p>
                    </div>
                </div>

                <div class="popup-content">
                    <div class="popup-info">
                        <div class="info-item">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia</span>
                        </div>
                        <div class="info-item">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">${props.museumSettings?.city || 'Jakarta Pusat'}, ${props.museumSettings?.country || 'Indonesia'}</span>
                        </div>
                        <div class="info-item">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">${props.museumSettings?.opening_hours || 'Senin - Jumat: 08:00 - 17:00'}</span>
                        </div>
                    </div>



                    <div class="popup-contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div class="contact-details">
                                <div class="contact-label">Telepon</div>
                                <div class="contact-value">${props.museumSettings?.phone_1 || '+62-21-3868172'}</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">📧</div>
                            <div class="contact-details">
                                <div class="contact-label">Email</div>
                                <div class="contact-value">${props.museumSettings?.email_info || 'balaiadatrajopenghulu@gmail.com'}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        marker.bindPopup(popupContent, {
            maxWidth: 320,
            className: 'museum-popup-container'
        });

        // Fit map to marker
        map.fitBounds(marker.getLatLng().toBounds(100));

        // Open popup automatically when map loads
        setTimeout(() => {
            marker.openPopup();
        }, 1000);

        // Add click event to marker for enhanced interaction (no movement)
        marker.on('click', function() {
            // Just open popup, no movement or scaling
            this.openPopup();
        });

        // Add hover effects
        marker.on('mouseover', function() {
            map.getContainer().style.cursor = 'pointer';
        });

        marker.on('mouseout', function() {
            map.getContainer().style.cursor = 'grab';
        });

        // Add custom controls
        const customControl = L.Control.extend({
            options: {
                position: 'topright'
            },
            onAdd: function() {
                const container = L.DomUtil.create('div', 'custom-map-control');
                container.innerHTML = `
                    <button class="custom-control-btn" onclick="window.open('https://maps.google.com/?q=${lat},${lng}', '_blank')" title="Buka di Google Maps">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </button>
                `;
                return container;
            }
        });

        map.addControl(new customControl());
    });
};

// Get directions function
const getDirections = () => {
    const lat = -3.7956;
    const lng = 102.2592;
                const address = `Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia`;

    // Try to get user's location first
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;
            const directionsUrl = `https://www.google.com/maps/dir/${userLat},${userLng}/${lat},${lng}`;
            window.open(directionsUrl, '_blank');
        }, () => {
            // Fallback to just the destination
            const directionsUrl = `https://www.google.com/maps/dir//${lat},${lng}`;
            window.open(directionsUrl, '_blank');
        });
    } else {
        // Fallback to just the destination
        const directionsUrl = `https://www.google.com/maps/dir//${lat},${lng}`;
        window.open(directionsUrl, '_blank');
    }
};

onMounted(() => {
    // Add scroll event listener
    window.addEventListener('scroll', handleScroll);

    // Initialize particle system
    const cleanup = initParticleSystem();

    // Store cleanup function for later use
    window.particleCleanup = cleanup;

    // Initialize map after a short delay to ensure DOM is ready
    setTimeout(() => {
        initMap();
    }, 500);

    // Add scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);

    // Observe all cards for animation
    document.querySelectorAll('.bg-white').forEach(card => {
        observer.observe(card);
    });
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    if (window.particleCleanup) {
        window.particleCleanup();
    }
    // Clean up map
    if (map) {
        map.remove();
        map = null;
        marker = null;
    }
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
        window.removeEventListener('resize', resizeCanvas);
    };
}
</script>

<style scoped>
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

.animate-slide-in {
    animation: slideIn 1s ease-out;
}

.animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.3s both;
}

.animate-fade-in-delay-2 {
    animation: fadeIn 1s ease-out 0.6s both;
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
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

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Custom scrollbar */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* Floating animations */
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .animate-float-slow,
    .animate-float-medium,
    .animate-float-fast {
        animation-duration: 1.5s;
    }
}

/* Custom Leaflet Map Styles */
.custom-museum-marker {
    background: transparent !important;
    border: none !important;
}

/* Simple and Elegant Museum Marker */
.museum-marker-simple {
    position: relative;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Museum Marker Simple */
.museum-marker-simple {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.museum-marker-simple:hover {
    transform: scale(1.1);
}

.museum-marker-simple svg {
    filter: drop-shadow(0 4px 8px rgba(255, 0, 0, 0.3));
}

@keyframes pulse-gentle {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.7;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Enhanced Popup Styles */
.museum-popup-container .leaflet-popup-content-wrapper {
    background: white !important;
    border-radius: 16px !important;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
    border: 1px solid rgba(16, 185, 129, 0.1) !important;
    overflow: hidden;
}

.museum-popup-container .leaflet-popup-content {
    margin: 0 !important;
    padding: 0 !important;
    font-family: inherit !important;
    min-width: 280px;
}

.museum-popup-container .leaflet-popup-tip {
    background: white !important;
    border: 1px solid rgba(16, 185, 129, 0.1) !important;
}

/* Popup Header */
.popup-header {
    background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
    color: white;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
}

/* Popup Contact Info */
.popup-contact-info {
    padding: 16px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 0;
}

.contact-icon {
    font-size: 20px;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #10b981;
    color: white;
    border-radius: 8px;
}

.contact-details {
    flex: 1;
}

.contact-label {
    font-size: 12px;
    color: #64748b;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.contact-value {
    font-size: 14px;
    color: #1e293b;
    font-weight: 600;
    margin-top: 2px;
}



.popup-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.popup-title h3 {
    color: white !important;
    margin: 0 !important;
    font-size: 14px !important;
    line-height: 1.3;
}

.popup-title p {
    color: rgba(255, 255, 255, 0.9) !important;
    margin: 4px 0 0 0 !important;
    font-size: 12px !important;
}

/* Popup Content */
.popup-content {
    padding: 16px;
}

.popup-info {
    margin-bottom: 16px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
    padding: 8px;
    background: rgba(16, 185, 129, 0.05);
    border-radius: 8px;
    transition: all 0.2s ease;
}

.info-item:hover {
    background: rgba(16, 185, 129, 0.1);
    transform: translateX(4px);
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-item svg {
    flex-shrink: 0;
}

.info-item span {
    font-size: 12px;
    line-height: 1.4;
}

/* Popup Actions */
.popup-actions {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 8px;
}

.popup-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    padding: 10px 8px;
    border: none;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    color: white;
}

.popup-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.phone-btn {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
}

.phone-btn:hover {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}

.email-btn {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.email-btn:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
}

.directions-btn {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

.directions-btn:hover {
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
}

/* Map Container */
#museumMap {
    border-radius: 24px;
    overflow: hidden;
}

/* Leaflet Attribution */
.leaflet-control-attribution {
    background: rgba(255, 255, 255, 0.95) !important;
    border-radius: 8px !important;
    font-size: 10px !important;
    padding: 6px 10px !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
}

/* Zoom Controls */
.leaflet-control-zoom {
    border-radius: 12px !important;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
}

.leaflet-control-zoom a {
    background: white !important;
    color: #374151 !important;
    border: none !important;
    transition: all 0.2s ease !important;
}

.leaflet-control-zoom a:hover {
    background: #f3f4f6 !important;
    color: #10b981 !important;
}

/* Custom Map Control */
.custom-map-control {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin: 10px;
}

.custom-control-btn {
    width: 40px;
    height: 40px;
    background: white;
    border: none;
    color: #374151;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.custom-control-btn:hover {
    background: #f3f4f6;
    color: #10b981;
    transform: scale(1.05);
}

/* Enhanced Map Interactions */
#museumMap {
    cursor: grab;
}

#museumMap:active {
    cursor: grabbing;
}

/* Marker Animation Enhancement */
.museum-marker-simple {
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.15));
}

.marker-pin:active {
    transform: rotate(-45deg) scale(0.95);
}

/* Loading State */
.map-loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.9);
    padding: 16px 24px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.map-loading-spinner {
    width: 24px;
    height: 24px;
    border: 3px solid #e5e7eb;
    border-top: 3px solid #10b981;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
