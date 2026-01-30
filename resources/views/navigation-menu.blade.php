<nav x-data="{ open: false }" class="bg-white h-full flex flex-col border-r border-gray-200">
    <!-- Desktop Sidebar -->
    <div class="hidden md:flex flex-col h-full bg-white w-64 p-4 fixed left-0 top-0 border-r border-gray-200 justify-between">
        <div class="space-y-6">
            <!-- Logo -->
            <div class="px-2 pt-4 pb-4">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-wider" style="font-family: 'Billabong', 'Grand Hotel', cursive;">
                    LinkUP
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="space-y-2">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('dashboard') ? 'font-bold' : '' }}">
                    @if(request()->routeIs('dashboard'))
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12.086l-10-8.686-10 8.666 1.414 1.414 8.586-7.441 8.586 7.441z"/><path d="M4 13.914v9.086h16v-9.086l-8-6.928z"/></svg>
                    @else
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    @endif
                    <span class="text-base">Home</span>
                </x-nav-link>

                <button class="w-full flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span class="text-base">Search</span>
                </button>

                <button class="w-full flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                    <span class="text-base">Explore</span>
                </button>

                <button class="w-full flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                    <span class="text-base">Reels</span>
                </button>

                <button class="w-full flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span class="text-base">Messages</span>
                </button>

                <button class="w-full flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    <span class="text-base">Notifications</span>
                </button>

                <button class="w-full flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    <span class="text-base">Create</span>
                </button>

                 <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('profile.show') ? 'font-bold' : '' }}">
                     @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="h-7 w-7 rounded-full object-cover border border-gray-300" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                     @else
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                     @endif
                    <span class="text-base">Profile</span>
                </x-nav-link>
            </div>
        </div>

        <!-- More Dropdown -->
        <div class="px-2 pb-4">
             <x-dropdown align="left" width="60">
                 <x-slot name="trigger">
                     <button class="w-full flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <span class="text-base">More</span>
                    </button>
                 </x-slot>
                 <x-slot name="content">
                    <div class="w-60">
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Settings') }}
                        </x-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                 </x-slot>
             </x-dropdown>
        </div>
    </div>

    <!-- Mobile Top Bar (Logo + Notifications) -->
    <div class="md:hidden flex justify-between items-center p-4 bg-white border-b border-gray-200 sticky top-0 z-50">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-wider" style="font-family: 'Billabong', 'Grand Hotel', cursive;">
            LinkUP
        </a>
        <div class="flex space-x-4">
             <button>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
            <button>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="md:hidden fixed bottom-0 w-full bg-white border-t border-gray-200 z-50 flex justify-around items-center py-3">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-black' : 'text-gray-500' }}">
            @if(request()->routeIs('dashboard'))
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12.086l-10-8.686-10 8.666 1.414 1.414 8.586-7.441 8.586 7.441z"/><path d="M4 13.914v9.086h16v-9.086l-8-6.928z"/></svg>
            @else
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            @endif
        </a>

        <button class="text-gray-500">
             <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
        </button>

         <button class="text-gray-500">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        </button>

        <button class="text-gray-500">
             <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
        </button>

        <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.show') ? 'ring-2 ring-black rounded-full' : '' }}">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img class="h-7 w-7 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            @else
                <div class="h-7 w-7 rounded-full bg-gray-200 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
            @endif
        </a>
    </div>
</nav>
