@props(['post'])

<article class="p-6 border-b border-slate-200 dark:border-gray-700 hover:bg-slate-50/50 dark:hover:bg-gray-800/30 transition-colors" x-data="{ showComments: false, editing: false, editContent: @js($post->content) }">
    <div class="flex gap-4">
        <div class="size-12 rounded-full bg-gray-200 dark:bg-gray-700 text-center overflow-hidden">
            <a href="{{ route('user.show', $post->user->id) }}">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $post->user->profile_photo_url)
                    <img class="w-full h-full rounded-full object-cover" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" />
                @else
                    <span class="w-full h-full flex items-center justify-center text-lg font-bold text-gray-500">{{ substr($post->user->name, 0, 1) }}</span>
                @endif
            </a>
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-1">
                    <a href="{{ route('user.show', $post->user->id) }}" class="font-bold hover:underline">{{ $post->user->name }}</a>
                    <span class="text-slate-500 ml-1">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                
                @if(Auth::id() === $post->user_id)
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="material-symbols-outlined text-slate-400 cursor-pointer hover:bg-slate-100 dark:hover:bg-gray-700 rounded-full p-1 transition-colors">more_horiz</button>
                    <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-slate-100 dark:border-gray-700 z-10 py-1" x-cloak>
                        <button @click="editing = true; open = false" class="w-full text-left px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-gray-700 flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">edit</span>
                            Edit Post
                        </button>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 flex items-center gap-2" onclick="return confirm('Are you sure?')">
                                <span class="material-symbols-outlined text-lg">delete</span>
                                Delete Post
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            
            <template x-if="!editing">
                <p class="mt-2 text-slate-800 dark:text-slate-200">{{ $post->content }}</p>
            </template>
            
            <template x-if="editing">
                <div class="mt-2">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-2">
                        @csrf
                        @method('PUT')
                        <textarea x-model="editContent" name="content" class="w-full bg-slate-100 dark:bg-gray-800 border-none rounded-lg p-3 text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-primary"></textarea>
                        <div class="flex gap-2 justify-end">
                            <button type="button" @click="editing = false" class="text-xs font-bold text-slate-500 hover:text-slate-700">Cancel</button>
                            <button type="submit" class="bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-primary/90">Save</button>
                        </div>
                    </form>
                </div>
            </template>

            @if($post->image_path)
            <div class="mt-4 rounded-2xl overflow-hidden border border-slate-200 dark:border-gray-700 bg-gray-800">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="w-full">
            </div>
            @endif

            @if($post->video_path)
            <div class="mt-4 rounded-2xl overflow-hidden border border-slate-200 dark:border-gray-700 bg-gray-800">
                    <video src="{{ asset('storage/' . $post->video_path) }}" controls class="w-full"></video>
            </div>
            @endif

            <div class="flex items-center justify-start gap-4 mt-4 max-w-md">
                <!-- Like Button -->
                <form action="{{ route('reactions.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="reactable_id" value="{{ $post->id }}">
                    <input type="hidden" name="reactable_type" value="App\Models\Post">
                    <input type="hidden" name="type" value="like">
                    <button type="submit" class="flex items-center gap-2 {{ $post->isLikedBy(Auth::user()) ? 'text-red-500' : 'text-slate-500' }} hover:text-red-500 transition-colors group">
                        <span class="material-symbols-outlined text-[20px] {{ $post->isLikedBy(Auth::user()) ? 'font-fill' : 'group-hover:font-fill' }}">favorite</span>
                        <span class="text-xs font-bold">{{ $post->reactions()->count() }}</span>
                    </button>
                </form>

                <button @click="showComments = !showComments" class="flex items-center gap-2 text-slate-500 hover:text-blue-500 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">chat_bubble</span>
                    <span class="text-xs font-bold">{{ $post->comments()->whereNull('parent_id')->count() }}</span>
                </button>

                <!-- <button class="flex items-center gap-2 text-slate-500 hover:text-emerald-500 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">repeat</span>
                    <span class="text-xs font-bold">{{ rand(0, 10) }}</span>
                </button>
                <button class="flex items-center gap-2 text-slate-500 hover:text-blue-500 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">share</span>
                </button> -->
            </div>

            <!-- Comments Section -->
            <div x-show="showComments" class="mt-4 pt-4 border-t border-slate-100 dark:border-gray-700 animate-in fade-in slide-in-from-top-2 duration-200">
                <!-- Comment Form -->
                <form action="{{ route('comments.store') }}" method="POST" class="flex gap-3 mb-6">
                    @csrf
                    <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                    <input type="hidden" name="commentable_type" value="App\Models\Post">
                    <div class="size-8 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden shrink-0">
                         @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && Auth::user()->profile_photo_url)
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary/10 text-primary text-xs font-bold">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        @endif
                    </div>
                    <div class="flex-1 relative">
                        <input type="text" name="body" placeholder="Write a comment..." class="w-full bg-slate-100 dark:bg-gray-800 border-none rounded-2xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/50 transition-shadow">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 text-primary hover:bg-white dark:hover:bg-gray-700 rounded-full transition-colors">
                            <span class="material-symbols-outlined text-[18px]">send</span>
                        </button>
                    </div>
                </form>

                <!-- Comments List -->
                <div class="space-y-5">
                    @foreach($post->comments->whereNull('parent_id') as $comment)
                        <div x-data="{ showReply: false }" class="group">
                            <div class="flex gap-3">
                                <a href="{{ route('user.show', $comment->user->id) }}" class="size-8 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden shrink-0">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $comment->user->profile_photo_url)
                                        <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-xs font-bold text-gray-500">{{ substr($comment->user->name, 0, 1) }}</div>
                                    @endif
                                </a>
                                <div class="flex-1">
                                    <div class="flex flex-col items-start">
                                        <div class="bg-slate-100 dark:bg-gray-800 rounded-2xl px-4 py-2.5">
                                            <a href="{{ route('user.show', $comment->user->id) }}" class="text-sm font-bold hover:underline mb-0.5 block">{{ $comment->user->name }}</a>
                                            <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">{{ $comment->body }}</p>
                                        </div>
                                        
                                        <div class="flex items-center gap-4 mt-1.5 ml-2 text-xs text-slate-500 font-medium select-none">
                                            <span>{{ $comment->created_at->diffForHumans(null, true, true) }}</span> <!-- Short diff -->
                                            
                                            <form action="{{ route('reactions.toggle') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="reactable_id" value="{{ $comment->id }}">
                                                <input type="hidden" name="reactable_type" value="App\Models\Comment">
                                                <input type="hidden" name="type" value="like">
                                                <button type="submit" class="{{ $comment->isLikedBy(Auth::user()) ? 'text-red-500' : 'hover:text-slate-800 dark:hover:text-slate-300' }} transition-colors">
                                                    Like
                                                </button>
                                            </form>
                                            
                                            <button @click="showReply = !showReply" class="hover:text-slate-800 dark:hover:text-slate-300 transition-colors">Reply</button>
                                            
                                            @if($comment->likes()->count() > 0)
                                                <div class="flex items-center gap-1 bg-white dark:bg-gray-700 shadow-sm rounded-full px-2 py-0.5 -mt-8 ml-auto border border-slate-100 dark:border-gray-600">
                                                    <span class="material-symbols-outlined text-[10px] text-red-500 font-fill">favorite</span>
                                                    <span class="text-[10px]">{{ $comment->likes()->count() }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Replies -->
                                    @if($comment->replies->count() > 0)
                                    <div class="mt-3 space-y-3 relative">
                                        <div class="absolute left-[-26px] top-0 bottom-4 w-px bg-slate-200 dark:bg-gray-700 rounded-full"></div>
                                        @foreach($comment->replies as $reply)
                                            <div class="flex gap-2 relative">
                                                <div class="absolute left-[-26px] top-4 w-4 h-px bg-slate-200 dark:bg-gray-700 rounded-full"></div>
                                                <a href="{{ route('user.show', $reply->user->id) }}" class="size-6 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden shrink-0 mt-1">
                                                     @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $reply->user->profile_photo_url)
                                                        <img src="{{ $reply->user->profile_photo_url }}" alt="{{ $reply->user->name }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-[10px] font-bold text-gray-500">{{ substr($reply->user->name, 0, 1) }}</div>
                                                    @endif
                                                </a>
                                                <div class="flex-1">
                                                    <div class="bg-slate-100 dark:bg-gray-800 rounded-2xl px-3 py-2">
                                                        <a href="{{ route('user.show', $reply->user->id) }}" class="text-xs font-bold hover:underline mb-0.5 block">{{ $reply->user->name }}</a>
                                                        <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">{{ $reply->body }}</p>
                                                    </div>
                                                    <div class="flex items-center gap-3 mt-1 ml-2 text-[10px] text-slate-500 font-medium">
                                                        <span>{{ $reply->created_at->diffForHumans(null, true, true) }}</span>
                                                        <!-- Like Reply -->
                                                        <form action="{{ route('reactions.toggle') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="reactable_id" value="{{ $reply->id }}">
                                                            <input type="hidden" name="reactable_type" value="App\Models\Comment">
                                                            <input type="hidden" name="type" value="like">
                                                            <button type="submit" class="{{ $reply->isLikedBy(Auth::user()) ? 'text-red-500' : 'hover:text-slate-800 dark:hover:text-slate-300' }} transition-colors">Like</button>
                                                        </form>
                                                        @if($reply->likes()->count() > 0)
                                                            <span class="flex items-center gap-0.5 text-red-500"><span class="material-symbols-outlined text-[10px] font-fill">favorite</span> {{ $reply->likes()->count() }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    <!-- Reply Form -->
                                    <div x-show="showReply" class="mt-3 flex gap-2" x-transition>
                                        <div class="size-6 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden shrink-0">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && Auth::user()->profile_photo_url)
                                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-primary/10 text-primary text-[10px] font-bold">{{ substr(Auth::user()->name, 0, 1) }}</div>
                                            @endif
                                        </div>
                                        <form action="{{ route('comments.store') }}" method="POST" class="flex-1 relative">
                                            @csrf
                                            <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                                            <input type="hidden" name="commentable_type" value="App\Models\Post">
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            
                                            <input type="text" name="body" placeholder="Reply to {{ $comment->user->name }}..." class="w-full bg-slate-100 dark:bg-gray-800 border-none rounded-xl px-3 py-1.5 text-xs focus:ring-2 focus:ring-primary/50 transition-shadow">
                                            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-1 text-primary hover:bg-white dark:hover:bg-gray-700 rounded-full transition-colors">
                                                <span class="material-symbols-outlined text-[14px]">send</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</article>
