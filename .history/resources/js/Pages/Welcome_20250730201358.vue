<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, EffectFade, Navigation, Pagination, Parallax } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    featuredCollections: {
        type: Array,
        default: () => [],
    },
    recentNews: {
        type: Array,
        default: () => [],
    },
    featuredNews: {
        type: Array,
        default: () => [],
    },
    stats: {
        type: Object,
        default: () => ({}),
    },
    featuredTestimonials: {
        type: Array,
        default: () => [],
    },
    museumSettings: {
        type: Object,
        default: () => ({}),
    },
});

const showBackToTop = ref(false);
const swiperRef = ref(null);
const mobileMenuOpen = ref(false);
const activeNewsTab = ref('recent'); // 'recent' or 'featured'

// Loading states
const heroLoaded = ref(true); // Set to true immediately since we're using placeholders
const imagesLoading = ref(0);
const totalImages = ref(0);
const browserLoading = ref(true);





// Hero images - Admin akan upload gambar nanti
const heroImages = [
    {
        id: 1,
        src: null, // Admin akan upload gambar nanti
        alt: 'Museum Interior',
        title: 'Galeri Seni Rupa',
        subtitle: 'Koleksi Lukisan Klasik Indonesia',
        description: 'Jelajahi keindahan seni rupa tradisional dan kontemporer'
    },
    {
        id: 2,
        src: null, // Admin akan upload gambar nanti
        alt: 'Ancient Artifacts',
        title: 'Artefak Kuno',
        subtitle: 'Peninggalan Sejarah Nusantara',
        description: 'Temukan harta karun arkeologi dari masa lalu'
    },
    {
        id: 3,
        src: null, // Admin akan upload gambar nanti
        alt: 'Traditional Textiles',
        title: 'Kain Tradisional',
        subtitle: 'Batik dan Tenun Nusantara',
        description: 'Warisan tekstil yang menceritakan budaya bangsa'
    }
];

function handleScroll() {
    showBackToTop.value = window.scrollY > 300;
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function handleImageError(event) {
    console.error('Image failed to load:', event.target.src);
    // Fallback to a placeholder image
            // Try to use a fallback image based on collection ID
        const collectionId = event.target.dataset.collectionId;
        const fallbackIndex = collectionId ? (parseInt(collectionId) % 12) + 1 : 1;
        event.target.src = `/storage/collections/collection-${fallbackIndex}.jpg`;
}



function handleImageLoad(event) {
    console.log('Image loaded successfully:', event.target.src);
    console.log('Image element:', event.target);
    console.log('Image dimensions:', event.target.naturalWidth, 'x', event.target.naturalHeight);
    console.log('Image display style:', getComputedStyle(event.target).display);
    console.log('Image visibility:', getComputedStyle(event.target).visibility);
}

function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'k';
    }
    return num.toString();
}

function onSwiper(swiper) {
    swiperRef.value = swiper;
    console.log('Swiper initialized:', swiper);
    console.log('Number of slides:', swiper.slides.length);
    console.log('Hero images:', heroImages);
}

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
            particles.slice(i + 1).forEach(particle2 => {
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
    window.addEventListener('scroll', handleScroll);

    // Browser loading finished
    browserLoading.value = false;

    // Count total images to load
    totalImages.value = heroImages.length;

    // Hero images are placeholders now, so no need to preload
    // Admin will upload images later

    // Initialize AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true,
            offset: 50
        });
    }

    // Particle System
    initParticleSystem();


});





onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <Head :title="`BDARU - ${props.museumSettings?.museum_name || 'Museum Digital Indonesia BDARU'}`" />

    <!-- Browser Loading Overlay -->
    <div v-if="browserLoading" class="fixed inset-0 bg-gradient-to-br from-emerald-900 via-teal-800 to-cyan-900 z-[9999] flex items-center justify-center">
        <div class="text-center">
            <!-- Animated Logo -->
            <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-2xl mx-auto animate-pulse">
                <div class="w-12 h-8 bg-white/95 rounded-lg relative">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-600 to-teal-600"></div>
                    <div class="absolute top-2 left-1 right-1 h-0.5 bg-gray-800"></div>
                    <div class="absolute top-4 left-1 right-1 h-0.5 bg-gray-800"></div>
                    <div class="absolute top-1 left-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                    <div class="absolute top-1 right-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                    <div class="absolute top-3 left-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                    <div class="absolute top-3 right-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-700 rounded-t-sm"></div>
                </div>
            </div>

            <!-- Loading Text -->
            <h1 class="text-3xl font-black text-white mt-4 mb-2">BDARU</h1>
            <p class="text-sm text-emerald-200">{{ props.museumSettings?.museum_name || 'Museum Digital Indonesia BDARU' }}</p>

            <!-- Loading Animation -->
            <div class="flex justify-center space-x-1 mt-4">
                <div class="w-2 h-2 bg-emerald-400 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-teal-400 rounded-full animate-bounce delay-100"></div>
                <div class="w-2 h-2 bg-cyan-400 rounded-full animate-bounce delay-200"></div>
            </div>
        </div>
    </div>

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
                                        {{ props.museumSettings?.museum_name || 'Museum Digital Indonesia BDARU' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Auth Buttons -->
                    <div class="hidden lg:flex items-center space-x-4">
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
                    <div class="lg:hidden">
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
                            class="group relative px-4 py-3 text-emerald-600 font-bold transition-all duration-300 rounded-xl"
                        >
                            <span class="relative z-10 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                <span>Beranda</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-100"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full scale-x-100"></div>
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
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
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
                            class="group flex items-center px-4 py-3 text-emerald-600 font-bold rounded-lg hover:bg-emerald-50 transition-all duration-300"
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
                                class="w-full flex items-center justify-center px-4 py-3 text-gray-700 font-bold rounded-xl border-2 border-gray-200 hover:border-emerald-400 hover:text-emerald-600 transition-all duration-300"
                                @click="mobileMenuOpen = false"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Login</span>
                            </a>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl shadow-lg hover:shadow-emerald-500/25 transition-all duration-300 overflow-hidden"
                                @click="mobileMenuOpen = false"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                <span>Register</span>
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </div>

                <!-- Hero Section -->
        <section class="relative py-16 lg:py-24 bg-gradient-to-br from-white via-emerald-50 to-teal-100 overflow-hidden min-h-[80vh]" :class="{ 'mt-16 lg:mt-0': !mobileMenuOpen, 'mt-0': mobileMenuOpen }">
            <!-- Particle System Canvas -->
            <canvas id="particleCanvas" class="absolute inset-0 w-full h-full pointer-events-none"></canvas>

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
                            <span class="text-sm font-bold">🏛️ {{ props.museumSettings?.museum_name || 'Museum Digital Indonesia BDARU' }}</span>
                        </div>

                        <!-- Enhanced Main Heading -->
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                            <span class="bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 bg-clip-text text-transparent animate-gradient">
                                BDARU
                            </span>
                        </h1>

                        <!-- Enhanced Subtitle -->
                        <p class="text-lg md:text-xl mb-8 leading-relaxed text-gray-700 font-medium max-w-2xl mx-auto lg:mx-0">
                            Jelajahi kekayaan budaya Indonesia melalui
                            <span class="font-bold text-emerald-700">teknologi digital</span> yang inovatif.
                            <br>
                            <span class="text-base text-gray-600">Temukan warisan budaya dalam format yang modern dan interaktif.</span>
                        </p>

                        <!-- Enhanced CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <Link
                                href="/collections"
                                class="group relative px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-xl shadow-2xl hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 overflow-hidden"
                            >
                                <span class="relative z-10 flex items-center justify-center gap-3 text-base">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Jelajahi Koleksi
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-700 to-teal-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </Link>
                            <Link
                                href="/about"
                                class="group relative px-8 py-4 border-2 border-emerald-300 text-emerald-700 font-bold rounded-xl backdrop-blur-md hover:bg-emerald-50 hover:border-emerald-400 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 shadow-lg"
                            >
                                <span class="relative z-10 flex items-center justify-center gap-3 text-base">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tentang Kami
                                </span>
                            </Link>
                        </div>


                    </div>

                    <!-- Enhanced Right Image Slider -->
                    <div class="w-full lg:w-1/2 animate-fade-in-up delay-1000">
                        <div class="relative h-80 lg:h-96 rounded-2xl overflow-hidden shadow-2xl bg-gray-200 group animate-float-subtle">
                            <!-- Skeleton Loading for Hero -->
                            <div v-if="!heroLoaded" class="absolute inset-0 bg-gradient-to-r from-gray-200 to-gray-300 animate-pulse rounded-2xl">
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-gray-400 rounded-full animate-spin mx-auto mb-3"></div>
                                        <p class="text-gray-500 text-xs">Loading gallery...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Glow Effect -->
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/30 to-teal-500/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>

                            <Swiper
                                v-show="heroLoaded"
                                :modules="[Autoplay, Navigation, Pagination]"
                                :slides-per-view="1"
                                :loop="true"
                                :autoplay="{
                                    delay: 4000,
                                    disableOnInteraction: false,
                                }"
                                :speed="1000"
                                :navigation="true"
                                :pagination="true"
                                class="hero-swiper h-full"
                                @swiper="onSwiper"
                            >
                                <SwiperSlide
                                    v-for="image in heroImages"
                                    :key="image.id"
                                    class="relative w-full h-full"
                                >
                                    <div class="relative w-full h-full flex items-center justify-center">
                                        <img
                                            v-if="image.src"
                                            :src="image.src"
                                            :alt="image.alt"
                                            class="w-full h-full object-cover absolute inset-0 transition-transform duration-700 group-hover:scale-110"
                                            @error="handleImageError"
                                            @load="handleImageLoad"
                                            loading="eager"
                                            decoding="async"
                                        />
                                        <div
                                            v-else
                                            class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center absolute inset-0"
                                        >
                                            <div class="text-center">
                                                <svg class="w-24 h-24 text-emerald-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <p class="text-emerald-600 text-lg font-medium">Gambar belum tersedia</p>
                                                <p class="text-emerald-500 text-sm mt-2">Admin akan upload gambar nanti</p>
                                            </div>
                                        </div>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                                        <!-- Enhanced Image Title Overlay -->
                                        <div class="absolute bottom-4 left-4 right-4 z-10">
                                            <div class="bg-white/95 backdrop-blur-md rounded-xl p-4 border-2 border-emerald-200 transform transition-all duration-500 hover:bg-white shadow-xl">
                                                <h3 class="text-gray-900 font-bold text-lg mb-1">{{ image.title }}</h3>
                                                <p class="text-gray-700 text-sm mb-1">{{ image.subtitle }}</p>
                                                <p class="text-gray-600 text-xs">{{ image.description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </SwiperSlide>
                            </Swiper>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Featured Collections Section -->
        <section class="py-12 lg:py-24 bg-white">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-12 lg:mb-16">
                    <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 rounded-full border-2 border-emerald-200 mb-6 group hover:bg-gradient-to-r hover:from-emerald-200 hover:to-teal-200 transition-all duration-300 shadow-lg">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-sm font-bold">🆕 Koleksi Terbaru</span>
                    </div>
                    <h2 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 bg-clip-text text-transparent animate-gradient">
                            Koleksi Terbaru
                        </span>
                    </h2>
                    <p class="text-xl md:text-2xl text-gray-700 font-medium max-w-4xl mx-auto leading-relaxed">
                        Jelajahi koleksi budaya terbaru yang baru saja ditambahkan ke museum digital kami
                    </p>
                </div>

                <!-- Collections Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <div
                        v-for="collection in props.featuredCollections.slice(0, 6)"
                        :key="collection.id"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100"
                        data-aos="fade-up"
                    >
                        <!-- Image Container -->
                        <div class="relative h-48 sm:h-56 lg:h-64 overflow-hidden">
                            <img
                                v-if="collection.image_url"
                                :src="collection.image_url"
                                :alt="collection.name"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            >
                            <div
                                v-else
                                class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center"
                            >
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-emerald-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-emerald-600 text-sm font-medium">Gambar belum tersedia</p>
                                </div>
                            </div>
                            <!-- Overlay Pattern -->
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20 z-10"></div>

                            <!-- Featured Badge -->
                            <div v-if="collection.is_featured" class="absolute top-3 left-3 z-20">
                                <span class="inline-flex items-center px-2 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-full">
                                    ⭐ Unggulan
                                </span>
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute top-3 right-3 z-20">
                                <span class="inline-flex items-center px-2 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                    {{ collection.category?.name || 'Koleksi' }}
                                </span>
                            </div>

                            <!-- Content Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 p-4 lg:p-6 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-20">
                                <h3 class="text-lg sm:text-xl font-bold text-white mb-2 line-clamp-2">{{ collection.name }}</h3>
                                <p class="text-white/90 text-sm leading-relaxed line-clamp-2">{{ collection.description?.substring(0, 80) }}...</p>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4 lg:p-6">
                            <!-- Stats Row -->
                            <div class="flex items-center justify-between mb-3 lg:mb-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                    <span class="text-xs text-gray-500 font-medium">{{ collection.year_period || 'N/A' }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-600 font-medium">{{ (collection.view_count || 0).toLocaleString() }} kali dilihat</span>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm leading-relaxed mb-3 lg:mb-4 line-clamp-3">{{ collection.description }}</p>

                            <!-- Location -->
                            <div class="mb-3 lg:mb-4">
                                <span class="inline-flex items-center px-2 py-1 bg-emerald-50 text-emerald-700 text-xs font-medium rounded-md">
                                    📍 {{ collection.origin_location || 'Indonesia' }}
                                </span>
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
                                    <span class="text-xs text-gray-500">{{ (collection.view_count || 0).toLocaleString() }} kali dilihat</span>
                                </div>
                                <Link
                                    :href="`/collections/${collection.id}`"
                                    class="inline-flex items-center px-3 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-colors duration-200 group-hover:shadow-lg"
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

                <!-- View All Button -->
                <div class="text-center mt-8 lg:mt-12">
                    <Link
                        href="/collections"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-xl shadow-lg hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                    >
                        <span>Lihat Semua Koleksi</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Recent News Section -->
        <section class="py-12 lg:py-24 bg-gray-50">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-12 lg:mb-16">
                    <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 rounded-full border-2 border-emerald-200 mb-6 group hover:bg-gradient-to-r hover:from-emerald-200 hover:to-teal-200 transition-all duration-300 shadow-lg">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-sm font-bold">📰 Berita Terbaru</span>
                    </div>
                    <h2 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 bg-clip-text text-transparent animate-gradient">
                            Berita Terbaru
                        </span>
                    </h2>
                    <p class="text-xl md:text-2xl text-gray-700 font-medium max-w-4xl mx-auto leading-relaxed">
                        Dapatkan informasi terbaru seputar budaya, pameran, dan kegiatan museum
                    </p>
                </div>

                <!-- News Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <div
                        v-for="news in props.recentNews.slice(0, 3)"
                        :key="news.id"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100"
                        data-aos="fade-up"
                    >
                        <!-- Image Container -->
                        <div class="relative h-48 sm:h-56 lg:h-64 overflow-hidden">
                            <img
                                v-if="news.image_url"
                                :src="news.image_url"
                                :alt="news.title"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            >
                            <div
                                v-else
                                class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center"
                            >
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-emerald-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-emerald-600 text-sm font-medium">Gambar belum tersedia</p>
                                </div>
                            </div>
                            <!-- Overlay Pattern -->
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20 z-10"></div>

                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3 z-20">
                                <span class="inline-flex items-center px-2 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-full">
                                    {{ news.news_category?.name || 'Berita' }}
                                </span>
                        </div>

                            <!-- Date Badge -->
                            <div class="absolute top-3 right-3 z-20">
                                <span class="inline-flex items-center px-2 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                    {{ new Date(news.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }) }}
                                </span>
                        </div>

                            <!-- Content Overlay -->
                            <div class="absolute bottom-0 left-0 right-0 p-4 lg:p-6 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-20">
                                <h3 class="text-lg sm:text-xl font-bold text-white mb-2 line-clamp-2">{{ news.title }}</h3>
                                <p class="text-white/90 text-sm leading-relaxed line-clamp-2">{{ news.excerpt?.substring(0, 80) }}...</p>
                            </div>
                                </div>

                        <!-- Card Content -->
                        <div class="p-4 lg:p-6">
                            <!-- Meta Info -->
                            <div class="flex items-center justify-between mb-3 lg:mb-4">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-500 font-medium">{{ new Date(news.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-600 font-medium">{{ (news.view_count || 0).toLocaleString() }} kali dilihat</span>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm leading-relaxed mb-3 lg:mb-4 line-clamp-3">{{ news.excerpt }}</p>

                            <!-- Action Button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ (news.view_count || 0).toLocaleString() }} kali dilihat</span>
                                </div>
                                <Link
                                    :href="`/news/${news.id}`"
                                    class="inline-flex items-center px-3 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-colors duration-200 group-hover:shadow-lg"
                                >
                                    Baca
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </Link>
                            </div>
                                </div>
                            </div>
                        </div>

                <!-- View All Button -->
                <div class="text-center mt-8 lg:mt-12">
                    <Link
                        href="/news"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-xl shadow-lg hover:shadow-emerald-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                    >
                        <span>Lihat Semua Berita</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Enhanced Testimonials Section -->
        <section class="py-16 bg-gradient-to-br from-emerald-50 via-white to-teal-50 relative overflow-hidden">
            <div class="absolute inset-0">
                <!-- Enhanced Background Elements -->
                <div class="absolute top-0 left-0 w-80 h-80 bg-emerald-200/20 rounded-full blur-3xl animate-float-slow"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-teal-200/20 rounded-full blur-3xl animate-float-medium"></div>
            </div>

            <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Enhanced Header -->
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 rounded-full border-2 border-emerald-200 mb-6 group hover:bg-gradient-to-r hover:from-emerald-200 hover:to-teal-200 transition-all duration-300 shadow-lg">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-sm font-bold">💬 Testimoni Pengunjung</span>
                    </div>

                    <h2 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 bg-clip-text text-transparent animate-gradient">
                            Apa Kata Mereka
                        </span>
                    </h2>

                    <p class="text-xl md:text-2xl text-gray-700 font-medium max-w-4xl mx-auto leading-relaxed">
                        Pengalaman pengunjung dalam menjelajahi kekayaan budaya Indonesia
                        <span class="font-bold text-emerald-700">melalui platform digital kami</span>
                    </p>
                </div>

                <!-- Enhanced Testimonials Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div
                        v-for="(testimonial, index) in props.featuredTestimonials.slice(0, 3)"
                        :key="testimonial.id"
                        class="group relative bg-white/90 backdrop-blur-md rounded-2xl p-8 border-2 border-emerald-200/50 hover:bg-white hover:border-emerald-300 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 shadow-xl hover:shadow-2xl"
                    >
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>

                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden mr-3">
                                    <img
                                        :src="testimonial.avatar_url || `https://ui-avatars.com/api/?name=${testimonial.name.charAt(0).toUpperCase()}&background=10b981&color=fff&size=128&bold=true`"
                                        :alt="testimonial.name"
                                        class="w-full h-full object-cover"
                                        @error="$event.target.src = `https://ui-avatars.com/api/?name=${testimonial.name.charAt(0).toUpperCase()}&background=10b981&color=fff&size=128&bold=true`"
                                    />
                                </div>
                                <div>
                                    <h4 class="text-gray-800 font-bold text-base">{{ testimonial.name }}</h4>
                                    <p class="text-gray-600 text-xs">{{ testimonial.profession || 'Pengunjung' }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm leading-relaxed italic">
                                "{{ testimonial.content }}"
                            </p>
                            <div class="flex items-center mt-3">
                                <div class="flex text-yellow-400">
                                    <svg v-for="i in testimonial.rating" :key="i" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- View All Testimonials Button -->
                <div class="text-center">
                    <Link
                        href="/testimonials"
                        class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl"
                    >
                        <span class="flex items-center justify-center gap-3 text-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Lihat Semua Testimoni
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    </Link>
                </div>

            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="py-24 bg-gradient-to-br from-emerald-900 via-teal-800 to-cyan-900 text-white relative overflow-hidden">
            <div class="absolute inset-0">
                <!-- Background Elements -->
                <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl animate-float-slow"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 bg-teal-500/10 rounded-full blur-3xl animate-float-medium"></div>
            </div>

            <div class="relative z-10 w-full lg:w-4/5 mx-auto text-center px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-6 group hover:bg-white/20 transition-all duration-300">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-sm font-medium text-white">🚀 Mulai Petualangan Budaya</span>
                    </div>
                </div>

                <h2 class="text-5xl md:text-7xl font-black mb-8">
                    Siap Jelajahi <span class="text-emerald-300">Budaya Indonesia</span>?
                </h2>
                <p class="text-xl md:text-2xl text-emerald-100 mb-12 leading-relaxed max-w-4xl mx-auto">
                    Bergabunglah dengan ribuan pengunjung yang telah menemukan kekayaan budaya Indonesia
                    melalui platform digital kami yang inovatif dan modern.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <Link
                        href="/collections"
                        class="group relative px-12 py-5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-full transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-emerald-500/25 overflow-hidden"
                    >
                        <span class="relative z-10 flex items-center justify-center gap-3 text-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Mulai Jelajahi
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </Link>
                    <Link
                        href="/contact"
                        class="group px-12 py-5 border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-emerald-900 transition-all duration-300 backdrop-blur-sm"
                    >
                        <span class="flex items-center justify-center gap-3 text-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Hubungi Kami
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
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
                                            Museum Digital Indonesia
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
                            © 2024 BDARU {{ props.museumSettings?.museum_name || 'Museum Digital Indonesia BDARU' }}. All rights reserved.
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
            class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300 z-50 group"
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
                <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-purple-700 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
        </button>
    </div>
</template>

<style scoped>
/* Custom Swiper Styles */
.hero-swiper {
    border-radius: 1rem;
    overflow: hidden;
    width: 100%;
    height: 100%;
}

.hero-swiper .swiper-slide {
    border-radius: 1rem;
    overflow: hidden;
    width: 100%;
    height: 100%;
}

.hero-swiper .swiper-wrapper {
    width: 100%;
    height: 100%;
}

/* Ensure images are visible */
.hero-swiper .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Navigation buttons styling */
.hero-swiper .swiper-button-next,
.hero-swiper .swiper-button-prev {
    color: white;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    border-radius: 50%;
    width: 2.5rem;
    height: 2.5rem;
    transition: all 0.3s ease;
    z-index: 20;
}

.hero-swiper .swiper-button-next:hover,
.hero-swiper .swiper-button-prev:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.hero-swiper .swiper-button-next::after,
.hero-swiper .swiper-button-prev::after {
    font-size: 1rem;
    font-weight: bold;
}

/* Pagination styling */
.hero-swiper .swiper-pagination {
    z-index: 20;
}

.hero-swiper .swiper-pagination-bullet {
    background: rgba(255, 255, 255, 0.3);
    opacity: 1;
    transition: all 0.3s ease;
    width: 0.5rem;
    height: 0.5rem;
}

.hero-swiper .swiper-pagination-bullet-active {
    background: #fbbf24;
    transform: scale(1.5);
}

/* Gradient animation */
@keyframes gradient {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

/* Floating animations */
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    25% { transform: translateY(-20px) rotate(5deg); }
    50% { transform: translateY(-10px) rotate(0deg); }
    75% { transform: translateY(-30px) rotate(-5deg); }
}

@keyframes float-medium {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-15px) rotate(3deg); }
    66% { transform: translateY(-25px) rotate(-3deg); }
}

@keyframes float-fast {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(10deg); }
}

@keyframes float-subtle {
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

.animate-float-subtle {
    animation: float-subtle 4s ease-in-out infinite;
}

/* Quick loading animations */
@keyframes fade-in {
    0% { opacity: 0; transform: translateY(10px); }
    100% { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out forwards;
}

.delay-100 {
    animation-delay: 0.1s;
}

.delay-200 {
    animation-delay: 0.2s;
}

/* Spinning animations */
@keyframes spin-slow {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes spin-medium {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(-360deg); }
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}

.animate-spin-medium {
    animation: spin-medium 15s linear infinite;
}




</style>
