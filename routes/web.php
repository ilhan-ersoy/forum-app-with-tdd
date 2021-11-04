<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProfilesController;


Route::get('/threads',[ThreadsController::class, 'index']);
Route::get('/threads/create', [ThreadsController::class, 'create']);
Route::get('/threads/{channel}', [ThreadsController::class , 'index']);
Route::get('/threads/{channel}/{thread}',[ThreadsController::class, 'show'])->name('thread.show');
Route::post('/threads/{channel}/{thread}/replies', [RepliesController::class, 'store']);
Route::post('/threads', [ThreadsController::class, 'store']);
Route::post('/threads/{thread}/delete', [ThreadsController::class, 'destroy']);
Route::post('/replies/{reply}/favorites', [FavoritesController::class, 'store']);

Route::get('/profiles/{user}',[ProfilesController::class, 'show']);


require __DIR__.'/auth.php';

Route::get('/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return "Cache is cleared";
});
