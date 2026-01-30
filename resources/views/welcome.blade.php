<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LinkUP - Connect with friends</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl flex items-center justify-center gap-8">
        <!-- Left Side - Phone Mockup (Desktop Only) -->
        <div class="hidden lg:block relative">
            <div class="w-[454px] h-[618px] bg-gradient-to-br from-purple-100 to-pink-100 rounded-3xl flex items-center justify-center">
                <span class="text-6xl font-bold text-gray-300">📱</span>
            </div>
        </div>

        <!-- Right Side - Login/Signup -->
        <div class="w-full max-w-[350px] flex flex-col gap-3">
            <!-- Login Card -->
            <div class="bg-white border border-gray-300 p-10 flex flex-col items-center">
                <!-- Logo -->
                <h1 class="text-5xl font-bold mb-8 tracking-wider" style="font-family: 'Billabong', 'Grand Hotel', cursive;">
                    LinkUP
                </h1>

                @if (Route::has('login'))
                    @auth
                        <!-- If logged in -->
                        <a href="{{ url('/dashboard') }}" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg text-sm text-center hover:bg-blue-600 transition">
                            Go to Dashboard
                        </a>
                    @else
                        <!-- Login Form -->
                        <form action="{{ route('login') }}" method="GET" class="w-full flex flex-col gap-2">
                            <input type="text" placeholder="Phone number, username, or email" class="w-full px-2 py-2 border border-gray-300 rounded text-xs bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-300" />
                            <input type="password" placeholder="Password" class="w-full px-2 py-2 border border-gray-300 rounded text-xs bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-300" />
                            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg text-sm mt-2 hover:bg-blue-600 transition">
                                Log in
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="w-full flex items-center gap-4 my-4">
                            <div class="flex-1 h-px bg-gray-300"></div>
                            <span class="text-gray-500 font-semibold text-sm">OR</span>
                            <div class="flex-1 h-px bg-gray-300"></div>
                        </div>

                        <!-- Social Login -->
                        <button class="flex items-center gap-2 text-blue-900 font-semibold text-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Log in with Facebook
                        </button>

                        <!-- Forgot Password -->
                        <a href="#" class="text-xs text-blue-900 mt-4">Forgot password?</a>
                    @endauth
                @endif
            </div>

            <!-- Sign Up Card -->
            @guest
            <div class="bg-white border border-gray-300 p-6 text-center">
                <p class="text-sm">
                    Don't have an account? 
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-blue-500 font-semibold">Sign up</a>
                    @endif
                </p>
            </div>
            @endguest

            <!-- Get the App -->
            <div class="flex flex-col items-center gap-3 mt-4">
                <p class="text-sm">Get the app.</p>
                <div class="flex gap-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play" class="h-10">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="Download on App Store" class="h-10">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="absolute bottom-4 w-full text-center">
        <div class="flex justify-center gap-4 text-xs text-gray-400 mb-4">
            <a href="#">Meta</a>
            <a href="#">About</a>
            <a href="#">Blog</a>
            <a href="#">Jobs</a>
            <a href="#">Help</a>
            <a href="#">API</a>
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
        </div>
        <p class="text-xs text-gray-400">&copy; 2024 LinkUP from Meta</p>
    </footer>
</body>
</html>
