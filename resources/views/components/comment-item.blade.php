@props(['comment'])

<div class="flex gap-3 group mt-4" x-data="{ showReply: false }">
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
            <button @click="showReply = !showReply" class="hover:text-blue-500 transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">chat_bubble</span>
                <span class="text-xs">Reply</span>
            </button>
            <button class="hover:text-gray-700 transition-colors"><span class="material-symbols-outlined text-[16px]">more_horiz</span></button>
        </div>

        <!-- Reply Form -->
        <div x-show="showReply" class="mt-2" x-cloak>
            <form action="{{ route('comments.store') }}" method="POST" class="flex gap-2 items-start">
                @csrf
                <input type="hidden" name="commentable_id" value="{{ $comment->commentable_id }}">
                <input type="hidden" name="commentable_type" value="{{ $comment->commentable_type }}">
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                
                <img src="{{ Auth::user()->profile_photo_url }}" class="w-6 h-6 rounded-full object-cover">
                <div class="flex-1">
                     <input type="text" name="body" placeholder="Refly to {{ $comment->user->name }}" class="w-full bg-gray-50 border border-gray-200 rounded-full px-3 py-1.5 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1.5 rounded-full text-xs font-bold transition-colors">Reply</button>
            </form>
        </div>

        <!-- Nested Repliess -->
        @if($comment->replies->count() > 0)
            <div class="mt-2 space-y-4">
                @foreach($comment->replies as $reply)
                    <x-comment-item :comment="$reply" />
                @endforeach
            </div>
        @endif
    </div>
</div>
