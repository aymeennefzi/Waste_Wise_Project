<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RecyclingCenterController;
use Illuminate\Support\Facades\Auth;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('HomePage.home');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User and Admin Dashboards
Route::get('/user-dashboard', function () {
    return view('layouts.user');
})->name('layouts.user');

Route::get('/admin-dashboard', function () {
    return view('layouts.adminLayout');
})->name('layouts.adminLayout');

// Recycling Centers Routes
Route::get('/recycling_centers', [RecyclingCenterController::class, 'index'])->name('recycling_centers.index');

// Admin-specific routes for managing recycling centers
Route::middleware(['auth'])->group(function () {
    Route::get('/recycling_centers/create', [RecyclingCenterController::class, 'create'])->name('recycling_centers.create');
    Route::post('/recycling_centers', [RecyclingCenterController::class, 'store'])->name('recycling_centers.store');
    Route::get('/recycling_centers/{id}/edit', [RecyclingCenterController::class, 'edit'])->name('recycling_centers.edit');
    Route::put('/recycling_centers/{id}', [RecyclingCenterController::class, 'update'])->name('recycling_centers.update');
    Route::delete('/recycling_centers/{id}', [RecyclingCenterController::class, 'destroy'])->name('recycling_centers.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');
});

// Route::resource('outlets', OutletController::class);



require __DIR__.'/auth.php';
