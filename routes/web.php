<?php

use App\Http\Controllers\BackgroundController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 


Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/form', [CommentController::class, 'create'])->name('comments.create');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/backgrounds', [BackgroundController::class, 'index'])->name('backgrounds.index');
Route::post('/backgrounds', [BackgroundController::class, 'store'])->name('backgrounds.store');
Route::delete('/backgrounds/{id}', [BackgroundController::class, 'destroy'])->name('backgrounds.destroy');

require __DIR__.'/auth.php';
