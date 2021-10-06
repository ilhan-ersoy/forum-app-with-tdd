<?php

use Illuminate\Support\Facades\Route;


Route::get('/',[\App\Http\Controllers\ThreadsController::class,'index']);


Route::get('/threads',[\App\Http\Controllers\ThreadsController::class,'index']);
Route::get('/thread/{thread}',[\App\Http\Controllers\ThreadsController::class,'show']);


Route::post('/threads/{thread}/replies', [\App\Http\Controllers\RepliesController::class,'store'])->middleware('auth');


require __DIR__.'/auth.php';
