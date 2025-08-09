<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - BDARU Museum Digital</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/src/images/bdaru.jpeg') }}" />
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/src/images/bdaru.jpeg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out;
        }

        .bg-gradient-pattern {
            background: linear-gradient(rgba(16,185,129,0.1) 1px,transparent 1px),linear-gradient(90deg,rgba(16,185,129,0.1) 1px,transparent 1px);
            background-size: 60px 60px;
        }

        .btn-gradient {
            background: linear-gradient(to right, #059669, #0d9488);
        }

        .btn-gradient:hover {
            background: linear-gradient(to right, #047857, #0f766e);
        }

        .text-gradient {
            background: linear-gradient(to right, #059669, #0d9488);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50 relative overflow-hidden">
        <!-- Subtle Background Elements -->
        <div class="absolute inset-0">
            <!-- Gentle Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-100/20 via-transparent to-teal-100/20"></div>

            <!-- Minimal Floating Elements -->
            <div class="absolute top-20 left-20 w-32 h-32 bg-emerald-200/30 rounded-full blur-2xl"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-teal-200/20 rounded-full blur-3xl"></div>

            <!-- Subtle Grid Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-pattern"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <!-- Header Section -->
                <div class="text-center mb-12 animate-fade-in-up">
                    <!-- BDARU Logo -->
                    <div class="flex items-center justify-center mb-8">
                        <div class="relative group">
                            <div class="w-24 h-24 bg-white rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-105 transition-all duration-300 p-1">
                                <!-- BDARU Logo -->
                                <img
                                    src="/assets/src/images/bdaru.jpeg"
                                    alt="BDARU Museum"
                                    class="w-full h-full object-cover rounded-xl"
                                    style="max-width: 100%; height: auto;"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Clean Typography -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-3">
                        Daftar di
                        <span class="text-gradient">
                            BDARU
                        </span>
                    </h1>
                    <p class="text-gray-600 text-base">Museum Digital Balai Adat Rajo Penghulu</p>
                    <p class="text-gray-500 text-sm mt-1">Bergabunglah dengan komunitas budaya digital</p>
                </div>

                <!-- Clean Register Form -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 animate-fade-in-up">
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name Field -->
                        <div>
                            <label for="name" class="text-gray-700 font-medium mb-2 block">Nama Lengkap</label>
                            <div class="relative">
                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Masukkan nama lengkap Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('name')
                                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="text-gray-700 font-medium mb-2 block">Email</label>
                            <div class="relative">
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400"
                                    required
                                    autocomplete="username"
                                    placeholder="Masukkan email Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('email')
                                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="text-gray-700 font-medium mb-2 block">Password</label>
                            <div class="relative">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Masukkan password Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div>
                            <label for="password_confirmation" class="text-gray-700 font-medium mb-2 block">Konfirmasi Password</label>
                            <div class="relative">
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Konfirmasi password Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full btn-gradient text-white font-semibold py-3 px-6 rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                            Daftar Sekarang
                        </button>

                        <!-- Login Link -->
                        <div class="text-center mt-6">
                            <p class="text-gray-600 text-sm">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold transition-colors">
                                    Masuk di sini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-8">
                    <a href="/" class="inline-flex items-center text-gray-500 hover:text-emerald-600 transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
