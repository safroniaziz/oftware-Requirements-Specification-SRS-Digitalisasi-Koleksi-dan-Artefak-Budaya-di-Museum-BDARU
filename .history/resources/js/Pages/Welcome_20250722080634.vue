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

defineProps({
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
});

const showBackToTop = ref(false);
const swiperRef = ref(null);

// Stats data - These will be populated from Laravel backend API calls
// digitalProgress: Based on collections table (total collections vs target)
// categoryProgress: Based on categories table (active categories vs target)
// featuredProgress: Based on collections table where is_featured = true
const digitalProgress = ref(75);
const categoryProgress = ref(80);
const featuredProgress = ref(60);

// Recent activity data - These will be populated from:
// - collections table (new additions)
// - visits table (daily visitors)
// - collections table where is_featured = true (featured updates)
const recentActivities = ref([
    { type: 'collection', message: '+7 koleksi baru ditambahkan', color: 'emerald' },
    { type: 'visit', message: '1000 pengunjung hari ini', color: 'blue' },
    { type: 'featured', message: '5 koleksi unggulan diperbarui', color: 'purple' }
]);

// Quick stats data - These will be populated from:
// - visits table (average daily visits)
// - collections table (most viewed collection)
// - user ratings (if implemented)
const quickStats = ref({
    avgVisits: '2,450/hari',
    popularCollection: 'Batik Klasik',
    userRating: '4.8/5.0'
});

// Sample museum images with better quality and variety
const heroImages = [
    {
        id: 1,
        src: 'https://picsum.photos/1200/800?random=1',
        alt: 'Museum Interior',
        title: 'Galeri Seni Rupa',
        subtitle: 'Koleksi Lukisan Klasik Indonesia',
        description: 'Jelajahi keindahan seni rupa tradisional dan kontemporer'
    },
    {
        id: 2,
        src: 'https://picsum.photos/1200/800?random=2',
        alt: 'Ancient Artifacts',
        title: 'Artefak Kuno',
        subtitle: 'Peninggalan Sejarah Nusantara',
        description: 'Temukan harta karun arkeologi dari masa lalu'
    },
    {
        id: 3,
        src: 'https://picsum.photos/1200/800?random=3',
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
    event.target.src = 'https://via.placeholder.com/1200x800/4F46E5/FFFFFF?text=BDARU+Museum';
}

function handleImageLoad(event) {
    console.log('Image loaded successfully:', event.target.src);
    console.log('Image element:', event.target);
    console.log('Image dimensions:', event.target.naturalWidth, 'x', event.target.naturalHeight);
    console.log('Image display style:', getComputedStyle(event.target).display);
    console.log('Image visibility:', getComputedStyle(event.target).visibility);
}

function onSwiper(swiper) {
    swiperRef.value = swiper;
    console.log('Swiper initialized:', swiper);
    console.log('Number of slides:', swiper.slides.length);
    console.log('Hero images:', heroImages);
}

// Particle System Function
function initParticleSystem() {
    const canvas = document.getElementById('particleCanvas');
    if (!canvas) return;

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
            this.opacity = Math.random() * 0.5 + 0.3;
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
            ctx.fillStyle = this.color;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
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
        for (let i = 0; i < 50; i++) {
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
                    ctx.globalAlpha = (100 - distance) / 100 * 0.3;
                    ctx.strokeStyle = '#ffffff';
                    ctx.lineWidth = 1;
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

    console.log('Component mounted, hero images:', heroImages);
    console.log('First image src:', heroImages[0]?.src);
    console.log('First image src length:', heroImages[0]?.src?.length);

    // Preload images for smooth transitions
    heroImages.forEach((image, index) => {
        console.log(`Loading image ${index + 1}:`, image.src);
        console.log(`Image ${index + 1} src length:`, image.src?.length);
        const img = new Image();
        img.onload = () => console.log(`Image ${index + 1} loaded successfully:`, image.src);
        img.onerror = () => console.error(`Image ${index + 1} failed to load:`, image.src);
        img.src = image.src;
    });

    // Count up animation for stats
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalValue = parseInt(target.getAttribute('data-target'));
                const duration = 2000; // 2 seconds
                const increment = finalValue / (duration / 16); // 60fps
                let currentValue = 0;

                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        currentValue = finalValue;
                        clearInterval(timer);
                    }
                    target.textContent = Math.floor(currentValue) + (finalValue === 10 ? 'K' : '+');
                }, 16);
            }
        });
    }, observerOptions);

    // Observe all count-up elements
    document.querySelectorAll('.animate-count-up').forEach(el => {
        observer.observe(el);
    });

        // Particle System
    initParticleSystem();

    // Calculate progress based on database data
    calculateProgress();


});

// Function to calculate progress based on database structure
function calculateProgress() {
    // These would normally come from API calls to your Laravel backend
    // For now, we'll simulate realistic progress based on typical museum data

    // Digital Progress: Based on collections table
    // Assuming target is 200 collections, current is 150
    digitalProgress.value = Math.round((150 / 200) * 100);

    // Category Progress: Based on categories table
    // Assuming target is 30 categories, current is 24 active categories
    categoryProgress.value = Math.round((24 / 30) * 100);

    // Featured Progress: Based on featured collections
    // Assuming target is 100 featured items, current is 60
    featuredProgress.value = Math.round((60 / 100) * 100);

    // Update recent activities based on database events
    updateRecentActivities();
}

function updateRecentActivities() {
    // This would normally fetch from visits table and collections table
    // For now, we'll use realistic data based on typical museum statistics

    // Calculate today's new collections (from collections table where created_at = today)
    const newCollections = Math.floor(Math.random() * 10) + 3; // 3-12 new collections

    // Calculate today's visitors (from visits table where created_at = today)
    const todayVisitors = Math.floor(Math.random() * 500) + 800; // 800-1300 visitors

    // Calculate featured updates (from collections table where is_featured = true and updated_at = today)
    const featuredUpdates = Math.floor(Math.random() * 3) + 3; // 3-5 featured updates

    recentActivities.value = [
        {
            type: 'collection',
            message: `+${newCollections} koleksi baru ditambahkan`,
            color: 'emerald'
        },
        {
            type: 'visit',
            message: `${todayVisitors} pengunjung hari ini`,
            color: 'blue'
        },
        {
            type: 'featured',
            message: `${featuredUpdates} koleksi unggulan diperbarui`,
            color: 'purple'
        }
    ];

    // Update quick stats based on realistic data
    updateQuickStats();
}

function updateQuickStats() {
    // These would normally be calculated from database queries:
    // - Average daily visits: SELECT AVG(daily_count) FROM visits_summary
    // - Most popular collection: SELECT name FROM collections ORDER BY view_count DESC LIMIT 1
    // - User rating: Average rating from user feedback (if implemented)

    const avgVisits = Math.floor(Math.random() * 500) + 2200; // 2200-2700 avg visits
    const popularCollections = ['Batik Klasik', 'Artefak Majapahit', 'Keris Pusaka', 'Wayang Kulit'];
    const popularCollection = popularCollections[Math.floor(Math.random() * popularCollections.length)];
    const userRating = (4.5 + Math.random() * 0.5).toFixed(1); // 4.5-5.0 rating

    quickStats.value = {
        avgVisits: `${avgVisits.toLocaleString()}/hari`,
        popularCollection: popularCollection,
        userRating: `${userRating}/5.0`
    };
}



onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <Head title="BDARU - Museum Digital Balai Adat Rajo Penghulu" />

    <div class="min-h-screen bg-gray-50">
                                        <!-- Modern Fixed Navigation Bar -->
        <div class="fixed top-0 left-0 right-0 bg-gradient-to-r from-slate-900/95 via-blue-900/95 to-indigo-900/95 backdrop-blur-xl border-b border-white/10 z-50">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <!-- Modern Logo Section -->
                    <div class="flex items-center group">
                        <div class="flex-shrink-0 relative">
                            <div class="flex items-center space-x-4">
                                <!-- Modern Logo Icon -->
                                <div class="relative">
                                    <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 via-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden">
                                        <!-- Museum Building Icon -->
                                        <div class="w-10 h-8 bg-white/95 rounded-lg relative">
                                            <!-- Building Structure -->
                                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-purple-600"></div>
                                            <div class="absolute top-2 left-1 right-1 h-1 bg-gray-800"></div>
                                            <div class="absolute top-4 left-1 right-1 h-1 bg-gray-800"></div>
                                            <!-- Windows -->
                                            <div class="absolute top-1 left-1 w-1 h-1 bg-yellow-400 rounded-sm"></div>
                                            <div class="absolute top-1 right-1 w-1 h-1 bg-yellow-400 rounded-sm"></div>
                                            <div class="absolute top-3 left-1 w-1 h-1 bg-blue-400 rounded-sm"></div>
                                            <div class="absolute top-3 right-1 w-1 h-1 bg-blue-400 rounded-sm"></div>
                                            <!-- Door -->
                                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-700 rounded-t-sm"></div>
                                        </div>
                                        <!-- Glow Effect -->
                                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/20 to-orange-500/20 rounded-2xl blur-sm group-hover:blur-md transition-all duration-500"></div>
                                    </div>
                                    <!-- Floating Particles -->
                                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-yellow-400 rounded-full animate-ping"></div>
                                    <div class="absolute -bottom-1 -left-1 w-1 h-1 bg-orange-400 rounded-full animate-ping delay-1000"></div>
                                </div>

                                <!-- Modern Typography -->
                                <div class="flex flex-col">
                                    <h1 class="text-3xl font-black bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 bg-clip-text text-transparent group-hover:scale-105 transition-transform duration-300">
                                        BDARU
                                    </h1>
                                    <p class="text-xs text-gray-300 font-medium tracking-wider uppercase opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                                        Museum Digital Balai Adat Rajo Penghulu
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Auth Buttons -->
                    <div class="flex items-center space-x-4">
                        <Link
                            v-if="canLogin"
                            :href="route('login')"
                            class="group relative px-8 py-3 text-white font-bold rounded-xl border-2 border-white/20 hover:border-yellow-400/50 hover:text-yellow-400 transition-all duration-300 overflow-hidden backdrop-blur-md"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Login</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="group relative px-8 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 text-black font-bold rounded-xl shadow-2xl hover:shadow-yellow-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 overflow-hidden"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                <span>Register</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-600 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrollable Navigation Menu -->
        <div class="w-full mt-20">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="flex justify-center items-center py-4">
                    <div class="flex items-center space-x-8">
                        <Link
                            href="/"
                            class="relative px-3 py-2 text-blue-600 font-semibold transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                <span>Beranda</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg"></div>
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
                        </Link>
                        <Link
                            href="/collections"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <span>Koleksi Budaya</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/news"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <span>Berita Terbaru</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/agenda"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Agenda Kegiatan</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/contact"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>Kontak Kami</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/about"
                            class="relative px-3 py-2 text-gray-700 font-medium rounded-lg hover:text-blue-600 transition-all duration-300 group"
                        >
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Profil Kami</span>
                            </span>
                            <div class="absolute inset-0 bg-blue-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

                <!-- Hero Section -->
        <section class="relative py-20 lg:py-32 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
                        <!-- Particle System Canvas -->
            <canvas id="particleCanvas" class="absolute inset-0 w-full h-full pointer-events-none"></canvas>

            <!-- Animated Background Elements -->
            <div class="absolute inset-0">
                <!-- Floating Orbs -->
                <div class="absolute top-0 left-0 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-float-slow"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float-medium"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl animate-float-fast"></div>

                <!-- Particle Effects -->
                <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-yellow-400 rounded-full animate-ping"></div>
                <div class="absolute top-3/4 right-1/4 w-1 h-1 bg-emerald-400 rounded-full animate-ping delay-1000"></div>
                <div class="absolute bottom-1/4 left-3/4 w-1.5 h-1.5 bg-orange-400 rounded-full animate-ping delay-2000"></div>

                <!-- Geometric Shapes -->
                <div class="absolute top-1/3 right-1/3 w-8 h-8 border border-white/20 rotate-45 animate-spin-slow"></div>
                <div class="absolute bottom-1/3 left-1/3 w-6 h-6 border border-yellow-400/30 rotate-45 animate-spin-medium"></div>
            </div>

            <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
                    <!-- Left Content -->
                    <div class="w-full lg:w-1/2 text-white text-center lg:text-left">
                        <!-- Badge -->
                        <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20 mb-8 group hover:bg-white/20 transition-all duration-300 animate-fade-in-up">
                            <div class="w-2 h-2 bg-emerald-400 rounded-full mr-3 animate-pulse"></div>
                            <span class="text-sm font-medium text-white">Museum Digital Balai Adat Rajo Penghulu</span>
                        </div>

                        <!-- Main Heading -->
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight animate-fade-in-up delay-200">
                            <span class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 bg-clip-text text-transparent animate-gradient">
                                BDARU
                            </span>
                        </h1>

                        <!-- Subtitle -->
                        <p class="text-lg md:text-xl mb-8 leading-relaxed text-gray-300 font-light max-w-2xl mx-auto lg:mx-0 animate-fade-in-up delay-400">
                            Jelajahi kekayaan budaya Indonesia melalui
                            <span class="font-semibold text-yellow-400">teknologi digital</span> yang inovatif.
                            Temukan warisan budaya dalam format yang modern dan interaktif.
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fade-in-up delay-600">
                            <Link
                                href="/collections"
                                class="group relative px-8 py-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-black font-bold rounded-xl shadow-2xl hover:shadow-yellow-500/25 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 overflow-hidden animate-bounce-subtle"
                            >
                                <span class="relative z-10 flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5 animate-wiggle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Jelajahi Koleksi
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-yellow-600 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </Link>
                            <Link
                                href="/about"
                                class="group relative px-8 py-4 border-2 border-white/30 text-white font-bold rounded-xl backdrop-blur-md hover:bg-white/10 hover:border-white/50 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                            >
                                <span class="relative z-10 flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tentang Kami
                                </span>
                            </Link>
                        </div>

                        <!-- Stats -->
                        <div class="flex justify-center lg:justify-start gap-8 mt-12 animate-fade-in-up delay-800">
                            <div class="text-center group hover:scale-110 transition-transform duration-300">
                                <div class="text-2xl font-bold text-yellow-400 animate-count-up" data-target="150">0</div>
                                <div class="text-sm text-gray-400">Koleksi Digital</div>
                            </div>
                            <div class="text-center group hover:scale-110 transition-transform duration-300">
                                <div class="text-2xl font-bold text-emerald-400 animate-count-up" data-target="25">0</div>
                                <div class="text-sm text-gray-400">Kategori</div>
                            </div>
                            <div class="text-center group hover:scale-110 transition-transform duration-300">
                                <div class="text-2xl font-bold text-blue-400 animate-count-up" data-target="10">0</div>
                                <div class="text-sm text-gray-400">K Pengunjung</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Image Slider -->
                    <div class="w-full lg:w-1/2 animate-fade-in-up delay-1000">
                        <div class="relative h-80 lg:h-96 rounded-2xl overflow-hidden shadow-2xl bg-gray-200 group animate-float-subtle">
                            <!-- Glow Effect -->
                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/20 to-orange-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>

                            <Swiper
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
                                            :src="image.src"
                                            :alt="image.alt"
                                            class="w-full h-full object-cover absolute inset-0 transition-transform duration-700 group-hover:scale-110"
                                            @error="handleImageError"
                                            @load="handleImageLoad"
                                            loading="eager"
                                            decoding="async"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                                        <!-- Image Title Overlay -->
                                        <div class="absolute bottom-6 left-6 right-6 z-10">
                                            <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/20 transform transition-all duration-500 hover:bg-white/20">
                                                <h3 class="text-white font-bold text-lg mb-1">{{ image.title }}</h3>
                                                <p class="text-white/90 text-sm">{{ image.subtitle }}</p>
                                                <p class="text-white/70 text-xs mt-2">{{ image.description }}</p>
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

        <!-- Stats Section -->
        <section class="py-24 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 relative overflow-hidden">
            <!-- Professional Animated Background -->
            <div class="absolute inset-0">
                <!-- Geometric Patterns -->
                <div class="absolute top-10 left-10 w-32 h-32 border border-blue-400/20 rotate-45 animate-spin-slow"></div>
                <div class="absolute top-20 right-20 w-24 h-24 border border-purple-400/20 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-lg rotate-12 animate-float-subtle"></div>
                <div class="absolute bottom-10 right-1/3 w-20 h-20 border border-emerald-400/20 rotate-12 animate-spin-medium"></div>

                <!-- Data Flow Lines -->
                <div class="absolute inset-0 opacity-20">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="flowGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.3" />
                                <stop offset="50%" style="stop-color:#8b5cf6;stop-opacity:0.2" />
                                <stop offset="100%" style="stop-color:#10b981;stop-opacity:0.3" />
                            </linearGradient>
                        </defs>
                        <path d="M0,50 Q25,30 50,50 T100,50" stroke="url(#flowGradient)" stroke-width="0.5" fill="none" class="animate-pulse">
                            <animate attributeName="d" dur="8s" repeatCount="indefinite"
                                values="M0,50 Q25,30 50,50 T100,50;M0,50 Q25,70 50,50 T100,50;M0,50 Q25,30 50,50 T100,50"/>
                        </path>
                        <path d="M0,30 Q25,50 50,30 T100,30" stroke="url(#flowGradient)" stroke-width="0.3" fill="none" class="animate-pulse delay-1000">
                            <animate attributeName="d" dur="6s" repeatCount="indefinite"
                                values="M0,30 Q25,50 50,30 T100,30;M0,30 Q25,10 50,30 T100,30;M0,30 Q25,50 50,30 T100,30"/>
                        </path>
                        <path d="M0,70 Q25,90 50,70 T100,70" stroke="url(#flowGradient)" stroke-width="0.3" fill="none" class="animate-pulse delay-2000">
                            <animate attributeName="d" dur="10s" repeatCount="indefinite"
                                values="M0,70 Q25,90 50,70 T100,70;M0,70 Q25,50 50,70 T100,70;M0,70 Q25,90 50,70 T100,70"/>
                        </path>
                    </svg>
                </div>
            </div>



            <div class="relative z-10 w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-md rounded-full border border-white/20 mb-8 group hover:bg-white/20 transition-all duration-300">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full mr-3 animate-pulse"></div>
                        <span class="text-sm font-medium text-white">Pencapaian Museum Digital</span>
                    </div>

                    <h2 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 bg-clip-text text-transparent animate-gradient">
                            Statistik Museum
                        </span>
                    </h2>

                    <p class="text-xl md:text-2xl text-gray-300 font-light max-w-4xl mx-auto leading-relaxed">
                        Pencapaian kami dalam melestarikan dan mendigitalisasi kekayaan budaya Indonesia
                        <span class="font-semibold text-yellow-400">melalui teknologi modern</span>
                    </p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                    <!-- Koleksi Digital -->
                    <div class="group relative bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10 hover:bg-white/10 hover:border-white/30 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>

                        <div class="relative z-10">
                            <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>

                            <div class="text-center">
                                <div class="text-4xl md:text-5xl font-black mb-2 text-yellow-400 animate-count-up" data-target="150">0</div>
                                <div class="text-white font-bold text-lg mb-2">Koleksi Digital</div>
                                <div class="text-gray-400 text-sm">Artefak & Seni Budaya</div>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori Budaya -->
                    <div class="group relative bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10 hover:bg-white/10 hover:border-white/30 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>

                        <div class="relative z-10">
                            <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>

                            <div class="text-center">
                                <div class="text-4xl md:text-5xl font-black mb-2 text-emerald-400 animate-count-up" data-target="25">0</div>
                                <div class="text-white font-bold text-lg mb-2">Kategori Budaya</div>
                                <div class="text-gray-400 text-sm">Seni, Arkeologi, Tekstil</div>
                            </div>
                        </div>
                    </div>

                    <!-- Kunjungan -->
                    <div class="group relative bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10 hover:bg-white/10 hover:border-white/30 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>

                        <div class="relative z-10">
                            <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>

                            <div class="text-center">
                                <div class="text-4xl md:text-5xl font-black mb-2 text-blue-400 animate-count-up" data-target="10">0</div>
                                <div class="text-white font-bold text-lg mb-2">K Kunjungan</div>
                                <div class="text-gray-400 text-sm">Pengunjung Digital</div>
                            </div>
                        </div>
                    </div>

                    <!-- Koleksi Unggulan -->
                    <div class="group relative bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10 hover:bg-white/10 hover:border-white/30 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>

                        <div class="relative z-10">
                            <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>

                            <div class="text-center">
                                <div class="text-4xl md:text-5xl font-black mb-2 text-purple-400 animate-count-up" data-target="50">0</div>
                                <div class="text-white font-bold text-lg mb-2">Koleksi Unggulan</div>
                                <div class="text-gray-400 text-sm">Masterpiece Digital</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Progress Bar -->
                    <div class="data-card stats-card bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10">
                        <h3 class="text-xl font-bold text-white mb-6">Progress Digitalisasi</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm text-gray-300 mb-2">
                                    <span>Koleksi Digital</span>
                                    <span>{{ digitalProgress }}%</span>
                                </div>
                                <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden">
                                    <div class="progress-bar h-2 rounded-full" :style="{ '--progress-width': digitalProgress + '%', width: digitalProgress + '%' }"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm text-gray-300 mb-2">
                                    <span>Kategori Aktif</span>
                                    <span>{{ categoryProgress }}%</span>
                                </div>
                                <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden">
                                    <div class="progress-bar h-2 rounded-full" :style="{ '--progress-width': categoryProgress + '%', width: categoryProgress + '%' }"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm text-gray-300 mb-2">
                                    <span>Koleksi Unggulan</span>
                                    <span>{{ featuredProgress }}%</span>
                                </div>
                                <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden">
                                    <div class="progress-bar h-2 rounded-full" :style="{ '--progress-width': featuredProgress + '%', width: featuredProgress + '%' }"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="data-card stats-card bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10">
                        <h3 class="text-xl font-bold text-white mb-6">Aktivitas Terbaru</h3>
                        <div class="space-y-4">
                            <div v-for="activity in recentActivities" :key="activity.type" class="flex items-center space-x-3">
                                <div :class="`w-2 h-2 bg-${activity.color}-400 rounded-full animate-pulse`"></div>
                                <span class="text-gray-300 text-sm">{{ activity.message }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="data-card stats-card bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10">
                        <h3 class="text-xl font-bold text-white mb-6">Statistik Cepat</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300 text-sm">Rata-rata Kunjungan</span>
                                <span class="text-white font-bold">{{ quickStats.avgVisits }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300 text-sm">Koleksi Terpopuler</span>
                                <span class="text-white font-bold">{{ quickStats.popularCollection }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300 text-sm">Rating Pengguna</span>
                                <span class="text-white font-bold">{{ quickStats.userRating }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Collections Section -->
        <section class="py-24 bg-white">
            <div class="w-full lg:w-4/5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-6">
                        🏆 Koleksi Terbaik
                    </div>
                    <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-8">
                        Koleksi <span class="text-blue-600">Unggulan</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Pilihan koleksi terbaik yang menampilkan keindahan dan kekayaan budaya Indonesia
                        dalam format digital yang modern dan interaktif.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100">
                        <div class="relative h-72 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <div class="absolute inset-0 bg-black/30"></div>
                            <div class="relative z-10 text-white text-center p-6">
                                <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center border border-white/30">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold bg-white/20 px-4 py-2 rounded-full border border-white/30">
                                    Seni Rupa
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-blue-600 transition-colors">
                                Lukisan Klasik Indonesia
                            </h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Koleksi lukisan klasik yang menggambarkan keindahan alam dan budaya Indonesia dari berbagai era.
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                                    1800-1950
                                </span>
                                <Link href="/collections/lukisan-klasik" class="text-blue-600 hover:text-blue-800 font-bold text-sm">
                                    Lihat Detail →
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100">
                        <div class="relative h-72 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                            <div class="absolute inset-0 bg-black/30"></div>
                            <div class="relative z-10 text-white text-center p-6">
                                <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center border border-white/30">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold bg-white/20 px-4 py-2 rounded-full border border-white/30">
                                    Arkeologi
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-green-600 transition-colors">
                                Artefak Kuno Nusantara
                            </h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Peninggalan arkeologi yang menceritakan sejarah panjang peradaban Indonesia.
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                                    Pra-Sejarah
                                </span>
                                <Link href="/collections/artefak-kuno" class="text-green-600 hover:text-green-800 font-bold text-sm">
                                    Lihat Detail →
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100">
                        <div class="relative h-72 bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center">
                            <div class="absolute inset-0 bg-black/30"></div>
                            <div class="relative z-10 text-white text-center p-6">
                                <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center border border-white/30">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold bg-white/20 px-4 py-2 rounded-full border border-white/30">
                                    Tekstil
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-red-600 transition-colors">
                                Batik Tradisional
                            </h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Koleksi batik tradisional dari berbagai daerah yang menampilkan keunikan motif dan filosofi.
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 font-semibold bg-gray-100 px-3 py-1 rounded-full">
                                    Tradisional
                                </span>
                                <Link href="/collections/batik-tradisional" class="text-red-600 hover:text-red-800 font-bold text-sm">
                                    Lihat Detail →
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-blue-900 text-white">
            <div class="w-full lg:w-4/5 mx-auto text-center px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full border border-white/30 mb-6">
                        <span class="text-sm font-medium text-white">🚀 Mulai Petualangan Budaya</span>
                    </div>
                </div>

                <h2 class="text-5xl md:text-7xl font-black mb-8">
                    Siap Jelajahi <span class="text-yellow-400">Budaya Indonesia</span>?
                </h2>
                <p class="text-xl md:text-2xl text-blue-100 mb-12 leading-relaxed max-w-4xl mx-auto">
                    Bergabunglah dengan ribuan pengunjung yang telah menemukan kekayaan budaya Indonesia
                    melalui platform digital kami yang inovatif dan modern.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <Link
                        href="/collections"
                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-12 py-5 rounded-full font-black text-lg transform hover:scale-105 transition-all duration-300 shadow-2xl"
                    >
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Mulai Jelajahi
                        </span>
                    </Link>
                    <Link
                        href="/contact"
                        class="border-2 border-white text-white px-12 py-5 rounded-full font-black text-lg hover:bg-white hover:text-blue-900 transition-all duration-300"
                    >
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Hubungi Kami
                        </span>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="w-full lg:w-4/5 mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Museum BDARU</h3>
                        <p class="text-gray-300">
                            Pusat dokumentasi dan pelestarian budaya Indonesia yang berkomitmen untuk melestarikan warisan budaya bangsa.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <div class="space-y-2 text-gray-300">
                            <p>Jl. Budaya No. 123, Jakarta</p>
                            <p>Email: info@bdaru.com</p>
                            <p>Telp: (021) 1234-5678</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Jam Operasional</h3>
                        <div class="space-y-2 text-gray-300">
                            <p>Senin - Jumat: 09:00 - 17:00</p>
                            <p>Sabtu - Minggu: 10:00 - 18:00</p>
                            <p>Hari Libur Nasional: Tutup</p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-300">
                    <p>&copy; 2024 Museum BDARU. All rights reserved.</p>
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

@keyframes float-subtle {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
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
    animation: float-subtle 3s ease-in-out infinite;
}

/* Spinning animations */
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes spin-medium {
    from { transform: rotate(0deg); }
    to { transform: rotate(-360deg); }
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}

.animate-spin-medium {
    animation: spin-medium 15s linear infinite;
}

/* Fade in animations */
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

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
}

.delay-200 {
    animation-delay: 0.2s;
}

.delay-400 {
    animation-delay: 0.4s;
}

.delay-600 {
    animation-delay: 0.6s;
}

.delay-800 {
    animation-delay: 0.8s;
}

.delay-1000 {
    animation-delay: 1s;
}

/* Bounce and wiggle animations */
@keyframes bounce-subtle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

@keyframes wiggle {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(5deg); }
    75% { transform: rotate(-5deg); }
}

.animate-bounce-subtle {
    animation: bounce-subtle 2s ease-in-out infinite;
}

.animate-wiggle {
    animation: wiggle 1s ease-in-out infinite;
}

/* Count up animation */
@keyframes count-up {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
}

.animate-count-up {
    animation: count-up 0.5s ease-out forwards;
}

/* Professional Progress Bar Animations */
@keyframes progress-fill {
    from { width: 0%; }
    to { width: var(--progress-width); }
}

@keyframes data-pulse {
    0%, 100% { opacity: 0.6; }
    50% { opacity: 1; }
}

@keyframes chart-grow {
    from { transform: scaleY(0); }
    to { transform: scaleY(1); }
}

.progress-bar {
    background: linear-gradient(90deg, #3b82f6, #8b5cf6, #10b981);
    background-size: 200% 100%;
    animation: progress-fill 2s ease-out forwards, data-pulse 3s ease-in-out infinite;
}

.data-card {
    backdrop-filter: blur(20px);
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.data-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border-color: rgba(59, 130, 246, 0.3);
}

.chart-bar {
    transform-origin: bottom;
    animation: chart-grow 1.5s ease-out forwards;
}

/* Professional Data Flow Animation */
@keyframes data-flow {
    0% { stroke-dashoffset: 1000; }
    100% { stroke-dashoffset: 0; }
}

.data-flow-path {
    stroke-dasharray: 1000;
    stroke-dashoffset: 1000;
    animation: data-flow 8s ease-in-out infinite;
}

/* Professional Hover Effects */
.stats-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.stats-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
}

/* Professional Loading Animation */
@keyframes shimmer {
    0% { background-position: -200px 0; }
    100% { background-position: calc(200px + 100%) 0; }
}

.shimmer {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200px 100%;
    animation: shimmer 2s infinite;
}
</style>
