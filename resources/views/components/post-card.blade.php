@props(['post'])

<article class="flex gap-3 px-4 py-3 border-b border-gray-100 hover:bg-gray-50/50 transition-colors cursor-pointer" x-data="{ showComments: false, editing: false, editContent: @js($post->content) }">
    <!-- Left: Avatar -->
    <div class="flex-shrink-0">
         <a href="{{ route('user.show', $post->user->id) }}">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $post->user->profile_photo_url)
                <img class="w-10 h-10 rounded-full object-cover hover:opacity-90 transition-opacity" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" />
            @else
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-gray-500">person</span>
                </div>
            @endif
        </a>
    </div>

    <!-- Right: Content -->
    <div class="flex-1 min-w-0">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-1 text-[15px] leading-5">
                <a href="{{ route('user.show', $post->user->id) }}" class="font-bold text-gray-900 hover:underline truncate">{{ $post->user->name }}</a>
                <span class="text-gray-500">@user_{{ $post->user->id }}</span>
                <span class="text-gray-500">·</span>
                <span class="text-gray-500 hover:underline">{{ $post->created_at->diffForHumans(null, true, true) }}</span>
            </div>
            
             @if(Auth::id() === $post->user_id)
            <div class="relative" x-data="{ open: false }">
                <button @click.stop="open = !open" @click.away="open = false" class="text-gray-400 hover:text-blue-500 p-1 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-[18px]">more_horiz</span>
                </button>
                <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-[0_0_10px_rgba(0,0,0,0.1)] border border-gray-100 z-20 py-1" x-cloak>
                    <button @click="editing = true; open = false" class="w-full text-left px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                        Edit Post
                    </button>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-slate-50 flex items-center gap-2" onclick="return confirm('Are you sure?')">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                            Delete Post
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>

        <!-- Text Content -->
        <template x-if="!editing">
            <p class="text-[15px] text-gray-900 leading-normal mt-0.5 whitespace-pre-wrap">{{ $post->content }}</p>
        </template>
        
        <template x-if="editing">
            <div class="mt-2" @click.stop>
                <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-2">
                    @csrf
                    @method('PUT')
                    <textarea x-model="editContent" name="content" rows="3" class="w-full bg-white border border-gray-200 rounded-xl p-3 text-[15px] focus:ring-2 focus:ring-blue-400 focus:border-transparent"></textarea>
                    <div class="flex gap-2 justify-end">
                        <button type="button" @click="editing = false" class="text-sm font-bold text-gray-500 hover:text-gray-700 px-3 py-1.5 rounded-full hover:bg-gray-100">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white text-sm font-bold px-4 py-1.5 rounded-full hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </template>

        <!-- Media Attachment (Rounded & Full Width) -->
        @if($post->image_path)
        <div class="mt-3 rounded-2xl overflow-hidden border border-gray-100">
             <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="w-full h-auto object-cover max-h-[500px]">
        </div>
        @endif

        @if($post->video_path)
        <div class="mt-3 rounded-2xl overflow-hidden border border-gray-100 bg-black">
             <video src="{{ asset('storage/' . $post->video_path) }}" controls class="w-full h-auto max-h-[500px]"></video>
        </div>
        @endif

        <!-- Social Actions (Twitter Style) -->
        <div class="flex justify-between items-center mt-3 max-w-[450px]">
            <!-- Comments -->
            <button @click.stop="showComments = !showComments" class="group flex items-center gap-1.5 text-gray-500 hover:text-blue-500 transition-colors">
                <div class="p-2 group-hover:bg-blue-50 rounded-full transition-colors -ml-2">
                    <span class="material-symbols-outlined text-[18px] block">chat_bubble</span>
                </div>
                <span class="text-xs group-hover:text-blue-500">{{ $post->comments()->whereNull('parent_id')->count() }}</span>
            </button>

            <!-- Repost -->
            <button class="group flex items-center gap-1.5 text-gray-500 hover:text-green-500 transition-colors">
                <div class="p-2 group-hover:bg-green-50 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-[18px] block w-[18px]">repeat</span>
                </div>
                <span class="text-xs group-hover:text-green-500">{{ rand(0, 50) }}</span>
            </button>

            <!-- Like -->
            <form action="{{ route('reactions.toggle') }}" method="POST" @click.stop>
                @csrf
                <input type="hidden" name="reactable_id" value="{{ $post->id }}">
                <input type="hidden" name="reactable_type" value="App\Models\Post">
                <input type="hidden" name="type" value="like">
                <button type="submit" class="group flex items-center gap-1.5 {{ $post->isLikedBy(Auth::user()) ? 'text-pink-600' : 'text-gray-500 hover:text-pink-600' }} transition-colors">
                    <div class="p-2 group-hover:bg-pink-50 rounded-full transition-colors">
                        <span class="material-symbols-outlined text-[18px] block {{ $post->isLikedBy(Auth::user()) ? 'font-fill' : '' }}">favorite</span>
                    </div>
                    <span class="text-xs {{ $post->isLikedBy(Auth::user()) ? 'text-pink-600' : 'group-hover:text-pink-600' }}">{{ $post->reactions()->count() }}</span>
                </button>
            </form>

            <!-- Views / Stats -->
            <div class="group flex items-center gap-1.5 text-gray-500 hover:text-blue-500 transition-colors cursor-default">
                 <div class="p-2 group-hover:bg-blue-50 rounded-full transition-colors">
                     <span class="material-symbols-outlined text-[18px] block">bar_chart</span>
                 </div>
                 <span class="text-xs group-hover:text-blue-500">{{ rand(100, 5000) }}</span>
            </div>

            <!-- Share -->
            <button class="group flex items-center text-gray-500 hover:text-blue-500 transition-colors">
                 <div class="p-2 group-hover:bg-blue-50 rounded-full transition-colors">
                     <span class="material-symbols-outlined text-[18px] block">ios_share</span>
                 </div>
            </button>
        </div>

        <!-- Comments Section -->
        <div x-show="showComments" class="mt-2 pt-2 border-t border-gray-100" @click.stop>
             <!-- Comment Form -->
            <form action="{{ route('comments.store') }}" method="POST" class="flex gap-3 mb-4 items-start">
                @csrf
                <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                <input type="hidden" name="commentable_type" value="App\Models\Post">
                
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && Auth::user()->profile_photo_url)
                    <img src="{{ Auth::user()->profile_photo_url }}" class="w-8 h-8 rounded-full object-cover">
                @else
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="material-symbols-outlined text-gray-500 text-sm">person</span>
                    </div>
                @endif
                
                <div class="flex-1">
                    <input type="text" name="body" placeholder="Post your reply" class="w-full bg-transparent border-0 border-b border-gray-200 focus:border-blue-500 focus:ring-0 px-0 py-2 text-[15px] placeholder-gray-500">
                </div>
                <button type="submit" class="text-blue-500 font-bold text-sm hover:bg-blue-50 px-3 py-1.5 rounded-full transition-colors disabled:opacity-50">Reply</button>
            </form>

            <!-- Comments List -->
            <div class="space-y-4 pl-0">
                @foreach($post->comments->whereNull('parent_id') as $comment)
                <div class="flex gap-3 group">
                    <a href="{{ route('user.show', $comment->user->id) }}" class="flex-shrink-0 mt-1">
                         @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && $comment->user->profile_photo_url)
                            <img src="{{ $comment->user->profile_photo_url }}" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="material-symbols-outlined text-gray-500 text-xs">person</span>
                            </div>
                        @endif
                    </a>
                    <div class="flex-1">
                        <div class="flex items-center gap-1 text-[13px] leading-5">
                             <a href="{{ route('user.show', $comment->user->id) }}" class="font-bold hover:underline">{{ $comment->user->name }}</a>
                             <span class="text-gray-500">@user_{{ $comment->user->id }}</span>
                             <span class="text-gray-500">·</span>
                             <span class="text-gray-500">{{ $comment->created_at->diffForHumans(null, true, true) }}</span>
                        </div>
                        <p class="text-[15px] text-gray-900 mt-0.5">{{ $comment->body }}</p>
                        
                        <!-- Comment Actions -->
                        <div class="flex items-center gap-8 mt-2 text-gray-500">
                            <form action="{{ route('reactions.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="reactable_id" value="{{ $comment->id }}">
                                <input type="hidden" name="reactable_type" value="App\Models\Comment">
                                <input type="hidden" name="type" value="like">
                                <button type="submit" class="flex items-center gap-1 hover:text-pink-600 transition-colors">
                                    <span class="material-symbols-outlined text-[16px] {{ $comment->isLikedBy(Auth::user()) ? 'text-pink-600 font-fill' : '' }}">favorite</span>
                                    @if($comment->likes()->count() > 0)
                                        <span class="text-xs {{ $comment->isLikedBy(Auth::user()) ? 'text-pink-600' : '' }}">{{ $comment->likes()->count() }}</span>
                                    @endif
                                </button>
                            </form>
                            <button class="hover:text-blue-500 transition-colors"><span class="material-symbols-outlined text-[16px]">chat_bubble</span></button>
                            <button class="hover:text-gray-700 transition-colors"><span class="material-symbols-outlined text-[16px]">more_horiz</span></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</article>
