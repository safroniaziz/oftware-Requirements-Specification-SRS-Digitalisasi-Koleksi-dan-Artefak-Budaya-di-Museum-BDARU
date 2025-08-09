<script setup>
import { Head, Link, useForm, router, usePage } from '@inertiajs/vue3';
import { ref, onMounted, computed, onUnmounted, watch } from 'vue';
import Swal from 'sweetalert2';

// Get props
const props = defineProps({
    testimonials: {
        type: [Array, Object],
        default: () => []
    },
    canLogin: {
        type: Boolean,
        default: false
    },
    canRegister: {
        type: Boolean,
        default: false
    },
    museumSettings: {
        type: Object,
        default: () => ({})
    },
    auth: {
        type: Object,
        default: () => ({})
    }
});

// Reactive data
const showBackToTop = ref(false);
const testimonialFormRef = ref(null);
const mobileMenuOpen = ref(false);

// Get testimonials data (handle both array and pagination object)
const testimonialsData = computed(() => {
    if (Array.isArray(props.testimonials)) {
        return props.testimonials;
    }
    // If it's a pagination object, get the data property
    return props.testimonials?.data || [];
});

// Check if user is authenticated
const isAuthenticated = computed(() => {
    return props.auth && props.auth.user;
});

// Pagination functions
function goToPage(url) {
    if (url) {
        console.log('Navigating to:', url);
        try {
            router.get(url, {}, {
                preserveState: true,
                preserveScroll: true,
                replace: true,
            });
        } catch (error) {
            console.log('Router failed, using window.location');
            window.location.href = url;
        }
    }
}

// Form data
const form = useForm({
    name: '',
    profession: '',
    content: '',
    rating: 0,
    email: '',
    phone: ''
});

// Update form data when authentication state changes
const updateFormData = () => {
    if (isAuthenticated.value && props.auth.user) {
        form.name = props.auth.user.name || '';
        form.profession = props.auth.user.profession || '';
        form.email = props.auth.user.email || '';
        form.phone = props.auth.user.phone || '';
    }
};

// Computed property for button disabled state
const isButtonDisabled = computed(() => {
    return !form.content || form.content.length < 10 || form.rating === 0;
});

// Submit testimonial function
function submitTestimonial() {
    // Validasi client-side
    if (!isAuthenticated.value && !form.name) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Nama harus diisi',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        });
        return;
    }

    if (!form.content || form.content.length < 10) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Testimoni harus diisi minimal 10 karakter',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        });
        return;
    }

    if (form.rating === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Rating harus dipilih',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        });
        return;
    }

    form.post('/testimonials', {
        onSuccess: () => {
            form.reset();
            // Reset form data untuk user yang login
            if (isAuthenticated.value) {
                form.name = props.auth.user.name;
                form.profession = props.auth.user.profession;
                form.email = props.auth.user.email;
                form.phone = props.auth.user.phone;
            }
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Testimoni berhasil dikirim! Terima kasih atas ulasan Anda.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#28a745',
                timer: 3000,
                timerProgressBar: true
            });
        },
        onError: (errors) => {
            let errorMessage = 'Terjadi kesalahan saat mengirim testimoni.';
            if (errors.content) {
                errorMessage = errors.content[0];
            } else if (errors.rating) {
                errorMessage = errors.rating[0];
            } else if (errors.name) {
                errorMessage = errors.name[0];
            }
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: errorMessage,
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545'
            });
        }
    });
}

// Scroll to testimonial form
function scrollToTestimonialForm() {
    if (testimonialFormRef.value) {
        testimonialFormRef.value.scrollIntoView({ behavior: 'smooth' });
    }
}

function handleScroll() {
    showBackToTop.value = window.scrollY > 300;
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    const cleanup = initParticleSystem();

    // Store cleanup function for later use
    window.particleCleanup = cleanup;

    // Update form data on mount
    updateFormData();
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    if (window.particleCleanup) {
        window.particleCleanup();
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

// Get page props for CSRF token
const page = usePage();

// Watch for auth changes
watch(() => props.auth, () => {
    updateFormData();
}, { deep: true });
</script>

<template>
    <Head :title="`Testimoni Pengunjung - ${props.museumSettings?.museum_name || 'BDARU Museum Digital Balai Adat Rajo Penghulu'}`" />

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
                        <Link
                            v-if="props.canLogin"
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
                            v-if="props.canRegister"
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
    <div class="hidden md:block w-full mt-20 bg-white/95 backdrop-blur-lg border-b border-gray-200/50 shadow-sm">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center py-6">
                <!-- Desktop Menu -->
                <div class="flex items-center space-x-2 lg:space-x-4 overflow-x-auto scrollbar-hide">
                    <!-- Beranda -->
                    <Link
                        href="/"
                        class="group relative px-3 lg:px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300 whitespace-nowrap"
                    >
                        <span class="relative z-10 flex items-center space-x-2 lg:space-x-3">
                            <svg class="w-4 lg:w-5 h-4 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                            <span class="text-sm lg:text-base">Beranda</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Koleksi -->
                    <Link
                        href="/collections"
                        class="group relative px-3 lg:px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300 whitespace-nowrap"
                    >
                        <span class="relative z-10 flex items-center space-x-2 lg:space-x-3">
                            <svg class="w-4 lg:w-5 h-4 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span class="text-sm lg:text-base">Koleksi</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Berita -->
                    <Link
                        href="/news"
                        class="group relative px-3 lg:px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300 whitespace-nowrap"
                    >
                        <span class="relative z-10 flex items-center space-x-2 lg:space-x-3">
                            <svg class="w-4 lg:w-5 h-4 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <span class="text-sm lg:text-base">Berita</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Agenda -->
                    <Link
                        href="/events"
                        class="group relative px-3 lg:px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300 whitespace-nowrap"
                    >
                        <span class="relative z-10 flex items-center space-x-2 lg:space-x-3">
                            <svg class="w-4 lg:w-5 h-4 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm lg:text-base">Agenda</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Kontak -->
                    <Link
                        href="/contact"
                        class="group relative px-3 lg:px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300 whitespace-nowrap"
                    >
                        <span class="relative z-10 flex items-center space-x-2 lg:space-x-3">
                            <svg class="w-4 lg:w-5 h-4 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm lg:text-base">Kontak</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Profil -->
                    <Link
                        href="/about"
                        class="group relative px-3 lg:px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300 whitespace-nowrap"
                    >
                        <span class="relative z-10 flex items-center space-x-2 lg:space-x-3">
                            <svg class="w-4 lg:w-5 h-4 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm lg:text-base">Profil</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Testimoni -->
                    <Link
                        href="/testimonials"
                        class="group relative px-3 lg:px-4 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl whitespace-nowrap"
                    >
                        <span class="relative z-10 flex items-center space-x-2 lg:space-x-3">
                            <svg class="w-4 lg:w-5 h-4 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span class="text-sm lg:text-base">Testimoni</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full scale-x-100"></div>
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
                        class="group flex items-center px-4 py-3 text-gray-700 font-bold rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300"
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
                        class="group flex items-center px-4 py-3 text-emerald-600 font-bold rounded-lg hover:bg-emerald-50 transition-all duration-300"
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
                        <Link
                            v-if="props.canLogin"
                            :href="route('login')"
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
                        </Link>
                        <Link
                            v-if="props.canRegister"
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
    <section class="relative py-16 lg:py-24 bg-gradient-to-br from-emerald-900 via-teal-800 to-cyan-900 overflow-hidden min-h-[80vh]" :class="{ 'mt-16 lg:mt-0': !mobileMenuOpen, 'mt-0': mobileMenuOpen }">
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
                <div class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-md text-white rounded-full border border-white/20 mb-8 group hover:bg-white/20 transition-all duration-300" data-aos="fade-down" data-aos-delay="200">
                    <div class="w-2 h-2 bg-emerald-400 rounded-full mr-3 animate-pulse"></div>
                    <span class="text-sm font-bold">💬 Testimoni Pengunjung</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-8 leading-tight" data-aos="fade-up" data-aos-delay="400">
                    Testimoni <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Pengunjung</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-emerald-100 mb-12 max-w-4xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="600">
                    Dengarkan pengalaman langsung dari pengunjung yang telah menjelajahi kekayaan budaya Indonesia melalui BDARU Museum Digital.
                    <br>
                    <span class="text-lg text-emerald-200">Bagikan pengalaman Anda dan inspirasi untuk pengunjung lainnya.</span>
                </p>

                <!-- Quick Stats -->
                <div class="flex justify-center gap-8 text-center" data-aos="fade-up" data-aos-delay="800">
                    <div class="group hover:scale-110 transition-transform duration-300" data-aos="zoom-in" data-aos-delay="1000">
                        <div class="text-3xl font-black text-emerald-300">{{ testimonialsData.length }}+</div>
                        <div class="text-sm text-emerald-200 font-semibold">Total Testimoni</div>
                    </div>
                    <div class="group hover:scale-110 transition-transform duration-300" data-aos="zoom-in" data-aos-delay="1200">
                        <div class="text-3xl font-black text-teal-300">4.8</div>
                        <div class="text-sm text-teal-200 font-semibold">Rating Rata-rata</div>
                    </div>
                    <div class="group hover:scale-110 transition-transform duration-300" data-aos="zoom-in" data-aos-delay="1400">
                        <div class="text-3xl font-black text-cyan-300">10K+</div>
                        <div class="text-sm text-cyan-200 font-semibold">Pengunjung Puas</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Grid Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute inset-0">
            <!-- Background Elements -->
            <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-100/30 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-teal-100/30 rounded-full blur-3xl animate-float-medium"></div>
        </div>

        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header with CTA Button -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Testimoni <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Pengunjung</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8 leading-relaxed">
                    Dengarkan pengalaman langsung dari pengunjung yang telah menjelajahi kekayaan budaya Indonesia
                </p>

                <!-- CTA Button -->
                <button
                    @click="scrollToTestimonialForm"
                    class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-2xl shadow-xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Bagikan Testimoni Anda
                    <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <div
                    v-for="testimonial in testimonialsData"
                    :key="testimonial.id"
                    class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-emerald-200"
                    data-aos="fade-up"
                >
                    <!-- Card Header -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-full overflow-hidden shadow-lg">
                                    <img
                                        :src="testimonial.avatar_url || `https://ui-avatars.com/api/?name=${testimonial.name.charAt(0).toUpperCase()}&background=10b981&color=fff&size=128&bold=true`"
                                        :alt="testimonial.name"
                                        class="w-full h-full object-cover"
                                        @error="$event.target.src = `https://ui-avatars.com/api/?name=${testimonial.name.charAt(0).toUpperCase()}&background=10b981&color=fff&size=128&bold=true`"
                                    />
                                </div>
                                <div>
                                    <h4 class="text-gray-900 font-bold text-base">{{ testimonial.name }}</h4>
                                    <p class="text-gray-500 text-sm">{{ testimonial.profession || 'Pengunjung' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg v-for="i in testimonial.rating" :key="i" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.363 1.118l1.07 3.292c.3.922-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-sm text-gray-500 font-medium ml-1">{{ testimonial.rating }}/5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">
                        <!-- Quote Icon -->
                        <div class="mb-4">
                            <svg class="w-8 h-8 text-emerald-200" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <!-- Testimonial Content -->
                        <p class="text-gray-700 text-sm leading-relaxed mb-4 line-clamp-4">
                            "{{ testimonial.content }}"
                        </p>

                        <!-- Date -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                <span class="text-xs text-gray-500 font-medium">{{ new Date(testimonial.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) }}</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span class="text-xs text-gray-500">Testimoni</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="props.testimonials && props.testimonials.data && props.testimonials.data.length > 0" class="mt-8">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ props.testimonials.from || 1 }} - {{ props.testimonials.to || props.testimonials.data.length }} dari {{ props.testimonials.total || props.testimonials.data.length }} testimoni
                    </div>
                    <div class="flex items-center space-x-2">
                        <!-- Tombol Sebelumnya -->
                        <div v-if="props.testimonials.prev_page_url" class="relative">
                            <button
                                @click="goToPage(props.testimonials.prev_page_url)"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 cursor-pointer relative z-10"
                                :disabled="false"
                            >
                                ← Sebelumnya
                            </button>
                            <div class="absolute inset-0 bg-red-100 opacity-20 rounded-lg pointer-events-none"></div>
                        </div>
                        <span v-else class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-400 cursor-not-allowed">
                            ← Sebelumnya
                        </span>

                        <!-- Tombol Selanjutnya -->
                        <div v-if="props.testimonials.next_page_url" class="relative">
                            <button
                                @click="goToPage(props.testimonials.next_page_url)"
                                class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 hover:shadow-lg transform hover:scale-105 transition-all duration-200 cursor-pointer relative z-10"
                                :disabled="false"
                            >
                                Selanjutnya →
                            </button>
                            <div class="absolute inset-0 bg-green-100 opacity-20 rounded-lg pointer-events-none"></div>
                        </div>
                        <span v-else class="px-4 py-2 bg-gray-300 rounded-lg text-sm font-medium text-gray-500 cursor-not-allowed">
                            Selanjutnya →
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Submit Testimonial Section -->
    <section ref="testimonialFormRef" class="py-20 bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 relative overflow-hidden">
        <div class="absolute inset-0">
            <!-- Background Elements -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-200/20 rounded-full blur-3xl animate-float-slow"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-teal-200/20 rounded-full blur-3xl animate-float-medium"></div>
        </div>

        <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                        Bagikan <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Pengalaman</span> Anda
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Ceritakan pengalaman Anda dalam menjelajahi kekayaan budaya Indonesia melalui BDARU Museum Digital
                    </p>
                </div>

                <!-- Form Card - Only show for authenticated users -->
                <div v-if="isAuthenticated" class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100">
                    <form class="space-y-8">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" :value="$page.props.csrf_token">

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">
                                Rating <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center space-x-2">
                                <button
                                    v-for="star in 5"
                                    :key="star"
                                    type="button"
                                    @click="form.rating = star"
                                    class="group p-2 hover:scale-110 transition-transform duration-200"
                                >
                                    <svg
                                        class="w-8 h-8"
                                        :class="star <= form.rating ? 'text-yellow-400' : 'text-gray-300'"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.363 1.118l1.07 3.292c.3.922-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </button>
                                <span class="ml-4 text-sm font-medium" :class="form.rating > 0 ? 'text-gray-600' : 'text-gray-400'">
                                    {{ form.rating > 0 ? form.rating + '/5' : 'Pilih rating' }}
                                </span>
                            </div>
                        </div>

                        <!-- Testimonial Content -->
                        <div>
                            <label for="content" class="block text-sm font-bold text-gray-700 mb-3">
                                Testimoni Anda <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                v-model="form.content"
                                id="content"
                                required
                                rows="6"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none transition-all duration-300 text-gray-900 resize-none"
                                placeholder="Ceritakan pengalaman Anda dalam menjelajahi koleksi budaya Indonesia melalui platform digital kami. Apa yang paling berkesan? Bagaimana platform ini membantu Anda memahami budaya Indonesia?"
                            ></textarea>
                            <p class="text-xs text-gray-500 mt-2">Minimal 10 karakter, maksimal 1000 karakter</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center pt-6">
                            <button
                                type="button"
                                @click="submitTestimonial"
                                class="group inline-flex items-center px-12 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-2xl shadow-xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                            >
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Testimoni
                                <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Login Required Card - Show for guests -->
                <div v-else class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Login Diperlukan</h3>
                        <p class="text-gray-600 mb-8">
                            Anda harus login terlebih dahulu untuk dapat memberikan testimoni dan rating.
                        </p>
                        <div class="space-y-4">
                            <Link
                                :href="route('login')"
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Login Sekarang
                            </Link>
                            <div class="text-sm text-gray-500">
                                Belum punya akun?
                                <Link :href="route('register')" class="text-emerald-600 hover:text-emerald-700 font-medium">
                                    Daftar di sini
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <!-- Floating Action Button for Testimonial -->
    <button
        @click="scrollToTestimonialForm"
        class="fixed bottom-8 right-24 w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-full shadow-2xl hover:shadow-yellow-500/25 transform hover:scale-110 transition-all duration-300 z-50 group"
    >
        <div class="relative w-full h-full flex items-center justify-center">
            <svg
                class="w-7 h-7 transform group-hover:rotate-12 transition-transform duration-300"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Tooltip -->
        <div class="absolute right-full mr-3 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white text-sm px-3 py-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            Bagikan Testimoni
            <div class="absolute left-full top-1/2 transform -translate-y-1/2 w-0 h-0 border-l-4 border-l-gray-900 border-t-4 border-t-transparent border-b-4 border-b-transparent"></div>
        </div>
    </button>

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
                            <Link href="/events" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Agenda Kegiatan</span>
                            </Link>
                        </li>
                        <li>
                            <Link href="/contact" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center space-x-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <span>Kontak Kami</span>
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
                    <h3 class="text-xl font-bold text-white mb-6">Contact Info</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-300">{{ props.museumSettings?.address || 'Belum tersedia' }}, {{ props.museumSettings?.city || 'Belum tersedia' }}, {{ props.museumSettings?.country || 'Indonesia' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-emerald-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-300">{{ props.museumSettings?.email_info || 'Belum tersedia' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-emerald-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-300">{{ props.museumSettings?.phone_1 || 'Belum tersedia' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Enhanced Bottom Bar -->
            <div class="border-t border-gray-800 pt-8 mt-12">
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
    </footer>
</template>

<style scoped>
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

/* Line clamp utility */
.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
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
