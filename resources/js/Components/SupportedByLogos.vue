<template>
    <div class="text-center mb-6">
        <h4 class="text-gray-300 text-sm font-semibold mb-4">Didukung Oleh:</h4>
        <div class="flex justify-center items-center space-x-6 md:space-x-8 flex-wrap gap-y-4">
            <!-- Kemdiktisaintek Logo -->
            <div class="flex items-center space-x-2 opacity-70 hover:opacity-100 transition-opacity duration-300">
                <img
                    src="/assets/assets/media/kemdiktisaintek.jpeg"
                    alt="Kemdiktisaintek"
                    class="w-8 h-8 object-contain rounded-lg bg-white/10 p-1"
                    @error="$event.target.style.display='none'"
                />
                <span class="text-gray-400 text-xs hidden sm:inline">Kemendikbud Ristek</span>
            </div>
            
            <!-- Kemdikbud Logo -->
            <div class="flex items-center space-x-2 opacity-70 hover:opacity-100 transition-opacity duration-300">
                <img
                    src="/assets/assets/media/kemdikbud.jpeg"
                    alt="Kemdikbud"
                    class="w-8 h-8 object-contain rounded-lg bg-white/10 p-1"
                    @error="$event.target.style.display='none'"
                />
                <span class="text-gray-400 text-xs hidden sm:inline">DPPM</span>
            </div>
            
            <!-- BIMA Logo -->
            <div class="flex items-center space-x-2 opacity-70 hover:opacity-100 transition-opacity duration-300">
                <img
                    src="/assets/assets/media/bima.jpeg"
                    alt="BIMA"
                    class="w-8 h-8 object-contain rounded-lg bg-white/10 p-1"
                    @error="$event.target.style.display='none'"
                />
                <span class="text-gray-400 text-xs hidden sm:inline">BIMA</span>
            </div>
            
            <!-- UNIB Logo -->
            <div class="flex items-center space-x-2 opacity-70 hover:opacity-100 transition-opacity duration-300">
                <img
                    src="/assets/src/images/logo_unib.png"
                    alt="Universitas Bengkulu"
                    class="w-8 h-8 object-contain rounded-lg bg-white/10 p-1"
                    @error="$event.target.style.display='none'"
                />
                <span class="text-gray-400 text-xs hidden sm:inline">UNIB</span>
            </div>
        </div>
    </div>
</template>

<script setup>
// No props needed for this component
</script> 