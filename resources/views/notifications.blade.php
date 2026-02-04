<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Middle Column: Notifications -->
        <div class="flex-1 w-full border-r border-gray-100">
             <!-- Header -->
            <div class="sticky top-0 bg-white/80 backdrop-blur-md z-30 px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-bold text-xl">Notifications</h2>
                <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-[20px]">settings</span>
                </button>
            </div>

            <!-- Filters -->
            <div class="px-4 py-2 border-b border-gray-100 flex gap-3 overflow-x-auto no-scrollbar">
                <button class="whitespace-nowrap px-4 py-1.5 bg-black text-white rounded-full font-bold text-[15px]">All</button>
                <button class="whitespace-nowrap px-4 py-1.5 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-full font-bold text-[15px] transition-colors">Verified</button>
                <button class="whitespace-nowrap px-4 py-1.5 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-full font-bold text-[15px] transition-colors">Mentions</button>
            </div>

            <!-- Notifications List -->
            <div class="pb-20">
                @foreach(range(1, 10) as $i)
                <div class="px-4 py-3 border-b border-gray-50 hover:bg-gray-50 transition-colors cursor-pointer {{ $i <= 3 ? 'bg-blue-50/30' : '' }}">
                    <div class="flex gap-3">
                        <!-- Icon Column -->
                        <div class="flex-shrink-0 w-8 flex justify-end">
                            @if($i % 4 == 0)
                                <span class="material-symbols-outlined text-blue-500 font-fill text-[24px]">person</span>
                            @elseif($i % 3 == 0)
                                <span class="material-symbols-outlined text-green-500 font-fill text-[24px]">repeat</span>
                            @elseif($i % 2 == 0)
                                <span class="material-symbols-outlined text-pink-600 font-fill text-[24px]">favorite</span>
                            @else
                                <span class="material-symbols-outlined text-purple-500 font-fill text-[24px]">star</span>
                            @endif
                        </div>

                        <!-- Content Column -->
                        <div class="flex-1">
                             <div class="flex items-center gap-2 mb-1">
                                <div class="size-8 rounded-full bg-gray-200 overflow-hidden">
                                     <img src="https://ui-avatars.com/api/?name=User+{{$i}}&background=random" class="w-full h-full object-cover">
                                </div>
                            </div>
                            
                            <p class="text-[15px] text-gray-900 leading-snug">
                                <span class="font-bold">user_{{ $i }}</span> 
                                @if($i % 4 == 0) followed you @endif
                                @if($i % 3 == 0) reposted your post @endif
                                @if($i % 2 == 0) liked your post @endif
                                @if($i % 2 != 0 && $i % 3 != 0 && $i % 4 != 0) starred your project @endif
                            </p>
                            
                            @if($i % 2 == 0 && $i % 4 != 0)
                            <p class="text-[15px] text-gray-500 mt-1 line-clamp-2">
                                "This is a great redesign! Love the hybrid approach."
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
