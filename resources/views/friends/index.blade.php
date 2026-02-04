<x-app-layout>
    <main class="flex-1 min-h-screen border-r border-slate-200 dark:border-gray-700">
        <div class="p-6 border-b border-slate-200 dark:border-gray-700">
            <h1 class="text-2xl font-bold">Friends</h1>
        </div>

        <div class="p-6 space-y-8">
            <!-- Friend Requests Section -->
            @if($pendingRequests->isNotEmpty())
            <section>
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    Friend Requests
                    <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pendingRequests->count() }}</span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($pendingRequests as $request)
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-gray-800 rounded-2xl border border-slate-200 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="size-12 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                                <a href="{{ route('user.show', $request->requester->id) }}">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $request->requester->profile_photo_url)
                                        <img class="w-full h-full object-cover" src="{{ $request->requester->profile_photo_url }}" alt="{{ $request->requester->name }}" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-lg font-bold text-gray-500">
                                            {{ substr($request->requester->name, 0, 1) }}
                                        </div>
                                    @endif
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('user.show', $request->requester->id) }}" class="font-bold hover:underline block">{{ $request->requester->name }}</a>
                                <span class="text-slate-500 text-sm">Sent you a request</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                             <form action="{{ route('friendships.update', $request->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg font-bold text-xs hover:bg-primary/90 transition-colors">
                                    Confirm
                                </button>
                            </form>
                            <form action="{{ route('friendships.destroy', $request->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-slate-200 dark:bg-gray-700 text-slate-700 dark:text-gray-300 rounded-lg font-bold text-xs hover:bg-slate-300 dark:hover:bg-gray-600 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- All Friends Section -->
            <section>
                <h2 class="text-xl font-bold mb-4">All Friends</h2>
                @if($acceptedFriends->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($acceptedFriends as $friend)
                        <div class="flex items-center justify-between p-4 bg-white dark:bg-background-dark rounded-2xl border border-slate-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-3">
                                <div class="size-12 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                                    <a href="{{ route('user.show', $friend->id) }}">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $friend->profile_photo_url)
                                            <img class="w-full h-full object-cover" src="{{ $friend->profile_photo_url }}" alt="{{ $friend->name }}" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-lg font-bold text-gray-500">
                                                {{ substr($friend->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('user.show', $friend->id) }}" class="font-bold hover:underline block">{{ $friend->name }}</a>
                                    <span class="text-slate-500 text-sm">@ {{ strtolower(str_replace(' ', '', $friend->name)) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('user.show', $friend->id) }}" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                                <span class="material-symbols-outlined">more_horiz</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 text-slate-500 bg-slate-50 dark:bg-gray-800 rounded-2xl border border-dashed border-slate-300 dark:border-gray-600">
                        <span class="material-symbols-outlined text-4xl mb-2">sentiment_dissatisfied</span>
                        <p>You haven't added any friends yet.</p>
                        <a href="{{ route('search') }}" class="text-primary font-bold hover:underline mt-2 inline-block">Find people</a>
                    </div>
                @endif
            </section>
        </div>
    </main>

    <!-- Right Sidebar (Reuse existing) -->
    <aside class="hidden xl:block w-[350px] p-6 overflow-y-auto flex flex-col gap-6 sticky top-0 h-screen">
        <!-- Potentially show friend suggestions here -->
    </aside>
</x-app-layout>
