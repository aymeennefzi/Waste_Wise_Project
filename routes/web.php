<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CampaignController;

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

    //donations
    Route::get('/donations', [DonationController::class, 'userIndex'])->name('donations.user.index');
    Route::get('/donations/create', [DonationController::class, 'userCreate'])->name('donations.user.create');
    Route::post('/donations', [DonationController::class, 'userStore'])->name('donations.user.store');
    Route::get('/donations/{id}/edit', [DonationController::class, 'userEdit'])->name('donations.user.edit');
    Route::put('/donations/{id}', [DonationController::class, 'userUpdate'])->name('donations.user.update');
    Route::post('/donations/{id}/cancel', [DonationController::class, 'cancel'])->name('donations.user.cancel');
    //compaigns
    Route::get('/campaigns', [CampaignController::class, 'userIndex'])->name('user.campaigns.index'); // Show list of campaigns
    Route::get('/campaigns/{id}', [CampaignController::class, 'show'])->name('user.campaigns.show'); // Show a single campaign

});

Route::middleware('auth')->group(function () {

    // donations
    Route::get('/admin/donations', [DonationController::class, 'adminIndex'])->name('donations.admin.index');
    Route::get('/admin/donations/{id}/edit', [DonationController::class, 'edit'])->name('donations.admin.edit'); // This should be the correct route
    Route::put('/admin/donations/{id}', [DonationController::class, 'update'])->name('donations.admin.update');
    Route::delete('/admin/donations/{id}', [DonationController::class, 'destroy'])->name('donations.destroy');
    //compaigns
    Route::get('/admin/campaigns', [CampaignController::class, 'index'])->name('admin.campaigns.index'); // Admin shows all campaigns
    Route::get('/admin/campaigns/create', [CampaignController::class, 'create'])->name('admin.campaigns.create'); // Admin creates a campaign
    Route::post('/admin/campaigns', [CampaignController::class, 'store'])->name('admin.campaigns.store'); // Store the campaign
    Route::get('/admin/campaigns/{id}/edit', [CampaignController::class, 'edit'])->name('admin.campaigns.edit'); // Admin edits a campaign
    Route::put('/admin/campaigns/{id}', [CampaignController::class, 'update'])->name('admin.campaigns.update'); // Update the campaign
    Route::delete('/admin/campaigns/{id}', [CampaignController::class, 'destroy'])->name('admin.campaigns.destroy'); // Delete the campaign
});
Route::get('/user-dashboard', function () {
    return view('layouts.user');
})->name('layouts.user');
Route::get('/admin-dashboard', function () {
    return view('layouts.adminLayout');
})->name('layouts.adminLayout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




require __DIR__.'/auth.php';
