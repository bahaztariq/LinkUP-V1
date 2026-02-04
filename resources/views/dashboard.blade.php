<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Middle Column: Feed (600px max) -->
        <div class="flex-1 w-full max-w-[600px] border-r border-gray-100">
            <!-- Sticky Header (Tabs) -->
            <div class="sticky top-0 bg-white/80 backdrop-blur-md z-30 border-b border-gray-100">
                <div class="flex">
                    <button class="flex-1 h-[53px] hover:bg-gray-50 flex items-center justify-center transition-colors relative group">
                        <span class="font-bold text-[15px]">For you</span>
                        <div class="absolute bottom-0 h-[4px] w-[56px] bg-[#1DA1F2] rounded-full"></div>
                    </button>
                    <button class="flex-1 h-[53px] hover:bg-gray-50 flex items-center justify-center transition-colors text-gray-500 font-medium text-[15px]">
                        <span>Following</span>
                    </button>
                </div>
            </div>

            <!-- Stories Tray (Instagram Style, Integrated) -->
            <div class="py-4 px-4 border-b border-gray-100 overflow-x-auto no-scrollbar">
                <div class="flex gap-4">
                    <!-- Add Story -->
                     <button class="flex flex-col items-center gap-1 min-w-[72px]">
                        <div class="relative">
                            <div class="w-[60px] h-[60px] rounded-full p-[2px] border-2 border-gray-100">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="w-full h-full rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                @else
                                    <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-gray-400">person</span>
                                    </div>
                                @endif
                            </div>
                            <div class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-[2px] border-2 border-white">
                                <span class="material-symbols-outlined text-white text-[10px] block">add</span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 truncate w-full text-center">Your story</span>
                    </button>

                    <!-- Dummy Stories -->
                    @foreach(range(1, 8) as $i)
                    <button class="flex flex-col items-center gap-1 min-w-[72px]">
                        <div class="w-[64px] h-[64px] rounded-full p-[2px] bg-gradient-to-tr from-yellow-400 to-fuchsia-600">
                            <div class="w-full h-full rounded-full border-2 border-white p-[2px] bg-white">
                                <img class="w-full h-full rounded-full object-cover bg-gray-100" src="https://ui-avatars.com/api/?name=User+{{$i}}&background=random" alt="User {{$i}}" />
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 truncate w-full text-center">user_{{$i}}</span>
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Composer (Twitter Style) -->
            <div class="hidden sm:block px-4 py-3 border-b border-gray-100">
                <div class="flex gap-3">
                     @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="w-10 h-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @else
                         <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="material-symbols-outlined text-gray-400">person</span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="content" placeholder="What's new?" class="w-full border-none focus:ring-0 text-xl placeholder-gray-500 p-2 pl-0" required>
                            <div class="flex justify-between items-center mt-3 border-t border-gray-50 pt-3">
                                <div class="flex gap-2 text-blue-400">
                                    <label class="cursor-pointer p-2 hover:bg-blue-50 rounded-full transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">image</span>
                                        <input type="file" name="image" class="hidden" accept="image/*">
                                    </label>
                                    <label class="cursor-pointer p-2 hover:bg-blue-50 rounded-full transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">gif_box</span>
                                        <input type="file" name="video" class="hidden" accept="video/*">
                                    </label>
                                    <button type="button" class="p-2 hover:bg-blue-50 rounded-full transition-colors"><span class="material-symbols-outlined text-[20px]">sentiment_satisfied</span></button>
                                    <button type="button" class="p-2 hover:bg-blue-50 rounded-full transition-colors"><span class="material-symbols-outlined text-[20px]">location_on</span></button>
                                </div>
                                <button type="submit" class="bg-[#1DA1F2] hover:bg-[#1a91da] text-white font-bold px-4 py-1.5 rounded-full text-sm disabled:opacity-50">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Feed -->
            <div class="pb-20">
                 @forelse($posts as $post)
                    <x-post-card :post="$post" />
                @empty
                    <div class="p-8 text-center text-gray-500">
                        <p>No posts yet. Be the first to share something!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Widgets (Hidden on small screens) -->
        <div class="hidden lg:block w-[350px] pl-8 py-4 mr-10 relative">
             <!-- Search -->
            <div class="sticky top-0 bg-white z-10 pb-4">
                <div class="relative group">
                    <span class="absolute left-4 top-3 text-gray-500 group-focus-within:text-blue-500">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </span>
                    <input type="text" placeholder="Search" class="w-full bg-gray-100 border-none rounded-full py-3 pl-12 pr-4 text-sm focus:bg-white focus:ring-2 focus:ring-blue-400 transition-all placeholder-gray-500">
                </div>
            </div>

            <div class="sticky top-[80px] space-y-6">
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

                <!-- Who to follow -->
                <div class="bg-gray-50 rounded-2xl p-4">
                    <h2 class="font-extrabold text-xl mb-4 text-gray-900">Who to follow</h2>
                    <div class="space-y-4">
                        @foreach($suggestedUsers as $suggestedUser)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('user.show', $suggestedUser->id) }}" class="w-10 h-10 rounded-full bg-white p-0.5">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $suggestedUser->profile_photo_url)
                                        <img class="w-full h-full rounded-full object-cover" src="{{ $suggestedUser->profile_photo_url }}" alt="{{ $suggestedUser->name }}" />
                                    @else
                                        <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-500">
                                            {{ substr($suggestedUser->name, 0, 1) }}
                                        </div>
                                    @endif
                                </a>
                                <div class="flex flex-col leading-tight">
                                    <a href="{{ route('user.show', $suggestedUser->id) }}" class="font-bold text-sm hover:underline cursor-pointer">{{ $suggestedUser->name }}</a>
                                    <span class="text-xs text-gray-500">@ {{ strtolower(str_replace(' ', '', $suggestedUser->name)) }}</span>
                                </div>
                            </div>
                           
                            <form action="{{ route('friendships.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="addressee_id" value="{{ $suggestedUser->id }}">
                                <button type="submit" class="bg-black text-white text-sm font-bold px-4 py-1.5 rounded-full hover:bg-gray-800 transition-colors">Follow</button>
                            </form>
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
