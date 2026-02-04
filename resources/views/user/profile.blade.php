<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Middle Column: Profile Info & Feed -->
        <div class="flex-1 w-full max-w-[600px] border-r border-gray-100">
            <!-- Header (Twitter Style) -->
            <div class="sticky top-0 bg-white/80 backdrop-blur-md z-30 px-4 py-1 border-b border-gray-100 flex items-center gap-6">
                <a href="{{ url()->previous() }}" class="rounded-full p-2 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <div class="flex flex-col">
                    <h2 class="text-lg font-bold leading-5">{{ $user->name }}</h2>
                    <span class="text-xs text-gray-500">{{ $user->posts()->count() }} posts</span>
                </div>
            </div>

            <!-- Cover Image -->
            <div class="h-[200px] bg-gradient-to-r from-blue-400 to-purple-500 relative">
                <!-- Fallback or actual cover if available -->
            </div>

            <!-- Profile Actions & Info -->
            <div class="px-4 pb-4 border-b border-gray-100 relative">
                <div class="flex justify-between items-start">
                    <!-- Avatar (Overlapping) -->
                    <div class="-mt-[50px] mb-3 relative">
                         <div class="size-[134px] rounded-full p-1 bg-white">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $user->profile_photo_url)
                                <img class="w-full h-full rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                            @else
                                <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center text-4xl font-bold text-gray-400">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-3">
                         @if(Auth::id() === $user->id)
                            <a href="{{ route('profile.show') }}" class="px-4 py-1.5 border border-gray-300 rounded-full font-bold text-[15px] hover:bg-gray-100 transition-colors">
                                Edit Profile
                            </a>
                        @else
                             <!-- Friend/Follow Logic -->
                             <div class="flex gap-2">
                                <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">more_horiz</span>
                                </button>
                                <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">mail</span>
                                </button>
                                @if(Auth::user()->isFriendWith($user))
                                    <form action="{{ route('friendships.destroy', $user->friendshipsReceived()->where('requester_id', Auth::id())->first()->id ?? $user->friendshipsSent()->where('addressee_id', Auth::id())->first()->id) }}" method="POST" onsubmit="return confirm('Unfriend?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-1.5 bg-white border border-red-200 text-red-600 rounded-full font-bold text-[15px] hover:bg-red-50 transition-colors">
                                            Following
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('friendships.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="addressee_id" value="{{ $user->id }}">
                                        <button type="submit" class="px-4 py-1.5 bg-black text-white rounded-full font-bold text-[15px] hover:bg-gray-800 transition-colors">
                                            Follow
                                        </button>
                                    </form>
                                @endif
                             </div>
                        @endif
                    </div>
                </div>

                <!-- Bio & Stats -->
                <div>
                     <h1 class="text-xl font-extrabold leading-6">{{ $user->name }}</h1>
                     <p class="text-[15px] text-gray-500 mb-3">@ {{ strtolower(str_replace(' ', '', $user->name)) }}</p>
                     
                     <p class="text-[15px] text-gray-900 mb-3">
                         Digital Creator • Tech Enthusiast • Building LinkUP 🚀
                     </p>

                     <div class="flex gap-1 text-[15px] text-gray-500 mb-3">
                        <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                        <span>Joined {{ $user->created_at->format('F Y') }}</span>
                     </div>
                     
                     <div class="flex gap-4 text-[15px]">
                         <div class="hover:underline cursor-pointer">
                             <span class="font-bold text-gray-900">{{ rand(100, 500) }}</span> 
                             <span class="text-gray-500">Following</span>
                         </div>
                         <div class="hover:underline cursor-pointer">
                             <span class="font-bold text-gray-900">{{ rand(500, 2000) }}</span> 
                             <span class="text-gray-500">Followers</span>
                         </div>
                     </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex border-b border-gray-100">
                <a href="#" class="flex-1 h-[53px] hover:bg-gray-50 flex items-center justify-center transition-colors relative group">
                     <span class="font-bold text-[15px]">Posts</span>
                     <div class="absolute bottom-0 h-[4px] w-[56px] bg-[#1DA1F2] rounded-full"></div>
                </a>
                <a href="#" class="flex-1 h-[53px] hover:bg-gray-50 flex items-center justify-center transition-colors text-gray-500 font-medium text-[15px]">
                     <span>Replies</span>
                </a>
                 <a href="#" class="flex-1 h-[53px] hover:bg-gray-50 flex items-center justify-center transition-colors text-gray-500 font-medium text-[15px]">
                     <span>Media</span>
                </a>
                 <a href="#" class="flex-1 h-[53px] hover:bg-gray-50 flex items-center justify-center transition-colors text-gray-500 font-medium text-[15px]">
                     <span>Likes</span>
                </a>
            </div>

            <!-- Feed -->
            <div class="flex flex-col pb-20">
                @forelse($posts as $post)
                    <x-post-card :post="$post" />
                @empty
                    <div class="p-10 text-center">
                        <div class="w-full flex justify-center mb-4">
                             <img src="https://abs.twimg.com/sticky/illustrations/empty-states/masked-doll-head-with-camera-800x400.v1.png" alt="No Posts" class="w-[300px] opacity-75">
                        </div>
                        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">No posts yet</h2>
                        <p class="text-gray-500">When {{ $user->name }} posts, it'll show up here.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Widgets (Same as Dashboard for now) -->
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
                <!-- Who to follow -->
                <div class="bg-gray-50 rounded-2xl p-4">
                    <h2 class="font-extrabold text-xl mb-4 text-gray-900">You might like</h2>
                    <div class="space-y-4">
                        @foreach(range(1, 3) as $i)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-white p-0.5">
                                    <img class="w-full h-full rounded-full bg-gray-200" src="https://ui-avatars.com/api/?name=Follow+{{$i}}&background=random" alt="">
                                </div>
                                <div class="flex flex-col leading-tight">
                                    <span class="font-bold text-sm hover:underline cursor-pointer">FollowUser_{{$i}}</span>
                                    <span class="text-xs text-gray-500">@user_{{$i}}</span>
                                </div>
                            </div>
                            <button class="bg-black text-white text-sm font-bold px-4 py-1.5 rounded-full hover:bg-gray-800 transition-colors">Follow</button>
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
