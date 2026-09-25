<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContentController;

// Public Routes
Route::get('/works', [ContentController::class, 'getWorks']);
Route::get('/works/{id}', [ContentController::class, 'getWorkDetail']);
Route::get('/chapters/{id}', [ContentController::class, 'getChapter']);
Route::post('/chapters/{id}/like', [ContentController::class, 'likeChapter']);
Route::post('/chapters/{id}/comments', [ContentController::class, 'storeComment']);

// Admin Write Routes
Route::post('/works', [ContentController::class, 'storeWork']);
Route::post('/chapters', [ContentController::class, 'storeChapter']);