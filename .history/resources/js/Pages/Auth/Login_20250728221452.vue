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
        onSuccess: () => {
            // Force a full page reload to ensure proper redirect
            setTimeout(() => {
                window.location.reload();
            }, 100);
        },
    });
};

// Simple animation state
const isLoaded = ref(false);

onMounted(() => {
    setTimeout(() => {
        isLoaded.value = true;
    }, 100);
});
</script>

<template>
    <Head title="Login - BDARU Museum Digital" />

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
                <div class="absolute top-0 left-0 w-full h-full bg-[linear-gradient(rgba(16,185,129,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(16,185,129,0.1)_1px,transparent_1px)] bg-[length:60px_60px]"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <!-- Header Section -->
                <div class="text-center mb-12" :class="{ 'animate-fade-in-up': isLoaded }">
                    <!-- Clean Logo -->
                    <div class="flex items-center justify-center mb-8">
                        <div class="relative group">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-105 transition-all duration-300">
                                <!-- Museum Icon -->
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Clean Typography -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-3">
                        Selamat Datang di
                        <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                            BDARU
                        </span>
                    </h1>
                    <p class="text-gray-600 text-base">Museum Digital Balai Adat Rajo Penghulu</p>
                    <p class="text-gray-500 text-sm mt-1">Jelajahi kekayaan budaya digital</p>
                </div>

                <!-- Status Message -->
                <div v-if="status" class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-800 text-center shadow-sm">
                    {{ status }}
                </div>

                <!-- Clean Login Form -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8" :class="{ 'animate-fade-in-up': isLoaded }">
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <InputLabel for="email" value="Email" class="text-gray-700 font-medium mb-2 block" />
                            <div class="relative">
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Masukkan email Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-2 text-red-500 text-sm" :message="form.errors.email" />
                        </div>

                        <!-- Password Field -->
                        <div>
                            <InputLabel for="password" value="Password" class="text-gray-700 font-medium mb-2 block" />
                            <div class="relative">
                                <TextInput
                                    id="password"
                                    type="password"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-200 text-gray-900 placeholder-gray-400"
                                    v-model="form.password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-2 text-red-500 text-sm" :message="form.errors.password" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center cursor-pointer">
                                <Checkbox name="remember" v-model:checked="form.remember" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                                <span class="ms-2 text-sm text-gray-600">
                                    Ingat saya
                                </span>
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-emerald-600 hover:text-emerald-700 font-medium transition-colors duration-200"
                            >
                                Lupa password?
                            </Link>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <PrimaryButton
                                class="w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 text-lg relative overflow-hidden group"
                                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                :disabled="form.processing"
                            >
                                <!-- Button Background Animation -->
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <span v-if="form.processing" class="flex items-center justify-center relative z-10">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </span>
                                <span v-else class="flex items-center justify-center relative z-10">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Masuk ke BDARU
                                </span>
                            </PrimaryButton>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center pt-4">
                            <p class="text-gray-600 text-sm">
                                Belum punya akun?
                                <Link
                                    :href="route('register')"
                                    class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors duration-200"
                                >
                                    Daftar sekarang
                                </Link>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="text-center mt-8 text-gray-500 text-xs">
                    <p>&copy; 2024 BDARU Museum Digital. Semua hak dilindungi.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
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
</style>
