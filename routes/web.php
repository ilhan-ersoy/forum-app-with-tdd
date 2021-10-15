<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\RepliesController;


Route::get('/',[ThreadsController::class, 'index']);
Route::get('/threads',[ThreadsController::class, 'index']);
Route::get('/thread/{channel}/{thread}',[ThreadsController::class, 'show'])->name('thread.show');
Route::get('/threads/create', [ThreadsController::class, 'create']);
Route::post('/threads/{channel}/{thread}/replies', [RepliesController::class, 'store']);
Route::post('/threads', [ThreadsController::class, 'store']);

Route::get('/logout',function () {
    return redirect('/threads');
});

require __DIR__.'/auth.php';
