<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/health', HealthController::class);

// 60 lectures par minute et par IP au maximum.
Route::middleware('throttle:reads')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{slug}', [ProjectController::class, 'show']);
});

// Plafonds définis dans AppServiceProvider : 3 par minute, 20 par jour et par IP, 60 par heure au total.
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:contact');