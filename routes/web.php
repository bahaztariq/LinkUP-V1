<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about',['name' => 'tarik']);
});

Route::get('/contact', function () {
    return view('contact');
});





Route::get('/user/profile' , function(){
    return view('user');
})->name('profil');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $posts = \App\Models\Post::with(['user', 'comments', 'reactions'])->latest()->get();
        $suggestedUsers = \App\Models\User::where('id', '!=', auth()->id())->inRandomOrder()->limit(5)->get();
        return view('dashboard', compact('posts', 'suggestedUsers'));
    })->name('dashboard');

    Route::resource('posts', \App\Http\Controllers\PostController::class);
    Route::resource('comments', \App\Http\Controllers\CommentController::class);
    Route::post('/reactions', [\App\Http\Controllers\ReactionController::class, 'toggle'])->name('reactions.toggle');
    Route::resource('friendships', \App\Http\Controllers\FriendshipController::class);

    Route::get('/explore', function () {
        return view('explore');
    })->name('explore');

    Route::get('/notifications', function () {
        return view('notifications');
    })->name('notifications');

    Route::get('/messages', function () {
        return view('messages');
    })->name('messages');

    Route::get('/reels', function () {
        return view('reels');
    })->name('reels');
    
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
    
    Route::get('/user/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
});
