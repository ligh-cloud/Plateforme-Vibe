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

});

require __DIR__.'/auth.php';
