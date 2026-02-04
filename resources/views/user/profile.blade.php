<x-app-layout>
    <main class="flex-1 min-h-screen border-r border-slate-200 dark:border-gray-700">
        <!-- Profile Header -->
        <div class="relative">
            <!-- Cover Image (Placeholder for now) -->
            <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500"></div>
            
            <div class="px-6 pb-6">
                <div class="relative flex justify-between items-end -mt-12 mb-4">
                    <div class="size-32 rounded-full ring-4 ring-white dark:ring-gray-900 bg-white dark:bg-gray-800 overflow-hidden">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $user->profile_photo_url)
                            <img class="w-full h-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-gray-400">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    
                    @if(Auth::id() === $user->id)
                        <a href="{{ route('profile.show') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-full font-bold text-sm transition-colors">
                            Edit Profile
                        </a>
                    @else
                        @if(Auth::user()->isFriendWith($user))
                            <form action="{{ route('friendships.destroy', $user->friendshipsReceived()->where('requester_id', Auth::id())->first()->id ?? $user->friendshipsSent()->where('addressee_id', Auth::id())->first()->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to unfriend {{ $user->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-2 bg-red-100 text-red-600 hover:bg-red-200 rounded-full font-bold text-sm transition-colors">
                                    Unfriend
                                </button>
                            </form>
                        @elseif(Auth::user()->getPendingFriendRequestTo($user))
                            <form action="{{ route('friendships.destroy', Auth::user()->getPendingFriendRequestTo($user)->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded-full font-bold text-sm transition-colors">
                                    Cancel Request
                                </button>
                            </form>
                        @elseif($request = Auth::user()->getPendingFriendRequestFrom($user))
                            <div class="flex gap-2">
                                <form action="{{ route('friendships.update', $request->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full font-bold text-sm transition-colors">
                                        Accept Request
                                    </button>
                                </form>
                                <form action="{{ route('friendships.destroy', $request->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-full font-bold text-sm transition-colors">
                                        Decline
                                    </button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('friendships.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="addressee_id" value="{{ $user->id }}">
                                <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full font-bold text-sm transition-colors">
                                    Add Friend
                                </button>
                            </form>
                        @endif
                    @endif
                </div>

                <div>
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <p class="text-slate-500">@ {{ strtolower(str_replace(' ', '', $user->name)) }}</p>
                    
                    <div class="flex gap-4 mt-4 text-sm">
                        <div class="flex gap-1">
                            <span class="font-bold">{{ $user->posts()->count() }}</span>
                            <span class="text-slate-500">Posts</span>
                        </div>
                        <div class="flex gap-1">
                            <span class="font-bold">{{ $user->friendshipsReceived()->where('status', 'accepted')->count() + $user->friendshipsSent()->where('status', 'accepted')->count() }}</span>
                            <span class="text-slate-500">Friends</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tabs -->
            <div class="flex border-b border-slate-200 dark:border-gray-700 mt-2">
                <a href="#" class="flex-1 text-center py-4 font-bold border-b-4 border-blue-500 text-slate-900 dark:text-white hover:bg-slate-50 dark:hover:bg-gray-800 transition-colors">
                    Posts
                </a>
                <a href="#" class="flex-1 text-center py-4 font-bold border-b-4 border-transparent text-slate-500 hover:bg-slate-50 dark:hover:bg-gray-800 transition-colors">
                    Media
                </a>
                <a href="#" class="flex-1 text-center py-4 font-bold border-b-4 border-transparent text-slate-500 hover:bg-slate-50 dark:hover:bg-gray-800 transition-colors">
                    Likes
                </a>
            </div>
        </div>

        <!-- Posts Feed -->
        <div class="flex flex-col">
            @forelse($posts as $post)
            <!-- Post Card (Duplicated from dashboard for now, ideally a component) -->
            <x-post-card :post="$post" />
            @empty
            <div class="p-10 text-center text-slate-500">
                <span class="material-symbols-outlined text-4xl mb-2">post_add</span>
                <p>No posts yet.</p>
            </div>
            @endforelse
        </div>
    </main>

    <!-- Right Sidebar (Suggested/Trends - Duplicated for consistency or could be removed for profile) -->
    <aside class="hidden xl:block w-[350px] p-6 overflow-y-auto flex flex-col gap-6 sticky top-0 h-screen">
        <section class="bg-slate-100 dark:bg-gray-800 rounded-2xl p-5 border border-slate-200 dark:border-gray-700">
            <h2 class="text-lg font-bold mb-4">You might know</h2>
            <!-- ... Suggested users content ... -->
             <div class="flex flex-col gap-4">
                @foreach(range(1, 3) as $i)
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2 min-w-0">
                        <div class="size-10 rounded-full bg-gray-200 dark:bg-gray-700 shrink-0">
                            <img class="w-full h-full rounded-full object-cover" src="https://ui-avatars.com/api/?name=Suggested+{{$i}}&background=random" alt="Suggested {{$i}}" />
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold truncate">suggested_{{$i}}</p>
                        </div>
                    </div>
                    <button class="bg-slate-900 dark:bg-white text-white dark:text-black text-xs font-bold px-4 py-2 rounded-full hover:opacity-80 transition-opacity">Follow</button>
                </div>
                @endforeach
            </div>
        </section>
    </aside>
</x-app-layout>
