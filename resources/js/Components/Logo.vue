<template>
    <div class="relative">
        <div v-if="logoUrl" class="rounded-2xl flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden" :class="sizeClasses">
            <img
                :src="logoUrl"
                :alt="altText"
                class="w-full h-full object-cover rounded-2xl"
                @error="$event.target.style.display='none'; $event.target.nextElementSibling.style.display='flex'"
            />
            <!-- Fallback Icon if image fails to load -->
            <div class="bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden" :class="sizeClasses" style="display: none;">
                <!-- Premium Museum Icon -->
                <div class="bg-white/95 rounded-lg relative" :class="iconSizeClasses">
                    <!-- Premium Building Structure -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-600 to-teal-600"></div>
                    <div class="absolute top-2 left-1 right-1 h-0.5 bg-gray-800"></div>
                    <div class="absolute top-4 left-1 right-1 h-0.5 bg-gray-800"></div>
                    <div v-if="size === 'large'" class="absolute top-6 left-1 right-1 h-0.5 bg-gray-800"></div>
                    <!-- Premium Windows -->
                    <div class="absolute top-1 left-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                    <div class="absolute top-1 right-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                    <div class="absolute top-3 left-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                    <div class="absolute top-3 right-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                    <div v-if="size === 'large'" class="absolute top-5 left-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
                    <div v-if="size === 'large'" class="absolute top-5 right-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
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
        <!-- Default Icon if no logo -->
        <div v-else class="bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-all duration-500 relative overflow-hidden" :class="sizeClasses">
            <!-- Premium Museum Icon -->
            <div class="bg-white/95 rounded-lg relative" :class="iconSizeClasses">
                <!-- Premium Building Structure -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-600 to-teal-600"></div>
                <div class="absolute top-2 left-1 right-1 h-0.5 bg-gray-800"></div>
                <div class="absolute top-4 left-1 right-1 h-0.5 bg-gray-800"></div>
                <div v-if="size === 'large'" class="absolute top-6 left-1 right-1 h-0.5 bg-gray-800"></div>
                <!-- Premium Windows -->
                <div class="absolute top-1 left-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                <div class="absolute top-1 right-1 w-1 h-1 bg-emerald-500 rounded-sm"></div>
                <div class="absolute top-3 left-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                <div class="absolute top-3 right-1 w-1 h-1 bg-teal-500 rounded-sm"></div>
                <div v-if="size === 'large'" class="absolute top-5 left-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
                <div v-if="size === 'large'" class="absolute top-5 right-1 w-1 h-1 bg-cyan-500 rounded-sm"></div>
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
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    logoUrl: {
        type: String,
        default: null,
    },
    altText: {
        type: String,
        default: 'Logo Museum',
    },
    size: {
        type: String,
        default: 'medium', // 'small', 'medium', 'large'
        validator: (value) => ['small', 'medium', 'large'].includes(value),
    },
});

const sizeClasses = computed(() => {
    switch (props.size) {
        case 'small':
            return 'w-8 h-8';
        case 'large':
            return 'w-16 h-16';
        default:
            return 'w-12 h-12';
    }
});

const iconSizeClasses = computed(() => {
    switch (props.size) {
        case 'small':
            return 'w-5 h-4';
        case 'large':
            return 'w-10 h-8';
        default:
            return 'w-8 h-6';
    }
});
</script>
