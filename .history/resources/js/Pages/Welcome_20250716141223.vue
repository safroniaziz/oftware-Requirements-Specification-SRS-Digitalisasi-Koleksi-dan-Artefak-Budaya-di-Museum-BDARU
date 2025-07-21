<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    auth: Object,
});

onMounted(() => {
    // Counter animation
    const counters = document.querySelectorAll('.counter');
    const animateCounters = () => {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const count = parseInt(counter.innerText);
            const increment = target / 200;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(animateCounters, 1);
            } else {
                counter.innerText = target;
            }
        });
    };

    // Start counter animation when element is in view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.querySelector('.stat-card');
    if (statsSection) {
        observer.observe(statsSection);
    }

    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Parallax effect for hero section
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            heroSection.style.transform = `translateY(${rate}px)`;
        });
    }

    // Add typing effect to hero title
    const heroTitle = document.querySelector('.hero-title');
    if (heroTitle) {
        const text = heroTitle.textContent;
        heroTitle.textContent = '';
        let i = 0;
        const typeWriter = () => {
            if (i < text.length) {
                heroTitle.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        };
        setTimeout(typeWriter, 1000);
    }

    // Add particle effect
    createParticles();
});

// Particle effect function
const createParticles = () => {
    const particleContainer = document.querySelector('.particle-container');
    if (!particleContainer) return;

    for (let i = 0; i < 50; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 20 + 's';
        particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
        particleContainer.appendChild(particle);
    }
};

const startVirtualTour = () => {
    // Add virtual tour functionality
    alert('Virtual tour feature coming soon!');
};

const exploreCollections = () => {
    // Add collections exploration functionality
    alert('Collections exploration feature coming soon!');
};
</script>

<template>
    <Head title="Welcome" />

    <!-- Hero Section with Parallax -->
    <div class="hero-section relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-dots-pattern opacity-20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
        </div>

        <!-- Particle Container -->
        <div class="particle-container absolute inset-0 overflow-hidden"></div>

        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="floating-element absolute top-20 left-10 w-4 h-4 bg-blue-400 rounded-full opacity-30 animate-pulse"></div>
            <div class="floating-element absolute top-40 right-20 w-6 h-6 bg-purple-400 rounded-full opacity-20 animate-bounce"></div>
            <div class="floating-element absolute bottom-40 left-20 w-3 h-3 bg-green-400 rounded-full opacity-40 animate-ping"></div>
            <div class="floating-element absolute bottom-20 right-10 w-5 h-5 bg-yellow-400 rounded-full opacity-25 animate-spin"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-10 px-6 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 12a2 2 0 114 0 2 2 0 01-4 0z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-white">BDARU</span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#about" class="text-gray-300 hover:text-white transition-colors duration-300">About</a>
                    <a href="#collections" class="text-gray-300 hover:text-white transition-colors duration-300">Collections</a>
                    <a href="#news" class="text-gray-300 hover:text-white transition-colors duration-300">News</a>
                    <a href="#contact" class="text-gray-300 hover:text-white transition-colors duration-300">Contact</a>
                </div>

                <div class="flex items-center space-x-4">
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-gray-300 hover:text-white transition-colors duration-300">
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link :href="route('login')" class="text-gray-300 hover:text-white transition-colors duration-300">
                            Log in
                        </Link>
                        <Link :href="route('register')" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                            Get Started
                        </Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="relative z-10 flex items-center justify-center min-h-screen px-6">
            <div class="text-center max-w-4xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-pulse">
                            Digital Museum
                        </span>
                        <br>
                        <span class="text-4xl md:text-6xl">of the Future</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8 leading-relaxed">
                        Experience art, history, and culture through cutting-edge digital technology.
                        Explore our vast collection of artifacts, artworks, and historical treasures
                        from anywhere in the world.
                    </p>
                </div>

                <!-- Interactive Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="stat-card group">
                        <div class="text-4xl font-bold text-blue-400 mb-2 group-hover:text-blue-300 transition-colors duration-300">
                            <span class="counter" data-target="10000">0</span>+
                        </div>
                        <div class="text-gray-400">Digital Artifacts</div>
                    </div>
                    <div class="stat-card group">
                        <div class="text-4xl font-bold text-purple-400 mb-2 group-hover:text-purple-300 transition-colors duration-300">
                            <span class="counter" data-target="500">0</span>+
                        </div>
                        <div class="text-gray-400">Virtual Exhibitions</div>
                    </div>
                    <div class="stat-card group">
                        <div class="text-4xl font-bold text-pink-400 mb-2 group-hover:text-pink-300 transition-colors duration-300">
                            <span class="counter" data-target="50000">0</span>+
                        </div>
                        <div class="text-gray-400">Monthly Visitors</div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button @click="startVirtualTour" class="group bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center space-x-2">
                        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Start Virtual Tour</span>
                    </button>
                    <button @click="exploreCollections" class="group border-2 border-white/30 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white/10 transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                        </svg>
                        <span>Explore Collections</span>
                    </button>
                </div>

                <!-- Scroll Indicator -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <svg class="w-6 h-6 text-white/50" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Welcome to <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">BDARU</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    BDARU Digital Museum is a revolutionary platform that brings the world's most precious artifacts
                    and artworks to your fingertips through immersive digital experiences.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card group">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Authentic Experience</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Every digital artifact is meticulously scanned and preserved in ultra-high resolution,
                        ensuring you experience the same level of detail as viewing the original.
                    </p>
                </div>

                <div class="feature-card group">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Global Access</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Access our collections from anywhere in the world, 24/7. No travel required,
                        no admission fees, just pure cultural exploration at your convenience.
                    </p>
                </div>

                <div class="feature-card group">
                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Interactive Learning</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Engage with artifacts through interactive features, detailed descriptions,
                        and educational content that brings history and culture to life.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Collections Section -->
    <section id="collections" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Featured <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Collections</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Discover our most popular and recently added collections from around the world.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="collection-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-6">
                        <div class="w-full h-64 bg-gradient-to-br from-blue-400 to-purple-600 group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white text-xl font-bold mb-2">Ancient Civilizations</h3>
                            <p class="text-white/80 text-sm">Explore artifacts from Egypt, Greece, Rome, and more</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">2,500+ artifacts</span>
                        <button class="text-blue-600 hover:text-blue-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                            Explore →
                        </button>
                    </div>
                </div>

                <div class="collection-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-6">
                        <div class="w-full h-64 bg-gradient-to-br from-green-400 to-teal-600 group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white text-xl font-bold mb-2">Modern Art</h3>
                            <p class="text-white/80 text-sm">Contemporary masterpieces from the 20th century</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">1,800+ pieces</span>
                        <button class="text-blue-600 hover:text-blue-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                            Explore →
                        </button>
                    </div>
                </div>

                <div class="collection-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-6">
                        <div class="w-full h-64 bg-gradient-to-br from-orange-400 to-red-600 group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white text-xl font-bold mb-2">Asian Heritage</h3>
                            <p class="text-white/80 text-sm">Treasures from China, Japan, Korea, and Southeast Asia</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">3,200+ artifacts</span>
                        <button class="text-blue-600 hover:text-blue-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                            Explore →
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                    View All Collections
                </button>
            </div>
        </div>
    </section>

    <!-- News & Updates Section -->
    <section id="news" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Latest <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">News</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Stay updated with our latest exhibitions, new acquisitions, and museum events.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article class="news-card group">
                    <div class="bg-gray-100 rounded-2xl p-6 group-hover:shadow-xl transition-all duration-300">
                        <div class="text-sm text-blue-600 font-semibold mb-3">NEW EXHIBITION</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            Virtual Reality Experience: Ancient Rome
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Step into the past with our new VR exhibition featuring the Colosseum and Roman Forum
                            in stunning 360-degree detail.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">March 15, 2024</span>
                            <button class="text-blue-600 hover:text-blue-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                                Read More →
                            </button>
                        </div>
                    </div>
                </article>

                <article class="news-card group">
                    <div class="bg-gray-100 rounded-2xl p-6 group-hover:shadow-xl transition-all duration-300">
                        <div class="text-sm text-purple-600 font-semibold mb-3">NEW ACQUISITION</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            Rare Ming Dynasty Vase Added
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            We're excited to announce the addition of a rare 15th-century Ming Dynasty vase
                            to our Asian Heritage collection.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">March 10, 2024</span>
                            <button class="text-purple-600 hover:text-purple-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                                Read More →
                            </button>
                        </div>
                    </div>
                </article>

                <article class="news-card group">
                    <div class="bg-gray-100 rounded-2xl p-6 group-hover:shadow-xl transition-all duration-300">
                        <div class="text-sm text-green-600 font-semibold mb-3">EDUCATION</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-300">
                            Interactive Learning Programs
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            New educational programs for schools and universities featuring guided tours
                            and interactive workshops.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">March 5, 2024</span>
                            <button class="text-green-600 hover:text-green-700 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                                Read More →
                            </button>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Get in <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Touch</span>
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Have questions about our collections or want to collaborate? We'd love to hear from you.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-6">Contact Information</h3>
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold">Email</div>
                                <div class="text-gray-300">info@bdaru-museum.com</div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold">Location</div>
                                <div class="text-gray-300">Digital Museum Platform<br>Available Worldwide</div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold">Support</div>
                                <div class="text-gray-300">24/7 Digital Support<br>support@bdaru-museum.com</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-white mb-6">Send us a Message</h3>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-white font-semibold mb-2">First Name</label>
                                <input type="text" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-white font-semibold mb-2">Last Name</label>
                                <input type="text" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        <div>
                            <label class="block text-white font-semibold mb-2">Email</label>
                            <input type="email" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-white font-semibold mb-2">Message</label>
                            <textarea rows="4" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 12a2 2 0 114 0 2 2 0 01-4 0z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">BDARU</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Bringing the world's cultural heritage to your fingertips through innovative digital technology.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Collections</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Ancient Civilizations</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Modern Art</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Asian Heritage</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">European Masters</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Educational Programs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Research Database</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Virtual Tours</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">API Documentation</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors duration-300">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center hover:bg-blue-900 transition-colors duration-300">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center hover:bg-purple-700 transition-colors duration-300">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    © 2024 BDARU Digital Museum. All rights reserved. |
                    <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors duration-300">Privacy Policy</a> |
                    <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors duration-300">Terms of Service</a>
                </p>
            </div>
        </div>
    </footer>
</template>

<style scoped>
.floating-element {
    animation-duration: 3s;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
}

.stat-card {
    @apply bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center hover:bg-white/20 transition-all duration-300 transform hover:scale-105;
}

.feature-card {
    @apply p-8 rounded-2xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2;
}

.collection-card {
    @apply bg-white rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2;
}

.news-card {
    @apply transition-all duration-300 transform hover:-translate-y-2;
}

/* Custom animations */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.floating-element:nth-child(1) { animation-name: float; animation-delay: 0s; }
.floating-element:nth-child(2) { animation-name: float; animation-delay: 1s; }
.floating-element:nth-child(3) { animation-name: float; animation-delay: 2s; }
.floating-element:nth-child(4) { animation-name: float; animation-delay: 3s; }

/* Custom background pattern */
.bg-dots-pattern {
    background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 60px 60px;
}
</style>
