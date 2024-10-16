<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\TaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('HomePage.home');
});

Route::get('/dashboard', function () {
    // Vérifiez le type d'utilisateur et redirigez vers la vue appropriée
    if (Auth::user()->utype === 'USR') {
        return redirect()->route('layouts.user'); // Redirige vers la vue utilisateur
    } elseif (Auth::user()->utype === 'ADMIN') {
        return redirect()->route('layouts.adminLayout'); // Redirige vers la vue administrateur
    }
    
    return redirect()->route('home'); // Redirection par défaut (ajoutez une route ou une vue de votre choix)
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('communities', CommunityController::class);

    Route::resource('tasks', TaskController::class);


});
Route::get('/user-dashboard', function () {
    return view('layouts.user');
})->name('layouts.user');

Route::get('/admin-dashboard', function () {
    return view('layouts.adminLayout');
})->name('layouts.adminLayout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


require __DIR__.'/auth.php';
