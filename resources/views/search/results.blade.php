<x-app-layout>
    <div class="max-w-[600px] border-r border-slate-200 min-h-screen">
        <div class="sticky top-0 bg-white/80 backdrop-blur-md z-30 border-b border-slate-200 px-4 py-3 flex items-center gap-4">
            <a href="{{ url()->previous() }}" class="rounded-full p-2 hover:bg-slate-100 transition-colors">
                <span class="material-symbols-outlined text-slate-900">arrow_back</span>
            </a>
            <h1 class="font-bold text-xl text-slate-900">Search Results</h1>
        </div>

        <div class="p-6">
            <div class="mb-6">
                <form action="{{ route('search') }}" method="GET" class="relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <input name="q" value="{{ $query }}" class="w-full bg-slate-100 border-none rounded-xl pl-12 pr-4 py-3 text-sm focus:ring-2 focus:ring-primary transition-all placeholder-slate-400" placeholder="Search..." type="text" autofocus/>
                </form>
            </div>

            @if($users->isEmpty() && $posts->isEmpty())
                <div class="text-center py-10">
                    <div class="size-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-3xl text-slate-400">search_off</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">No results for "{{ $query }}"</h3>
                    <p class="text-slate-500">Try searching for something else.</p>
                </div>
            @else
                <!-- People Results -->
                @if($users->isNotEmpty())
                    <div class="mb-8">
                        <h2 class="font-bold text-xl mb-4 text-slate-900">People</h2>
                        <div class="space-y-4">
                            @foreach($users as $user)
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('user.show', $user) }}">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $user->profile_photo_url)
                                                <div class="size-12 rounded-full bg-cover bg-center shrink-0" style='background-image: url("{{ $user->profile_photo_url }}")'></div>
                                            @else
                                                <div class="size-12 rounded-full bg-slate-200 flex items-center justify-center shrink-0">
                                                    <span class="material-symbols-outlined text-slate-400">person</span>
                                                </div>
                                            @endif
                                        </a>
                                        <div>
                                            <a href="{{ route('user.show', $user) }}" class="font-bold text-slate-900 hover:underline block">{{ $user->name }}</a>
                                            <p class="text-sm text-slate-500">@ {{ strtolower(str_replace(' ', '', $user->name)) }}</p>
                                        </div>
                                    </div>
                                    
                                    @if(auth()->user()->isFriendWith($user))
                                        <span class="text-xs font-bold text-green-500 bg-green-50 px-3 py-1.5 rounded-full">Friends</span>
                                    @elseif(auth()->user()->hasSentFriendRequestTo($user))
                                        <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-full">Requested</span>
                                    @else
                                        <form action="{{ route('friendships.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="addressee_id" value="{{ $user->id }}">
                                            <button type="submit" class="bg-black text-white text-sm font-bold px-4 py-1.5 rounded-full hover:bg-gray-800 transition-colors">Follow</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Post Results -->
                @if($posts->isNotEmpty())
                    <div>
                        <h2 class="font-bold text-xl mb-4 text-slate-900">Posts</h2>
                        <div class="flex flex-col">
                            @foreach($posts as $post)
                                <x-post-card :post="$post" />
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
