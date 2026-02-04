<div>
    <nav x-data="{ open: false }" class="h-full flex flex-col justify-between py-4 xl:px-4">
        <!-- Desktop Sidebar -->
        <div class="flex flex-col space-y-6 items-center xl:items-start w-full">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="p-3 rounded-full hover:bg-gray-100 transition-colors w-fit group">
                <span class="text-2xl font-bold tracking-wider hidden xl:block" style="font-family: 'Billabong', 'Grand Hotel', cursive;">LinkUP</span>
                <svg class="w-8 h-8 xl:hidden" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.76-6.162 6.162s2.76 6.163 6.162 6.163 6.162-2.76 6.162-6.163c0-3.403-2.76-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>

            <!-- Navigation Links -->
            <div class="space-y-1 w-full">
                @php
                    $navItems = [
                        ['route' => 'dashboard', 'label' => 'Home', 'active_icon' => 'home_filled', 'icon' => 'home'],
                        ['route' => 'search', 'label' => 'Search', 'active_icon' => 'search_filled', 'icon' => 'search'],
                        ['route' => 'explore', 'label' => 'Explore', 'active_icon' => 'explore_filled', 'icon' => 'explore'],
                        ['route' => 'reels', 'label' => 'Reels', 'active_icon' => 'movie_filled', 'icon' => 'movie'],
                        ['route' => 'messages', 'label' => 'Messages', 'active_icon' => 'send_filled', 'icon' => 'send'],
                        ['route' => 'notifications', 'label' => 'Notifications', 'active_icon' => 'favorite_filled', 'icon' => 'favorite'],
                        ['route' => 'create', 'label' => 'Create', 'active_icon' => 'add_box_filled', 'icon' => 'add_box'],
                    ];
                @endphp

                @foreach($navItems as $item)
                @php 
                    $isActive = request()->routeIs($item['route']);
                    // Mock SVG paths for now, replaced with Material Symbols in a real scenario or full SVG paths
                @endphp
                <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}" 
                   class="flex items-center gap-4 p-3 rounded-full hover:bg-gray-100 transition-colors w-full xl:w-auto xl:pr-8 group justify-center xl:justify-start">
                    <span class="material-symbols-outlined text-[28px] {{ $isActive ? 'font-fill' : '' }} group-hover:scale-105 transition-transform">
                        {{ $item['icon'] }} 
                        {{-- Note: 'font-fill' class usually needs a filled icon font or variation. 
                             For Material Symbols, we can toggle 'fill' via CSS or class if configured. 
                             Assuming 'material-symbols-outlined' with a fill variation class if available, or just swap icon names. --}}
                    </span>
                    <span class="text-xl hidden xl:block {{ $isActive ? 'font-bold' : 'font-normal' }}">{{ $item['label'] }}</span>
                </a>
                @endforeach

                <a href="{{ route('profile.show') }}" class="flex items-center gap-4 p-3 rounded-full hover:bg-gray-100 transition-colors w-full xl:w-auto xl:pr-8 group justify-center xl:justify-start">
                     @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="h-7 w-7 rounded-full object-cover border border-gray-300 {{ request()->routeIs('profile.show') ? 'ring-2 ring-black' : '' }}" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                     @else
                        <span class="material-symbols-outlined text-[28px] {{ request()->routeIs('profile.show') ? 'font-fill' : '' }}">person</span>
                     @endif
                    <span class="text-xl hidden xl:block {{ request()->routeIs('profile.show') ? 'font-bold' : 'font-normal' }}">Profile</span>
                </a>
            </div>

            <!-- Post Button -->
            <button class="bg-[#1DA1F2] hover:bg-[#1a91da] text-white rounded-full p-3 xl:px-8 xl:py-3 font-bold text-lg shadow-md transition-colors w-fit xl:w-11/12 mt-4 flex items-center justify-center">
                 <span class="xl:hidden">
                    <span class="material-symbols-outlined text-[24px]">edit_square</span>
                 </span>
                 <span class="hidden xl:block">Post</span>
            </button>
        </div>

        <!-- More Dropdown -->
        <div class="px-2 pb-4 flex justify-center xl:justify-start w-full">
             <x-dropdown align="left" width="60">
                 <x-slot name="trigger">
                     <button class="flex items-center gap-4 p-3 rounded-full hover:bg-gray-100 transition-colors w-full xl:w-auto xl:pr-8 group justify-center xl:justify-start">
                        <span class="material-symbols-outlined text-[28px]">menu</span>
                        <span class="text-xl hidden xl:block">More</span>
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
    </nav>

    <!-- Mobile Bottom Navigation (Visible only on small screens) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 flex justify-around items-center py-3 px-2 pb-safe">
        @foreach(['dashboard' => 'home', 'explore' => 'search', 'reels' => 'movie', 'create' => 'add_box', 'profile.show' => 'person'] as $route => $icon)
        <a href="{{ Route::has($route) ? route($route) : '#' }}" class="p-2 {{ request()->routeIs($route) ? 'text-black' : 'text-gray-500' }}">
            @if($route === 'profile.show' && Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img class="h-6 w-6 rounded-full object-cover border border-gray-300 {{ request()->routeIs($route) ? 'ring-2 ring-black' : '' }}" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            @else
                <span class="material-symbols-outlined text-[28px] {{ request()->routeIs($route) ? 'font-fill' : '' }}">{{ $icon }}</span>
            @endif
        </a>
        @endforeach
    </div>
</div>
