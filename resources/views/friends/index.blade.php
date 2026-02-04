<x-app-layout>
    <div class="flex-1 border-r border-slate-200 dark:border-border-dark min-h-screen">
        <div class="sticky top-0 bg-white/80 dark:bg-black/80 backdrop-blur-md z-30 border-b border-slate-200 dark:border-border-dark px-4 py-3">
            <h1 class="font-bold text-xl text-slate-900 dark:text-white">Friends</h1>
        </div>

        <div class="p-4" x-data="{ tab: 'friends' }">
            <div class="flex gap-4 border-b border-slate-200 dark:border-border-dark mb-4">
                <button @click="tab = 'friends'" :class="{ 'border-primary text-primary': tab === 'friends', 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300': tab !== 'friends' }" class="pb-3 border-b-2 font-bold text-sm transition-colors">My Friends</button>
                <button @click="tab = 'requests'" :class="{ 'border-primary text-primary': tab === 'requests', 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300': tab !== 'requests' }" class="pb-3 border-b-2 font-bold text-sm transition-colors flex items-center gap-2">
                    Friend Requests
                    @if($pendingRequests->count() > 0)
                        <span class="bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">{{ $pendingRequests->count() }}</span>
                    @endif
                </button>
            </div>

            <!-- Friends List -->
            <div x-show="tab === 'friends'" class="space-y-4">
                @forelse($acceptedFriends as $friend)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('user.show', $friend->id) }}">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $friend->profile_photo_url)
                                    <div class="w-10 h-10 rounded-full bg-cover bg-center shrink-0" style='background-image: url("{{ $friend->profile_photo_url }}")'></div>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-slate-400">person</span>
                                    </div>
                                @endif
                            </a>
                            <div>
                                <a href="{{ route('user.show', $friend->id) }}" class="font-bold text-slate-900 dark:text-white hover:underline">{{ $friend->name }}</a>
                                <p class="text-xs text-slate-500">@ {{ strtolower(str_replace(' ', '', $friend->name)) }}</p>
                            </div>
                        </div>
                        @php
                            $friendship = Auth::user()->friendshipsSent()->where('addressee_id', $friend->id)->where('status', 'accepted')->first()
                                       ?? Auth::user()->friendshipsReceived()->where('requester_id', $friend->id)->where('status', 'accepted')->first();
                        @endphp
                        @if($friendship)
                            <form action="{{ route('friendships.destroy', $friendship->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-sm font-bold border border-red-200 hover:bg-red-50 rounded-full px-3 py-1 transition-colors" onclick="return confirm('Remove friend?')">Remove</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="text-center text-slate-500 py-8">
                        <p>No friends yet. Go to Explore to find people!</p>
                    </div>
                @endforelse
            </div>

            <!-- Requests List -->
            <div x-show="tab === 'requests'" class="space-y-4" x-cloak>
                @forelse($pendingRequests as $request)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('user.show', $request->requester->id) }}">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $request->requester->profile_photo_url)
                                    <div class="w-10 h-10 rounded-full bg-cover bg-center shrink-0" style='background-image: url("{{ $request->requester->profile_photo_url }}")'></div>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-slate-400">person</span>
                                    </div>
                                @endif
                            </a>
                            <div>
                                <a href="{{ route('user.show', $request->requester->id) }}" class="font-bold text-slate-900 dark:text-white hover:underline">{{ $request->requester->name }}</a>
                                <p class="text-xs text-slate-500">Sent you a friend request</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                             <form action="{{ route('friendships.update', $request->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-primary text-white text-sm font-bold px-4 py-1.5 rounded-full hover:bg-primary/90 transition-colors">Confirm</button>
                            </form>
                            <form action="{{ route('friendships.destroy', $request->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-slate-200 dark:bg-surface-dark text-slate-700 dark:text-slate-300 text-sm font-bold px-4 py-1.5 rounded-full hover:bg-slate-300 transition-colors">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-500 py-8">
                        <p>No pending friend requests.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
