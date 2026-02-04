<x-app-layout>
    <main class="flex-1 min-h-screen border-r border-slate-200 dark:border-gray-700">
        <div class="p-6 border-b border-slate-200 dark:border-gray-700">
            <h1 class="text-2xl font-bold">Search Results for "{{ $query }}"</h1>
        </div>

        <div class="p-6 space-y-8">
            <!-- People Section -->
            @if($users->isNotEmpty())
            <section>
                <h2 class="text-xl font-bold mb-4">People</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($users as $user)
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-gray-800 rounded-2xl border border-slate-200 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="size-12 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                                <a href="{{ route('user.show', $user->id) }}">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $user->profile_photo_url)
                                        <img class="w-full h-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-lg font-bold text-gray-500">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @endif
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('user.show', $user->id) }}" class="font-bold hover:underline block">{{ $user->name }}</a>
                                <span class="text-slate-500 text-sm">@ {{ strtolower(str_replace(' ', '', $user->name)) }}</span>
                            </div>
                        </div>
                        
                        @if(Auth::id() !== $user->id)
                            @if(Auth::user()->isFriendWith($user))
                                <span class="text-green-500 font-bold text-sm">Friend</span>
                            @else
                                <a href="{{ route('user.show', $user->id) }}" class="px-4 py-2 bg-slate-900 dark:bg-white text-white dark:text-black rounded-full font-bold text-xs hover:opacity-90 transition-opacity">
                                    View
                                </a>
                            @endif
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Posts Section -->
            @if($posts->isNotEmpty())
            <section>
                <h2 class="text-xl font-bold mb-4">Posts</h2>
                <div class="flex flex-col">
                    @foreach($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>
            </section>
            @endif

            @if($users->isEmpty() && $posts->isEmpty())
                <div class="text-center py-10 text-slate-500">
                    <span class="material-symbols-outlined text-4xl mb-2">search_off</span>
                    <p>No results found for "{{ $query }}".</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Right Sidebar (Matches layout) -->
    <aside class="hidden xl:block w-[350px] p-6 overflow-y-auto flex flex-col gap-6 sticky top-0 h-screen">
       <!-- Reuse suggested users logic or leave empty/different for search page -->
    </aside>
</x-app-layout>
