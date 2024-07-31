<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::prefix('albums')->group(function () {
    Route::get('/list', [AlbumController::class, 'index'])
        ->name('album-list');

    Route::get('/create', [AlbumController::class, 'create'])
        ->name('album-create');

    Route::post('/store', [AlbumController::class, 'store'])
        ->name('album-store');
})->middleware('auth:sanctum');
