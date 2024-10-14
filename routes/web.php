<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RecyclingCenterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::get('/', function () {
    return view('HomePage.home');
});

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User and Admin Dashboard Views
Route::get('/user-dashboard', function () {
    return view('layouts.user');
})->name('layouts.user');

Route::get('/admin-dashboard', function () {
    return view('layouts.adminLayout');
})->name('layouts.adminLayout');

// Recycling Centers Routes
Route::middleware(['auth'])->group(function () {
    // User recycling centers index
    Route::get('/user-dashboard/recycling_centers', [RecyclingCenterController::class, 'index'])->name('recycling_centers.index');
    Route::get('/admin-dashboard/recycling_centers', [RecyclingCenterController::class, 'index'])->name('recycling_centers.admin');

    // Admin-specific routes for managing recycling centers
    Route::prefix('recycling_centers')->group(function () {
        Route::get('/create', [RecyclingCenterController::class, 'create'])->name('recycling_centers.create');
        Route::post('/', [RecyclingCenterController::class, 'store'])->name('recycling_centers.store');
        Route::get('/{id}/edit', [RecyclingCenterController::class, 'edit'])->name('recycling_centers.edit');
        Route::put('/{id}', [RecyclingCenterController::class, 'update'])->name('recycling_centers.update');
        Route::delete('/{id}', [RecyclingCenterController::class, 'destroy'])->name('recycling_centers.destroy');
    });

    // Material Routes
    Route::prefix('admin-dashboard/materials')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('materials.index');
        Route::get('/create', [MaterialController::class, 'create'])->name('materials.create');
        Route::post('/', [MaterialController::class, 'store'])->name('materials.store');
        Route::get('/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
        Route::put('/{id}', [MaterialController::class, 'update'])->name('materials.update');
        Route::delete('/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    });
    Route::prefix('user-dashboard/materials')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('materials.user');
       
    });
});

// Include authentication routes
require __DIR__.'/auth.php';
