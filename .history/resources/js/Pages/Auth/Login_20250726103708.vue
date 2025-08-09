<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
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
    <GuestLayout>
        <Head title="Login - BDARU Museum Digital" />

        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-50 via-white to-teal-50 relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0">
                <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-200/20 rounded-full blur-3xl animate-float-slow"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 bg-teal-200/20 rounded-full blur-3xl animate-float-medium"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-cyan-200/10 rounded-full blur-2xl animate-float-fast"></div>
            </div>

            <!-- Main Content -->
            <div class="relative z-10 w-full max-w-md mx-auto px-6">
                <!-- Logo & Header -->
                <div class="text-center mb-8" :class="{ 'animate-fade-in-up': isLoaded }">
                    <div class="flex items-center justify-center mb-6">
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-2xl transform hover:scale-110 transition-all duration-500 relative overflow-hidden">
                                <div class="w-12 h-10 bg-white/95 rounded-lg relative">
                                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-600 to-teal-600"></div>
                                    <div class="absolute top-2 left-1 right-1 h-0.5 bg-gray-800"></div>
                                    <div class="absolute top-4 left-1 right-1 h-0.5 bg-gray-800"></div>
                                    <div class="absolute top-6 left-1 right-1 h-0.5 bg-gray-800"></div>
                                    <div class="absolute top-1 left-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                                    <div class="absolute top-1 right-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                                    <div class="absolute top-3 left-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                                    <div class="absolute top-3 right-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                                    <div class="absolute top-5 left-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
                                    <div class="absolute top-5 right-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
                                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-700 rounded-t-sm"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/30 to-teal-500/30 rounded-2xl blur-sm"></div>
                            </div>
                            <div class="absolute -top-1 -right-1 w-2 h-2 bg-emerald-400 rounded-full animate-ping"></div>
                            <div class="absolute -bottom-1 -left-1 w-1.5 h-1.5 bg-teal-400 rounded-full animate-ping delay-1000"></div>
                        </div>
                    </div>

                    <h1 class="text-3xl font-black text-gray-900 mb-2">
                        Selamat Datang di
                        <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                            BDARU
                        </span>
                    </h1>
                    <p class="text-gray-600 font-medium">Museum Digital Balai Adat Rajo Penghulu</p>
                </div>

                <!-- Status Message -->
                <div v-if="status" class="mb-6 p-4 bg-gradient-to-r from-emerald-100 to-teal-100 border border-emerald-200 rounded-2xl text-sm font-medium text-emerald-800 text-center shadow-lg">
                    {{ status }}
                </div>

                <!-- Login Form -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8" :class="{ 'animate-fade-in-up': isLoaded }">
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <InputLabel for="email" value="Email" class="text-gray-700 font-semibold mb-2 block" />
                            <div class="relative">
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="w-full px-4 py-3 bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-300 text-gray-900 placeholder-gray-500"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Masukkan email Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <!-- Password Field -->
                        <div>
                            <InputLabel for="password" value="Password" class="text-gray-700 font-semibold mb-2 block" />
                            <div class="relative">
                                <TextInput
                                    id="password"
                                    type="password"
                                    class="w-full px-4 py-3 bg-gray-50/50 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-300 text-gray-900 placeholder-gray-500"
                                    v-model="form.password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password Anda"
                                />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center group cursor-pointer">
                                <Checkbox name="remember" v-model:checked="form.remember" class="rounded-lg border-2 border-gray-300 text-emerald-600 focus:ring-emerald-500 focus:ring-2" />
                                <span class="ms-3 text-sm text-gray-600 group-hover:text-gray-800 transition-colors duration-200">
                                    Ingat saya
                                </span>
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-emerald-600 hover:text-emerald-700 font-medium transition-colors duration-200 hover:underline"
                            >
                                Lupa password?
                            </Link>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <PrimaryButton
                                class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-xl shadow-lg hover:shadow-emerald-500/25 transform hover:-translate-y-0.5 transition-all duration-300"
                                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </span>
                                <span v-else class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Masuk
                                </span>
                            </PrimaryButton>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center pt-4">
                            <p class="text-gray-600 text-sm">
                                Belum punya akun?
                                <Link
                                    :href="route('register')"
                                    class="text-emerald-600 hover:text-emerald-700 font-semibold transition-colors duration-200 hover:underline"
                                >
                                    Daftar sekarang
                                </Link>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="text-center mt-8 text-gray-500 text-sm">
                    <p>&copy; 2024 BDARU Museum Digital. Semua hak dilindungi.</p>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
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

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out;
}
</style>
