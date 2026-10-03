<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);

// 5 messages par minute et par IP au maximum.
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1');