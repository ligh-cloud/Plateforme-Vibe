<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserSearchController;
use App\Http\Controllers\userUpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user.search', [UserSearchController::class, 'search'])->name('user.search');
    Route::get('/search-view', [UserSearchController::class, 'index'])->name('user.search.view');

    Route::put('/profile/update', [UserUpdateController::class, 'update'])->name('profile.update');
    Route::get('/friends' , [\App\Http\Controllers\FriendController::class , 'showUsers'])->name('friends');
    Route::get('/add_friend/{user}', [\App\Http\Controllers\FriendController::class, 'addFriends'])->name('add_friend');
    Route::get('/post' , [\App\Http\Controllers\PostController::class , 'index'])->name('post.show');
    Route::post('/create/post' , [\App\Http\Controllers\PostController::class , 'create'])->name('posts.store');
    Route::post('/post/{post}/like' , [\App\Http\Controllers\PostController::class , 'like'])->name('posts.like') ;
    Route::post('/post/comment' , function (){
        return 'this is comment';
    })->name('posts.comments') ;



});

require __DIR__.'/auth.php';
