<x-app-layout>
    <div class="flex justify-center min-h-screen pt-4 lg:pt-10">
        <!-- Feed Container -->
        <div class="w-full max-w-[630px] flex flex-col px-4 sm:px-0">
            <!-- Stories -->
            <div class="flex space-x-4 overflow-x-auto pb-6 scrollbar-hide">
                <!-- Add Story -->
                <div class="flex flex-col items-center space-y-1 min-w-[70px]">
                    <div class="relative">
                        <div class="w-[66px] h-[66px] rounded-full border-2 border-gray-100 p-0.5">
                             @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="w-full h-full rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @else
                                <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </div>
                            @endif
                        </div>
                        <div class="absolute bottom-0 right-0 bg-blue-500 rounded-full w-5 h-5 flex items-center justify-center border-2 border-white text-white text-xs">+</div>
                    </div>
                    <span class="text-xs truncate w-[74px] text-center">Your story</span>
                </div>

                <!-- Dummy Stories -->
                @foreach(range(1, 8) as $i)
                <div class="flex flex-col items-center space-y-1 min-w-[70px] cursor-pointer">
                    <div class="w-[66px] h-[66px] rounded-full ring-2 ring-pink-500 ring-offset-2 p-0.5">
                        <img class="w-full h-full rounded-full object-cover bg-gray-100" src="https://ui-avatars.com/api/?name=User+{{$i}}&background=random" alt="User {{$i}}" />
                    </div>
                    <span class="text-xs truncate w-[74px] text-center">user_{{$i}}</span>
                </div>
                @endforeach
            </div>

            <!-- Posts Feed -->
            <div class="mt-4 space-y-8 pb-16">
                @foreach(range(1, 4) as $post)
                <div class="flex flex-col border-b border-gray-100 pb-6">
                    <!-- Post Header -->
                    <div class="flex items-center justify-between py-2">
                        <div class="flex items-center space-x-2">
                             <div class="w-8 h-8 rounded-full bg-gray-200">
                                <img class="w-full h-full rounded-full object-cover" src="https://ui-avatars.com/api/?name=User+{{$post}}&background=random" alt="User {{$post}}" />
                             </div>
                             <span class="font-semibold text-sm">user_{{$post}}</span>
                             <span class="text-gray-400 text-xs">• 2h</span>
                        </div>
                        <button><svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg></button>
                    </div>

                    <!-- Post Image -->
                    <div class="border rounded aspect-square bg-gray-100 flex items-center justify-center text-gray-400">
                        <span class="text-sm">Post Content Placeholder</span>
                    </div>

                    <!-- Post Actions -->
                    <div class="flex justify-between py-3">
                        <div class="flex space-x-4">
                            <button><svg class="w-7 h-7 hover:text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg></button>
                            <button><svg class="w-7 h-7 hover:text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg></button>
                            <button><svg class="w-7 h-7 hover:text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg></button>
                        </div>
                        <button><svg class="w-7 h-7 hover:text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg></button>
                    </div>

                    <!-- Likes -->
                    <div class="font-semibold text-sm mb-1">1,234 likes</div>

                    <!-- Caption -->
                    <div class="text-sm">
                        <span class="font-semibold">user_{{$post}}</span>
                        <span class="text-gray-800">Loving the new look! #redesign #linkup</span>
                    </div>

                    <!-- Comments -->
                    <div class="text-gray-500 text-sm mt-1 cursor-pointer">View all 20 comments</div>
                    <div class="text-gray-400 text-xs mt-1 upppercase">2 HOURS AGO</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Right Sidebar (Suggestions) -->
        <div class="hidden lg:block w-[320px] pl-10 pt-4">
            <!-- Current User -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="w-14 h-14 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @else
                        <div class="w-14 h-14 rounded-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span class="font-bold text-sm">{{ Auth::user()->name }}</span>
                        <span class="text-gray-500 text-sm">{{ Auth::user()->name }}</span>
                    </div>
                </div>
                <a href="#" class="text-blue-500 text-xs font-bold hover:text-blue-700">Switch</a>
            </div>

            <!-- Suggestions Header -->
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-500 font-semibold text-sm">Suggested for you</span>
                <a href="#" class="text-xs font-bold hover:text-gray-500">See All</a>
            </div>

            <!-- Suggestions List -->
            <div class="space-y-4">
                 @foreach(range(1, 5) as $i)
                 <div class="flex items-center justify-between">
                     <div class="flex items-center space-x-3">
                         <div class="w-8 h-8 rounded-full bg-gray-200">
                             <img class="w-full h-full rounded-full object-cover" src="https://ui-avatars.com/api/?name=Suggested+{{$i}}&background=random" alt="Suggested {{$i}}" />
                         </div>
                         <div class="flex flex-col">
                             <span class="font-semibold text-sm">suggested_{{$i}}</span>
                             <span class="text-xs text-gray-400">Followed by user_{{$i+1}}</span>
                         </div>
                     </div>
                     <button class="text-blue-500 text-xs font-bold hover:text-blue-700">Follow</button>
                 </div>
                 @endforeach
            </div>

            <!-- Footer -->
            <div class="mt-8 text-xs text-gray-300">
                <p>&copy; 2024 LINKUP FROM META</p>
            </div>
        </div>
    </div>
</x-app-layout>
