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


Route::get('/user/{id}' , function($id){
     return 'user is ' . $id;
})->where('id','[0-9]+');



Route::get('/user/profile' , function(){
    return view('user');
})->name('profil');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
});
