<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

// Animation states
const isLoaded = ref(false);

onMounted(() => {
    setTimeout(() => {
        isLoaded.value = true;
    }, 100);
});
</script>

<template>
    <Head title="Login - BDARU Museum Digital" />

    <div class="min-h-screen bg-gradient-to-br from-emerald-900 via-teal-800 to-cyan-900 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <!-- Floating Particles -->
            <div class="absolute top-20 left-20 w-2 h-2 bg-emerald-400 rounded-full animate-ping"></div>
            <div class="absolute top-40 right-32 w-1 h-1 bg-teal-300 rounded-full animate-ping delay-1000"></div>
            <div class="absolute bottom-32 left-1/4 w-1.5 h-1.5 bg-cyan-400 rounded-full animate-ping delay-500"></div>
            <div class="absolute top-1/2 right-20 w-1 h-1 bg-emerald-300 rounded-full animate-ping delay-1500"></div>
            <div class="absolute bottom-20 right-1/3 w-2 h-2 bg-teal-400 rounded-full animate-ping delay-2000"></div>

            <!-- Gradient Orbs -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-teal-500/10 rounded-full blur-3xl animate-float-medium"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-cyan-500/5 rounded-full blur-2xl animate-float-fast"></div>

            <!-- Geometric Shapes -->
            <div class="absolute top-10 right-10 w-32 h-32 border border-emerald-400/20 rounded-full animate-spin-slow"></div>
            <div class="absolute bottom-10 left-10 w-24 h-24 border border-teal-400/20 rotate-45 animate-pulse"></div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <!-- Header Section -->
                <div class="text-center mb-12" :class="{ 'animate-fade-in-up': isLoaded }">
                    <!-- Premium Logo -->
                    <div class="flex items-center justify-center mb-8">
                        <div class="relative group">
                            <div class="w-24 h-24 bg-gradient-to-br from-emerald-400 via-teal-400 to-cyan-400 rounded-3xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-700 relative overflow-hidden">
                                <!-- Museum Building Icon -->
                                <div class="w-16 h-12 bg-white/95 rounded-xl relative">
                                    <!-- Building Structure -->
                                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-600 to-teal-600"></div>
                                    <div class="absolute top-3 left-1 right-1 h-0.5 bg-gray-800"></div>
                                    <div class="absolute top-6 left-1 right-1 h-0.5 bg-gray-800"></div>
                                    <div class="absolute top-9 left-1 right-1 h-0.5 bg-gray-800"></div>
                                    <!-- Windows -->
                                    <div class="absolute top-1.5 left-1.5 w-1.5 h-1.5 bg-emerald-500 rounded-sm"></div>
                                    <div class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-emerald-500 rounded-sm"></div>
                                    <div class="absolute top-4.5 left-1.5 w-1.5 h-1.5 bg-teal-500 rounded-sm"></div>
                                    <div class="absolute top-4.5 right-1.5 w-1.5 h-1.5 bg-teal-500 rounded-sm"></div>
                                    <div class="absolute top-7.5 left-1.5 w-1.5 h-1.5 bg-cyan-500 rounded-sm"></div>
                                    <div class="absolute top-7.5 right-1.5 w-1.5 h-1.5 bg-cyan-500 rounded-sm"></div>
                                    <!-- Door -->
                                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-gray-700 rounded-t-sm"></div>
                                </div>
                                <!-- Glow Effect -->
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/30 to-teal-500/30 rounded-3xl blur-sm group-hover:blur-md transition-all duration-500"></div>
                            </div>
                            <!-- Floating Elements -->
                            <div class="absolute -top-2 -right-2 w-3 h-3 bg-emerald-400 rounded-full animate-ping"></div>
                            <div class="absolute -bottom-2 -left-2 w-2 h-2 bg-teal-400 rounded-full animate-ping delay-1000"></div>
                            <div class="absolute top-1/2 -right-1 w-1.5 h-1.5 bg-cyan-400 rounded-full animate-ping delay-500"></div>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-black text-white mb-3">
                        Selamat Datang di
                        <span class="bg-gradient-to-r from-emerald-300 to-teal-300 bg-clip-text text-transparent">
                            BDARU
                        </span>
                    </h1>
                    <p class="text-emerald-100 text-lg font-medium">Museum Digital Balai Adat Rajo Penghulu</p>
                    <p class="text-emerald-200/80 text-sm mt-2">Jelajahi kekayaan budaya Indonesia</p>
                </div>

                <!-- Status Message -->
                <div v-if="status" class="mb-8 p-4 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 border border-emerald-400/30 rounded-2xl text-sm font-medium text-emerald-100 text-center backdrop-blur-sm">
                    {{ status }}
                </div>

                <!-- Login Form -->
                <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8" :class="{ 'animate-fade-in-up': isLoaded }">
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <InputLabel for="email" value="Email" class="text-emerald-100 font-semibold mb-3 block text-lg" />
                            <div class="relative group">
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="w-full px-5 py-4 bg-white/10 border-2 border-emerald-400/30 rounded-2xl focus:border-emerald-300 focus:bg-white/20 focus:outline-none transition-all duration-300 text-white placeholder-emerald-200/60 text-lg"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Masukkan email Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-emerald-300 group-focus-within:text-emerald-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-2 text-red-300" :message="form.errors.email" />
                        </div>

                        <!-- Password Field -->
                        <div>
                            <InputLabel for="password" value="Password" class="text-emerald-100 font-semibold mb-3 block text-lg" />
                            <div class="relative group">
                                <TextInput
                                    id="password"
                                    type="password"
                                    class="w-full px-5 py-4 bg-white/10 border-2 border-emerald-400/30 rounded-2xl focus:border-emerald-300 focus:bg-white/20 focus:outline-none transition-all duration-300 text-white placeholder-emerald-200/60 text-lg"
                                    v-model="form.password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-emerald-300 group-focus-within:text-emerald-200 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-2 text-red-300" :message="form.errors.password" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center group cursor-pointer">
                                <Checkbox name="remember" v-model:checked="form.remember" class="rounded-lg border-2 border-emerald-400/50 text-emerald-300 focus:ring-emerald-300 focus:ring-2 bg-white/10" />
                                <span class="ms-3 text-emerald-100 group-hover:text-white transition-colors duration-200 font-medium">
                                    Ingat saya
                                </span>
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-emerald-300 hover:text-emerald-200 font-semibold transition-colors duration-200 hover:underline text-sm"
                            >
                                Lupa password?
                            </Link>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <PrimaryButton
                                class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-white font-bold rounded-2xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 text-lg"
                                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </span>
                                <span v-else class="flex items-center justify-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Masuk ke BDARU
                                </span>
                            </PrimaryButton>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center pt-6">
                            <p class="text-emerald-200 text-base">
                                Belum punya akun?
                                <Link
                                    :href="route('register')"
                                    class="text-emerald-300 hover:text-emerald-200 font-bold transition-colors duration-200 hover:underline ml-1"
                                >
                                    Daftar sekarang
                                </Link>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="text-center mt-12 text-emerald-200/60 text-sm">
                    <p>&copy; 2024 BDARU Museum Digital. Semua hak dilindungi.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

@keyframes float-medium {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(-180deg); }
}

@keyframes float-fast {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(90deg); }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-float-slow {
    animation: float-slow 8s ease-in-out infinite;
}

.animate-float-medium {
    animation: float-medium 6s ease-in-out infinite;
}

.animate-float-fast {
    animation: float-fast 4s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fade-in-up 1s ease-out;
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}
</style>
