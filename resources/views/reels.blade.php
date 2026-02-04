<x-app-layout>
    <div class="flex min-h-screen bg-black text-white">
        <!-- Middle Column: Reels Player -->
        <div class="flex-1 w-full flex justify-center py-4">
            <div class="relative w-full max-w-[400px] h-[calc(100vh-2rem)] bg-zinc-900 rounded-xl overflow-hidden flex flex-col shadow-2xl">
                <!-- Video Container -->
                <div class="relative flex-1 bg-black flex items-center justify-center">
                    <video src="https://videos.pexels.com/video-files/5750033/5750033-hd_1080_1920_30fps.mp4" loop autoplay muted class="w-full h-full object-cover opacity-80"></video>
                    
                    <!-- Overlay Controls/Info -->
                    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/60 flex flex-col justify-between p-4">
                        <div class="flex justify-between items-start">
                           <h2 class="font-bold text-lg drop-shadow-md">Reels</h2>
                           <button class="material-symbols-outlined text-white drop-shadow-md">camera_alt</button>
                        </div>
                        
                        <div class="space-y-3 pb-8">
                             <!-- Audio -->
                            <div class="flex items-center gap-2 text-sm font-medium">
                                <span class="material-symbols-outlined text-[16px]">music_note</span>
                                <span class="marquee">Original Audio - User Name</span>
                            </div>

                            <!-- User Info -->
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-full border border-white p-0.5">
                                    <img src="https://ui-avatars.com/api/?name=User&background=random" class="w-full h-full rounded-full object-cover">
                                </div>
                                <div class="flex items-center gap-2">
                                     <span class="font-bold text-sm">user_name</span>
                                     <button class="bg-transparent border border-white/50 text-white text-xs font-bold px-3 py-1 rounded-lg backdrop-blur-sm">Follow</button>
                                </div>
                            </div>
                            
                            <!-- Caption -->
                            <p class="text-sm text-gray-200 line-clamp-2">
                                Exploring the new horizons! 🌍✈️ #travel #wanderlust #nature
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Actions (Floating outside or inside) -->
                <!-- Ideally floating right next to video -->
                <div class="absolute bottom-20 right-4 flex flex-col gap-6 items-center z-10">
                    <div class="flex flex-col items-center gap-1 group cursor-pointer">
                        <span class="material-symbols-outlined text-3xl drop-shadow-md transition-transform group-hover:scale-125">favorite</span>
                        <span class="text-xs font-bold drop-shadow-md">12.5K</span>
                    </div>
                     <div class="flex flex-col items-center gap-1 group cursor-pointer">
                        <span class="material-symbols-outlined text-3xl drop-shadow-md transition-transform group-hover:scale-125">chat_bubble</span>
                        <span class="text-xs font-bold drop-shadow-md">342</span>
                    </div>
                     <div class="flex flex-col items-center gap-1 group cursor-pointer">
                        <span class="material-symbols-outlined text-3xl drop-shadow-md transition-transform group-hover:scale-125">send</span>
                    </div>
                    <div class="flex flex-col items-center gap-1 group cursor-pointer mt-2">
                        <span class="material-symbols-outlined text-3xl drop-shadow-md">more_horiz</span>
                    </div>
                </div>
            </div>
            
            <!-- Up/Down Navigation Buttons (Desktop) -->
            <div class="hidden lg:flex flex-col justify-center gap-4 ml-8">
                <button class="p-3 bg-zinc-800 rounded-full hover:bg-zinc-700 transition-colors text-white">
                    <span class="material-symbols-outlined">arrow_upward</span>
                </button>
                <button class="p-3 bg-zinc-800 rounded-full hover:bg-zinc-700 transition-colors text-white">
                    <span class="material-symbols-outlined">arrow_downward</span>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
