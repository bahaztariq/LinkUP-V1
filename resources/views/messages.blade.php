<x-app-layout>
    <div class="flex h-[calc(100vh-0px)] overflow-hidden" x-data="{ activeChat: null }">
        <!-- Left: Conversations List -->
        <div class="w-full md:w-[380px] border-r border-gray-100 flex flex-col bg-white z-10" :class="{ 'hidden md:flex': activeChat }">
            <!-- Header -->
            <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white z-10">
                <h2 class="font-bold text-xl">Messages</h2>
                <div class="flex gap-2">
                    <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <span class="material-symbols-outlined text-[20px]">settings</span>
                    </button>
                    <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <span class="material-symbols-outlined text-[20px]">mark_email_unread</span>
                    </button>
                </div>
            </div>

            <!-- Search -->
            <div class="px-4 py-2">
                <div class="relative group">
                     <span class="absolute left-4 top-3 text-gray-500 group-focus-within:text-blue-500">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </span>
                    <input type="text" placeholder="Search Direct Messages" class="w-full bg-gray-100 border-none rounded-full py-2.5 pl-12 pr-4 text-[15px] focus:bg-white focus:ring-2 focus:ring-blue-400 transition-all placeholder-gray-500">
                </div>
            </div>

            <!-- List -->
            <div class="flex-1 overflow-y-auto">
                @foreach(range(1, 10) as $i)
                <div @click="activeChat = {{ $i }}" class="px-4 py-3 hover:bg-gray-50 cursor-pointer transition-colors flex gap-3 border-r-2 {{ $i === 1 ? 'border-blue-500 bg-gray-50' : 'border-transparent' }}">
                     <div class="size-12 rounded-full bg-gray-200 overflow-hidden flex-shrink-0">
                         <img src="https://ui-avatars.com/api/?name=User+{{$i}}&background=random" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline">
                            <h3 class="font-bold text-[15px] text-gray-900 truncate">User Name {{ $i }}</h3>
                            <span class="text-xs text-gray-500">2h</span>
                        </div>
                        <p class="text-[15px] text-gray-500 truncate {{ $i === 1 ? 'font-bold text-gray-900' : '' }}">
                            {{ $i === 1 ? 'Sent you a photo' : 'Hey, are we still on for the hackathon?' }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Chat Window -->
        <div class="flex-1 flex flex-col bg-white w-full" :class="{ 'hidden md:flex': !activeChat, 'flex fixed inset-0 z-20 md:static': activeChat }">
            <!-- Detailed Chat View -->
            <template x-if="activeChat">
                <div class="flex flex-col h-full">
                    <!-- Header -->
                    <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-white/80 backdrop-blur-md sticky top-0">
                        <div class="flex items-center gap-3">
                             <button @click="activeChat = null" class="md:hidden p-2 -ml-2 hover:bg-gray-100 rounded-full">
                                <span class="material-symbols-outlined">arrow_back</span>
                            </button>
                            <div class="size-9 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=User&background=random" class="w-full h-full object-cover">
                            </div>
                            <div class="flex flex-col leading-tight">
                                <span class="font-bold text-[16px]">User Name</span>
                                <span class="text-xs text-gray-500">@username</span>
                            </div>
                        </div>
                        <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                            <span class="material-symbols-outlined text-[20px]">info</span>
                        </button>
                    </div>

                    <!-- Messages -->
                    <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-white">
                        <div class="text-center text-xs text-gray-400 my-4">Today</div>
                        
                        <!-- Received -->
                        <div class="flex gap-3 max-w-[80%]">
                             <div class="size-8 rounded-full bg-gray-200 overflow-hidden flex-shrink-0 self-end">
                                <img src="https://ui-avatars.com/api/?name=User&background=random" class="w-full h-full object-cover">
                            </div>
                            <div class="bg-gray-100 text-gray-900 px-4 py-3 rounded-2xl rounded-bl-none text-[15px]">
                                Hey! Check out the new design update I pushed.
                            </div>
                        </div>

                         <!-- Sent -->
                        <div class="flex gap-3 max-w-[80%] ml-auto justify-end">
                            <div class="bg-blue-500 text-white px-4 py-3 rounded-2xl rounded-br-none text-[15px]">
                                Looks amazing! The hybrid layout is definitely the way to go. 🚀
                            </div>
                        </div>
                        
                         <!-- Received Photo -->
                        <div class="flex gap-3 max-w-[80%]">
                             <div class="size-8 rounded-full bg-gray-200 overflow-hidden flex-shrink-0 self-end">
                                <img src="https://ui-avatars.com/api/?name=User&background=random" class="w-full h-full object-cover">
                            </div>
                            <div class="bg-gray-100 p-1 rounded-2xl rounded-bl-none overflow-hidden">
                                <img src="https://picsum.photos/seed/456/300/200" class="rounded-xl">
                            </div>
                        </div>
                    </div>

                    <!-- Input -->
                    <div class="p-3 border-t border-gray-100 bg-white">
                        <div class="bg-gray-100 rounded-2xl p-1 flex items-center">
                            <button class="p-2 text-blue-500 hover:bg-blue-50 rounded-full transition-colors">
                                <span class="material-symbols-outlined text-[22px]">image</span>
                            </button>
                            <button class="p-2 text-blue-500 hover:bg-blue-50 rounded-full transition-colors">
                                <span class="material-symbols-outlined text-[22px]">gif_box</span>
                            </button>
                            <input type="text" placeholder="Start a new message" class="flex-1 bg-transparent border-none focus:ring-0 text-[15px] placeholder-gray-500 px-2">
                             <button class="p-2 text-blue-500 hover:bg-blue-50 rounded-full transition-colors">
                                <span class="material-symbols-outlined text-[22px]">send</span>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
            
            <!-- Empty State -->
            <template x-if="!activeChat">
                <div class="h-full flex flex-col items-center justify-center text-center p-8 hidden md:flex">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Select a message</h2>
                    <p class="text-gray-500 mb-6 max-w-sm">Choose from your existing conversations, start a new one, or just get swifty.</p>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full text-lg transition-colors">
                        New Message
                    </button>
                </div>
            </template>
        </div>
    </div>
</x-app-layout>
