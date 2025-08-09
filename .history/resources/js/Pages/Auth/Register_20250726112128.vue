<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted, nextTick } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

// Animation states
const isLoaded = ref(false);
const isFormVisible = ref(false);
const isLogoAnimated = ref(false);

onMounted(async () => {
    // Staggered animations for professional feel
    await nextTick();
    setTimeout(() => {
        isLoaded.value = true;
    }, 100);

    setTimeout(() => {
        isLogoAnimated.value = true;
    }, 300);

    setTimeout(() => {
        isFormVisible.value = true;
    }, 600);
});
</script>

<template>
    <Head title="Register - BDARU Museum Digital" />

    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-emerald-900 to-teal-900 relative overflow-hidden">
        <!-- Sophisticated Background Elements -->
        <div class="absolute inset-0">
            <!-- Animated Gradient Mesh -->
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 via-transparent to-teal-500/10 animate-gradient-shift"></div>

            <!-- Floating Geometric Shapes with Depth -->
            <div class="absolute top-20 left-20 w-40 h-40 bg-gradient-to-br from-emerald-400/20 to-teal-400/20 rounded-full blur-2xl animate-float-slow"></div>
            <div class="absolute bottom-20 right-20 w-60 h-60 bg-gradient-to-br from-teal-400/15 to-cyan-400/15 rounded-full blur-3xl animate-float-medium"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-gradient-to-br from-emerald-300/25 to-teal-300/25 rounded-full blur-xl animate-float-fast"></div>

            <!-- Subtle Grid Pattern with Animation -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-full h-full bg-[linear-gradient(rgba(16,185,129,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(16,185,129,0.1)_1px,transparent_1px)] bg-[length:50px_50px] animate-grid-move"></div>
            </div>

            <!-- Floating Particles with Staggered Animation -->
            <div class="absolute top-32 right-32 w-2 h-2 bg-emerald-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-32 left-32 w-1.5 h-1.5 bg-teal-400 rounded-full animate-ping delay-1000"></div>
            <div class="absolute top-1/3 left-1/4 w-1 h-1 bg-cyan-400 rounded-full animate-ping delay-500"></div>
            <div class="absolute top-2/3 right-1/3 w-1.5 h-1.5 bg-emerald-300 rounded-full animate-ping delay-1500"></div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
            <div class="w-full max-w-lg">
                <!-- Header Section with Enhanced Typography -->
                <div class="text-center mb-12" :class="{ 'animate-fade-in-up': isLoaded }">
                    <!-- Premium Logo with Advanced Animation -->
                    <div class="flex items-center justify-center mb-10">
                        <div class="relative group">
                            <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-3xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-700 relative overflow-hidden" :class="{ 'animate-logo-enter': isLogoAnimated }">
                                <!-- User Plus Icon with Enhanced Detail -->
                                <svg class="w-12 h-12 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                <!-- Animated Background with Glow -->
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/30 to-teal-500/30 rounded-3xl blur-sm group-hover:blur-md transition-all duration-500"></div>
                                <!-- Glow Effect -->
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/20 to-teal-500/20 rounded-3xl blur-xl group-hover:blur-2xl transition-all duration-700"></div>
                            </div>
                            <!-- Floating Elements with Enhanced Animation -->
                            <div class="absolute -top-2 -right-2 w-4 h-4 bg-emerald-400 rounded-full animate-ping"></div>
                            <div class="absolute -bottom-2 -left-2 w-3 h-3 bg-teal-400 rounded-full animate-ping delay-1000"></div>
                            <div class="absolute top-1/2 -right-1 w-2 h-2 bg-cyan-400 rounded-full animate-ping delay-500"></div>
                        </div>
                    </div>

                    <!-- Enhanced Typography with Professional Hierarchy -->
                    <h1 class="text-4xl font-black text-white mb-4 leading-tight">
                        Bergabung dengan
                        <span class="bg-gradient-to-r from-emerald-300 via-teal-300 to-cyan-300 bg-clip-text text-transparent animate-gradient-text">
                            BDARU
                        </span>
                    </h1>
                    <p class="text-emerald-100 text-xl font-medium mb-2">Museum Digital Balai Adat Rajo Penghulu</p>
                    <p class="text-emerald-200/80 text-base">Mulai perjalanan budaya digital Anda dan akses koleksi eksklusif</p>
                </div>

                <!-- Enhanced Register Form with Professional Styling -->
                <div class="bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/20 p-10" :class="{ 'animate-form-enter': isFormVisible }">
                    <form @submit.prevent="submit" class="space-y-8">
                        <!-- Enhanced Name Field -->
                        <div>
                            <InputLabel for="name" value="Nama Lengkap" class="text-emerald-100 font-semibold mb-4 block text-lg" />
                            <div class="relative group">
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="w-full px-6 py-5 bg-white/10 border-2 border-emerald-400/30 rounded-2xl focus:border-emerald-300 focus:bg-white/20 focus:outline-none transition-all duration-300 text-white placeholder-emerald-200/60 text-lg group-hover:border-emerald-300/50"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Masukkan nama lengkap Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-emerald-300 group-focus-within:text-emerald-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-3 text-red-300 text-sm" :message="form.errors.name" />
                        </div>

                        <!-- Enhanced Email Field -->
                        <div>
                            <InputLabel for="email" value="Email Address" class="text-emerald-100 font-semibold mb-4 block text-lg" />
                            <div class="relative group">
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="w-full px-6 py-5 bg-white/10 border-2 border-emerald-400/30 rounded-2xl focus:border-emerald-300 focus:bg-white/20 focus:outline-none transition-all duration-300 text-white placeholder-emerald-200/60 text-lg group-hover:border-emerald-300/50"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
                                    placeholder="Masukkan alamat email Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-emerald-300 group-focus-within:text-emerald-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-3 text-red-300 text-sm" :message="form.errors.email" />
                        </div>

                        <!-- Enhanced Password Field -->
                        <div>
                            <InputLabel for="password" value="Password" class="text-emerald-100 font-semibold mb-4 block text-lg" />
                            <div class="relative group">
                                <TextInput
                                    id="password"
                                    type="password"
                                    class="w-full px-6 py-5 bg-white/10 border-2 border-emerald-400/30 rounded-2xl focus:border-emerald-300 focus:bg-white/20 focus:outline-none transition-all duration-300 text-white placeholder-emerald-200/60 text-lg group-hover:border-emerald-300/50"
                                    v-model="form.password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Buat password yang kuat dan aman"
                                />
                                <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-emerald-300 group-focus-within:text-emerald-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-3 text-red-300 text-sm" :message="form.errors.password" />
                        </div>

                        <!-- Enhanced Confirm Password Field -->
                        <div>
                            <InputLabel for="password_confirmation" value="Konfirmasi Password" class="text-emerald-100 font-semibold mb-4 block text-lg" />
                            <div class="relative group">
                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    class="w-full px-6 py-5 bg-white/10 border-2 border-emerald-400/30 rounded-2xl focus:border-emerald-300 focus:bg-white/20 focus:outline-none transition-all duration-300 text-white placeholder-emerald-200/60 text-lg group-hover:border-emerald-300/50"
                                    v-model="form.password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Ulangi password untuk konfirmasi"
                                />
                                <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-emerald-300 group-focus-within:text-emerald-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-3 text-red-300 text-sm" :message="form.errors.password_confirmation" />
                        </div>

                        <!-- Enhanced Submit Button -->
                        <div class="pt-8">
                            <PrimaryButton
                                class="w-full py-5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold rounded-2xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 text-xl relative overflow-hidden group"
                                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                :disabled="form.processing"
                            >
                                <!-- Button Background Animation -->
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <span v-if="form.processing" class="flex items-center justify-center relative z-10">
                                    <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </span>
                                <span v-else class="flex items-center justify-center relative z-10">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Daftar Sekarang
                                </span>
                            </PrimaryButton>
                        </div>

                        <!-- Enhanced Login Link -->
                        <div class="text-center pt-8">
                            <p class="text-emerald-200 text-lg">
                                Sudah punya akun?
                                <Link
                                    :href="route('login')"
                                    class="text-emerald-300 hover:text-emerald-200 font-bold transition-colors duration-200 hover:underline ml-1"
                                >
                                    Masuk di sini
                                </Link>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Enhanced Footer -->
                <div class="text-center mt-12 text-emerald-200/60 text-sm">
                    <p>&copy; 2024 BDARU Museum Digital. Semua hak dilindungi.</p>
                    <p class="mt-1 text-emerald-200/40 text-xs">Bergabunglah dengan komunitas digital budaya Indonesia</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(180deg); }
}

@keyframes float-medium {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(-180deg); }
}

@keyframes float-fast {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(90deg); }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes logo-enter {
    from {
        opacity: 0;
        transform: scale(0.5) rotate(-180deg);
    }
    to {
        opacity: 1;
        transform: scale(1) rotate(0deg);
    }
}

@keyframes form-enter {
    from {
        opacity: 0;
        transform: translateY(60px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes gradient-shift {
    0%, 100% { opacity: 0.1; }
    50% { opacity: 0.2; }
}

@keyframes gradient-text {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes grid-move {
    0% { transform: translate(0, 0); }
    100% { transform: translate(50px, 50px); }
}

.animate-float-slow {
    animation: float-slow 10s ease-in-out infinite;
}

.animate-float-medium {
    animation: float-medium 8s ease-in-out infinite;
}

.animate-float-fast {
    animation: float-fast 6s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fade-in-up 1s ease-out;
}

.animate-logo-enter {
    animation: logo-enter 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.animate-form-enter {
    animation: form-enter 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.animate-gradient-shift {
    animation: gradient-shift 8s ease-in-out infinite;
}

.animate-gradient-text {
    background-size: 200% 200%;
    animation: gradient-text 3s ease-in-out infinite;
}

.animate-grid-move {
    animation: grid-move 20s linear infinite;
}
</style>
