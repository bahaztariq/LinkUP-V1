<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Middle Column: Explore Grid -->
        <div class="flex-1 w-full max-w-[600px] border-r border-gray-100">
            <!-- Search Header -->
            <div class="sticky top-0 bg-white/80 backdrop-blur-md z-30 p-3 border-b border-gray-100">
                <div class="relative group">
                     <span class="absolute left-4 top-3 text-gray-500 group-focus-within:text-blue-500">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </span>
                    <input type="text" placeholder="Search LinkUP" class="w-full bg-gray-100 border-none rounded-full py-2.5 pl-12 pr-4 text-[15px] focus:bg-white focus:ring-2 focus:ring-blue-400 transition-all placeholder-gray-500">
                </div>
            </div>

            <!-- Category Pills -->
            <div class="px-4 py-3 border-b border-gray-100 flex gap-3 overflow-x-auto no-scrollbar">
                @foreach(['For you', 'Trending', 'News', 'Sports', 'Entertainment', 'Tech', 'Art'] as $i => $category)
                <button class="whitespace-nowrap px-4 py-1.5 rounded-full font-bold text-[15px] transition-colors {{ $i === 0 ? 'bg-black text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $category }}
                </button>
                @endforeach
            </div>

            <!-- Media Grid -->
            <div class="grid grid-cols-3 gap-0.5 pb-20">
                 @foreach(range(1, 21) as $i)
                 <div class="relative aspect-square bg-gray-100 group cursor-pointer overflow-hidden">
                    <img src="https://picsum.photos/seed/{{ $i * 123 }}/400/400" alt="Explore Media" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    
                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-4 text-white font-bold">
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined font-fill text-[20px]">favorite</span>
                            <span>{{ rand(100, 2000) }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined font-fill text-[20px]">chat_bubble</span>
                            <span>{{ rand(10, 500) }}</span>
                        </div>
                    </div>

                    <!-- Type Indicator (Video/Gallery) -->
                    @if($i % 3 == 0)
                    <div class="absolute top-2 right-2 text-white drop-shadow-md">
                        <span class="material-symbols-outlined font-fill text-[20px]">movie</span>
                    </div>
                    @elseif($i % 5 == 0)
                    <div class="absolute top-2 right-2 text-white drop-shadow-md">
                        <span class="material-symbols-outlined font-fill text-[20px]">filter_none</span>
                    </div>
                     @endif
                 </div>
                 @endforeach
            </div>
            
            <div class="p-8 text-center">
                 <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
            </div>
        </div>

        <!-- Right Column: Trends (Same as Dashboard) -->
        <div class="hidden lg:block w-[350px] pl-8 py-4 mr-10 relative">
             <div class="sticky top-4 space-y-6">
                <!-- Trends for you -->
                <div class="bg-gray-50 rounded-2xl p-4">
                    <h2 class="font-extrabold text-xl mb-4 text-gray-900 border-b border-gray-200 pb-2">Trends for you</h2>
                    <div class="space-y-4">
                        @foreach(['#LinkUP', 'Startups', 'TailwindCSS', '#Redesign', 'CodingLife'] as $i => $trend)
                        <div class="cursor-pointer hover:bg-gray-100 -mx-4 px-4 py-2 transition-colors">
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Trending in Tech</span>
                                <span class="material-symbols-outlined text-[16px]">more_horiz</span>
                            </div>
                            <div class="font-bold text-sm text-gray-800">{{ $trend }}</div>
                            <div class="text-xs text-gray-500">{{ rand(10, 500) }}K posts</div>
                        </div>
                        @endforeach
                         <button class="text-blue-500 text-sm font-normal mt-2 hover:underline">Show more</button>
                    </div>
                </div>

                <!-- Footer -->
                <nav class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-400 px-2">
                    <a href="#" class="hover:underline">Terms of Service</a>
                    <a href="#" class="hover:underline">Privacy Policy</a>
                    <a href="#" class="hover:underline">Cookie Policy</a>
                    <a href="#" class="hover:underline">Accessibility</a>
                    <a href="#" class="hover:underline">Ads info</a>
                    <span>© 2026 LinkUP</span>
                </nav>
            </div>
        </div>
    </div>
</x-app-layout>
