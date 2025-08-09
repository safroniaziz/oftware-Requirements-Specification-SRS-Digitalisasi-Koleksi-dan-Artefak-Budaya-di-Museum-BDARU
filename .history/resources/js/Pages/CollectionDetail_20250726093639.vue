<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Navigation, Pagination, EffectFade } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

const props = defineProps({
    collection: {
        type: Object,
        required: true
    },
    relatedCollections: {
        type: Array,
        default: () => []
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    museumSettings: {
        type: Object,
        default: () => ({}),
    },
});

// Reactive data
const activeTab = ref('overview');
const showFullDescription = ref(false);
const mobileMenuOpen = ref(false);
const imageLoaded = ref(false);
const showBackToTop = ref(false);

// Methods
const handleImageError = (event) => {
            // Try to use a fallback image based on collection ID
        const collectionId = collection.value?.id;
        const fallbackIndex = collectionId ? (collectionId % 12) + 1 : 1;
        event.target.src = `/storage/collections/collection-${fallbackIndex}.jpg`;
};

const handleImageLoad = () => {
    imageLoaded.value = true;
};

const toggleDescription = () => {
    showFullDescription.value = !showFullDescription.value;
};

const formatNumber = (num) => {
    if (typeof num === 'number') {
        return num.toLocaleString('id-ID');
    }
    if (typeof num === 'string' && !isNaN(Number(num))) {
        return Number(num).toLocaleString('id-ID');
    }
    return '0';
};

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

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

// Lifecycle
onMounted(() => {
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true,
            offset: 50
        });
    }

    // Add scroll event listener for back to top button
    const handleScroll = () => {
        showBackToTop.value = window.scrollY > 300;
    };

    window.addEventListener('scroll', handleScroll);

    // Initialize particle system
    initParticleSystem();

    // Cleanup on unmount
    return () => {
        window.removeEventListener('scroll', handleScroll);
    };
});
</script>

<template>
    <Head :title="`${collection.name} - ${props.museumSettings?.museum_name || 'BDARU Museum Digital Balai Adat Rajo Penghulu'}`" />

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
                    <Link
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
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Koleksi -->
                    <Link
                        href="/collections"
                        class="group relative px-4 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span>Koleksi</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full scale-x-100"></div>
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
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
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
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </Link>

                    <!-- Kontak -->
                    <Link
                        href="/contact"
                        class="group relative px-4 py-3 text-gray-700 font-bold rounded-xl hover:text-emerald-600 transition-all duration-300"
                    >
                        <span class="relative z-10 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Kontak</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
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
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
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
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
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
                        class="group flex items-center px-4 py-3 text-emerald-600 font-bold rounded-lg hover:bg-emerald-50 transition-all duration-300"
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
                    <Link
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
        </div>

        <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <!-- Image Section -->
                <div class="w-full lg:w-1/2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-gray-200">
                        <!-- Loading State -->
                        <div v-if="!imageLoaded" class="absolute inset-0 bg-gradient-to-r from-gray-200 to-gray-300 animate-pulse rounded-2xl">
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-gray-400 rounded-full animate-spin mx-auto mb-3"></div>
                                    <p class="text-gray-500 text-sm">Loading image...</p>
                                </div>
                            </div>
                        </div>

                        <img
                            :src="collection.image_path"
                            :alt="collection.name"
                            class="w-full h-96 lg:h-[500px] object-cover transition-opacity duration-500"
                            :class="{ 'opacity-0': !imageLoaded, 'opacity-100': imageLoaded }"
                            @error="handleImageError"
                            @load="handleImageLoad"
                        >

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>

                        <!-- Featured Badge -->
                        <div v-if="collection.is_featured" class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-full">
                                ⭐ Featured Collection
                            </span>
                        </div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                {{ collection.category?.name || 'Uncategorized' }}
                            </span>
                        </div>

                        <!-- View Count -->
                        <div class="absolute bottom-4 left-4">
                            <div class="flex items-center space-x-2 bg-black/50 backdrop-blur-sm rounded-full px-3 py-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span class="text-white text-sm font-medium">{{ formatNumber(collection.view_count) }} views</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center justify-center lg:justify-start space-x-2 mb-6">
                        <Link href="/" class="text-emerald-300 hover:text-white transition-colors">Beranda</Link>
                        <span class="text-emerald-300">/</span>
                        <Link href="/collections" class="text-emerald-300 hover:text-white transition-colors">Koleksi Budaya</Link>
                        <span class="text-emerald-300">/</span>
                        <span class="text-white">{{ collection.name }}</span>
                    </nav>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4 leading-tight">
                        {{ collection.name }}
                    </h1>

                    <!-- Description -->
                    <p class="text-xl text-emerald-100 mb-6">{{ collection.description }}</p>

                    <!-- View Count -->
                    <div class="flex items-center justify-center lg:justify-start space-x-2 mb-6">
                        <span class="text-emerald-200">({{ formatNumber(collection.view_count) }} views)</span>
                    </div>

                    <!-- Quick Info -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="text-emerald-300 text-sm font-medium">Periode Tahun</div>
                            <div class="text-white font-bold">{{ collection.year_period }}</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="text-emerald-300 text-sm font-medium">Kategori</div>
                            <div class="text-white font-bold">{{ collection.category?.name || 'Uncategorized' }}</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="text-emerald-300 text-sm font-medium">Lokasi Asal</div>
                            <div class="text-white font-bold">{{ collection.origin_location }}</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="text-emerald-300 text-sm font-medium">Status</div>
                            <div class="text-white font-bold">{{ collection.is_active ? 'Aktif' : 'Tidak Aktif' }}</div>
                        </div>
                    </div>



                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <Link
                            href="/collections"
                            class="inline-flex items-center justify-center px-6 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition-all duration-300 group"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Kembali ke Koleksi Budaya
                        </Link>
                        <Link
                            href="/news"
                            class="inline-flex items-center justify-center px-6 py-3 border-2 border-emerald-400 text-emerald-300 font-bold rounded-xl hover:bg-emerald-400 hover:text-white transition-all duration-300"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            Lihat Berita
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Tabs Section -->
    <section class="py-16 bg-white">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tab Navigation -->
            <div class="flex flex-wrap justify-center border-b border-gray-200 mb-12">
                <button
                    @click="activeTab = 'overview'"
                    :class="[
                        'px-6 py-3 font-semibold text-sm border-b-2 transition-all duration-300',
                        activeTab === 'overview'
                            ? 'border-emerald-500 text-emerald-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    ]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Overview</span>
                    </span>
                </button>
                <button
                    @click="activeTab = 'details'"
                    :class="[
                        'px-6 py-3 font-semibold text-sm border-b-2 transition-all duration-300',
                        activeTab === 'details'
                            ? 'border-emerald-500 text-emerald-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    ]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Detail Teknis</span>
                    </span>
                </button>
                <button
                    @click="activeTab = 'history'"
                    :class="[
                        'px-6 py-3 font-semibold text-sm border-b-2 transition-all duration-300',
                        activeTab === 'history'
                            ? 'border-emerald-500 text-emerald-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    ]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Sejarah</span>
                    </span>
                </button>
                <button
                    @click="activeTab = 'gallery'"
                    :class="[
                        'px-6 py-3 font-semibold text-sm border-b-2 transition-all duration-300',
                        activeTab === 'gallery'
                            ? 'border-emerald-500 text-emerald-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    ]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Galeri</span>
                    </span>
                </button>
            </div>

            <!-- Tab Content -->
            <div class="min-h-[400px]">
                <!-- Overview Tab -->
                <div v-if="activeTab === 'overview'" class="space-y-8" data-aos="fade-up">
                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Deskripsi Koleksi</h2>
                        <div class="text-gray-700 leading-relaxed">
                            <p v-if="!showFullDescription" class="mb-4">
                                {{ collection.description.substring(0, 300) }}...
                            </p>
                            <p v-else class="mb-4">
                                {{ collection.description }}
                            </p>
                            <button
                                @click="toggleDescription"
                                class="text-emerald-600 hover:text-emerald-700 font-semibold transition-colors"
                            >
                                {{ showFullDescription ? 'Sembunyikan' : 'Baca Selengkapnya' }}
                            </button>
                        </div>
                    </div>

                    <!-- Cultural Significance -->
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-8 border border-emerald-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Signifikansi Budaya</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Koleksi ini memiliki nilai budaya yang tinggi dan merupakan bagian penting dari warisan budaya Indonesia.
                            Setiap detail dan elemen dalam koleksi ini menceritakan kisah tentang peradaban, tradisi, dan nilai-nilai
                            yang telah diwariskan dari generasi ke generasi.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Nilai Historis</h4>
                                <p class="text-sm text-gray-600">Menggambarkan periode sejarah penting dalam perkembangan budaya Indonesia</p>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Lokasi Asal</h4>
                                <p class="text-sm text-gray-600">Berasal dari daerah yang kaya akan tradisi dan budaya lokal</p>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Nilai Edukatif</h4>
                                <p class="text-sm text-gray-600">Memberikan pembelajaran tentang teknik dan filosofi budaya tradisional</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details Tab -->
                <div v-if="activeTab === 'details'" class="space-y-8" data-aos="fade-up">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Technical Specifications -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Spesifikasi Teknis</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Material</span>
                                    <span class="text-gray-900 font-semibold">-</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Dimensi</span>
                                    <span class="text-gray-900 font-semibold">-</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Tahun Pembuatan</span>
                                    <span class="text-gray-900 font-semibold">{{ collection.year_period }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Status Konservasi</span>
                                    <span class="text-gray-900 font-semibold">{{ collection.is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Kategori</span>
                                    <span class="text-gray-900 font-semibold">{{ collection.category?.name || 'Uncategorized' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3">
                                    <span class="text-gray-600 font-medium">Rating</span>
                                    <span class="text-gray-900 font-semibold">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Conservation Information -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Konservasi</h3>
                            <div class="space-y-4">
                                <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                                    <h4 class="font-semibold text-emerald-800 mb-2">Kondisi Saat Ini</h4>
                                    <p class="text-emerald-700 text-sm">Koleksi ini telah melalui proses konservasi dan digitalisasi yang ketat untuk memastikan kelestariannya.</p>
                                </div>
                                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                    <h4 class="font-semibold text-blue-800 mb-2">Metode Digitalisasi</h4>
                                    <p class="text-blue-700 text-sm">Menggunakan teknologi fotografi resolusi tinggi dan pemindaian 3D untuk dokumentasi yang akurat.</p>
                                </div>
                                <div class="bg-purple-50 rounded-xl p-4 border border-purple-200">
                                    <h4 class="font-semibold text-purple-800 mb-2">Penyimpanan</h4>
                                    <p class="text-purple-700 text-sm">Disimpan dalam kondisi terkontrol dengan suhu dan kelembaban yang optimal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Tab -->
                <div v-if="activeTab === 'history'" class="space-y-8" data-aos="fade-up">
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Sejarah Koleksi</h3>
                        <div class="space-y-6">
                            <div class="relative pl-8 border-l-4 border-emerald-500">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-emerald-500 rounded-full transform -translate-x-2"></div>
                                <h4 class="font-semibold text-gray-900 mb-2">{{ collection.year_period }}</h4>
                                <p class="text-gray-700">Periode pembuatan koleksi ini, menggambarkan konteks historis dan budaya pada masa tersebut.</p>
                            </div>
                            <div class="relative pl-8 border-l-4 border-teal-500">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-teal-500 rounded-full transform -translate-x-2"></div>
                                                        <h4 class="font-semibold text-gray-900 mb-2">Era Tradisional</h4>
                        <p class="text-gray-700">Dibuat dengan teknik tradisional, menandakan periode keahlian dan tradisi yang berkembang pada masa itu.</p>
                            </div>
                            <div class="relative pl-8 border-l-4 border-cyan-500">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-cyan-500 rounded-full transform -translate-x-2"></div>
                                <h4 class="font-semibold text-gray-900 mb-2">Lokasi Asal</h4>
                                <p class="text-gray-700">Berasal dari {{ collection.origin_location }}, menunjukkan pengaruh budaya dan tradisi lokal yang khas.</p>
                            </div>
                            <div class="relative pl-8 border-l-4 border-purple-500">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-purple-500 rounded-full transform -translate-x-2"></div>
                                <h4 class="font-semibold text-gray-900 mb-2">Era Modern</h4>
                                <p class="text-gray-700">Koleksi ini telah melalui proses digitalisasi dan konservasi untuk memastikan kelestariannya bagi generasi mendatang.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Tab -->
                <div v-if="activeTab === 'gallery'" class="space-y-8" data-aos="fade-up">
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Galeri Detail</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="group relative overflow-hidden rounded-xl">
                                <img
                                                                :src="collection.image_path"
                            :alt="collection.name"
                                    class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                                    @error="handleImageError"
                                >
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <button class="text-white font-semibold">Lihat Detail</button>
                                </div>
                            </div>
                            <!-- Additional gallery images would go here -->
                            <div class="group relative overflow-hidden rounded-xl bg-gray-100 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Gambar tambahan akan ditampilkan di sini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Collections Section -->
    <section v-if="relatedCollections.length > 0" class="py-16 bg-gray-50">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Koleksi <span class="text-emerald-600">Terkait</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jelajahi koleksi lain yang serupa atau berasal dari kategori yang sama
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="related in relatedCollections"
                    :key="related.id"
                    class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100"
                    data-aos="fade-up"
                >
                    <div class="relative h-48 overflow-hidden">
                        <img
                            :src="related.image_path"
                            :alt="related.name"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            @error="handleImageError"
                        >
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/60 via-black/20 to-transparent">
                            <h3 class="text-lg font-bold text-white mb-1">{{ related.name }}</h3>
                            <p class="text-white/90 text-sm">{{ related.category?.name || 'Uncategorized' }}</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-500">{{ related.year_period }}</span>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">{{ formatNumber(related.view_count) }} views</span>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">{{ related.description }}</p>

                        <Link
                            :href="`/collections/${related.id}`"
                            class="inline-flex items-center w-full justify-center px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-colors duration-200"
                        >
                            Lihat Detail
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-20 bg-gradient-to-br from-emerald-50 via-white to-teal-50">
        <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-8">
                Ingin <span class="text-emerald-600">Jelajahi</span> Lebih Banyak?
            </h2>
            <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                Temukan ribuan koleksi budaya Indonesia lainnya yang telah didigitalisasi dengan teknologi terkini.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <Link
                    href="/collections"
                    class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-bold rounded-xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Lihat Semua Koleksi
                </Link>
                <Link
                    href="/about"
                    class="inline-flex items-center px-8 py-4 border-2 border-emerald-300 text-emerald-700 font-bold rounded-xl hover:bg-emerald-50 hover:border-emerald-400 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tentang Museum
                </Link>
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
                                                        <p class="text-gray-300 text-sm">{{ props.museumSettings?.address || 'Belum tersedia' }}</p>
                        <p class="text-gray-300 text-sm">{{ props.museumSettings?.city || 'Belum tersedia' }}, {{ props.museumSettings?.postal_code || '' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                                        <p class="text-gray-300 text-sm">{{ props.museumSettings?.email_info || 'Belum tersedia' }}</p>
                        <p class="text-gray-300 text-sm">{{ props.museumSettings?.email_support || 'Belum tersedia' }}</p>
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

<style scoped>
/* Custom animations */
@keyframes float-slow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes float-medium {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-medium {
    animation: float-medium 4s ease-in-out infinite;
}

/* Line clamp utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
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
