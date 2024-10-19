<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\AdviceTypeController;
use App\Http\Controllers\WasteTipController;
use App\Http\Controllers\CenteCollecteController;
use App\Http\Controllers\ItemPostController;
use App\Http\Controllers\MeetingController;


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
    return view('HomePage.content');
});

Route::get('/dashboard', function () {
    if (Auth::user()->utype === 'USR') {
        return redirect()->route('layouts.user');
    } elseif (Auth::user()->utype === 'ADMIN') {
        return redirect()->route('layouts.adminLayout'); 
    }



    
    return redirect()->route('home'); // Redirection par défaut (ajoutez une route ou une vue de votre choix)
    return redirect()->route('home'); 
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('user-dashboard/WasteTips', [\App\Http\Controllers\WasteTipController::class, 'index1'])->name('WasteTips.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  //PostItem
    // Route::resource('item-posts', ItemPostController::class);
    // Route::get('item-posts/user', [ItemPostController::class, 'userPosts'])->name('item-posts.user');
    Route::get('item-posts/user', [ItemPostController::class, 'userPosts'])->name('item-posts.user');
    Route::get('item-posts', [ItemPostController::class, 'index'])->name('item-posts.index');
    Route::get('item-posts/create', [ItemPostController::class, 'create'])->name('item-posts.create');
    Route::post('item-posts', [ItemPostController::class, 'store'])->name('item-posts.store');
    Route::get('item-posts/{id}', [ItemPostController::class, 'show'])->name('item-posts.show');
    Route::get('item-posts/{id}/edit', [ItemPostController::class, 'edit'])->name('item-posts.edit');
    Route::put('item-posts/{id}', [ItemPostController::class, 'update'])->name('item-posts.update');
    Route::delete('item-posts/{id}', [ItemPostController::class, 'destroy'])->name('item-posts.destroy');

    //meeting
    Route::get('meetings', [App\Http\Controllers\MeetingController::class, 'index'])->name('meetings.index');
    Route::get('meetings/create/{item_post_id}', [App\Http\Controllers\MeetingController::class, 'create'])->name('meetings.create');
    Route::post('meetings/create', [App\Http\Controllers\MeetingController::class, 'store'])->name('meetings.store');
    Route::patch('meetings/{meeting}/accept', [App\Http\Controllers\MeetingController::class, 'accept'])->name('meetings.accept');
    Route::patch('meetings/{meeting}/refuse', [App\Http\Controllers\MeetingController::class, 'refuse'])->name('meetings.refuse');
    Route::get('meetings/{id}', [App\Http\Controllers\MeetingController::class, 'show'])->name('meetings.show');

});
//ADMIN 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/itemposts', [App\Http\Controllers\AdminPostController::class, 'index'])->name('admin.itemposts.index');
    Route::delete('/admin/itemposts/{id}', [App\Http\Controllers\AdminPostController::class, 'destroy'])->name('admin.itemposts.destroy');
    Route::get('/admin/itemposts/{id}/edit', [App\Http\Controllers\AdminPostController::class, 'edit'])->name('admin.itemposts.edit');
    Route::put('/admin/itemposts/{id}', [App\Http\Controllers\AdminPostController::class, 'update'])->name('admin.itemposts.update');


});





Route::get('/user-dashboard', function () {
    return view('layouts.user');
})->name('layouts.user');

// Route::resource('user-dashboard/memberships', MembershipController::class);
Route::get('user-dashboard/membership/create', [\App\Http\Controllers\MembershipController::class, 'create'])->name('membership.create');
Route::post('user-dashboard/membership', [\App\Http\Controllers\MembershipController::class, 'store'])->name('membership.store');
Route::get('user-dashboard/membership/{id}/edit', [\App\Http\Controllers\MembershipController::class, 'edit'])->name('membership.edit');
Route::put('user-dashboard/membership/{membership}', [\App\Http\Controllers\MembershipController::class, 'update'])->name('membership.update');
Route::delete('user-dashboard/membership/{id}', [\App\Http\Controllers\MembershipController::class, 'destroy'])->name('membership.destroy');
Route::get('user-dashboard/membership', [\App\Http\Controllers\MembershipController::class, 'index'])->name('membership.index');
Route::get('user-dashboard/membership/search', [\App\Http\Controllers\MembershipController::class, 'search'])->name('membership.search');




Route::get('/admin-dashboard', function () {
    return view('layouts.adminLayout');
})->name('layouts.adminLayout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/user-dashboard', function () { return view('layouts.user');})->name('layouts.user');
Route::get('/admin-dashboard', function () {return view('layouts.adminLayout');})->name('layouts.adminLayout');

Route::prefix('dashboard_admin')->group(function () {
    Route::get('/adviceType', [AdviceTypeController::class, 'index'])->name('admin.adviceType');
    Route::post('/adviceType', [AdviceTypeController::class, 'store'])->name('admin.adviceType');
    Route::delete('/adviceType/{id}', [AdviceTypeController::class, 'destroy'])->name('admin.adviceType.destroy');
    Route::put('/adviceType/{id}', [AdviceTypeController::class, 'update'])->name('admin.adviceType.update');

    // Routes pour WasteTip
    Route::get('/wasteTips', [WasteTipController::class, 'index'])->name('admin.WasteTips');
    Route::post('/wasteTips', [WasteTipController::class, 'store'])->name('admin.WasteTips');
    Route::delete('/wasteTips/{id}', [WasteTipController::class, 'destroy'])->name('wasteTips.destroy');  
    Route::put('/wasteTips/{id}', [WasteTipController::class, 'update'])->name('admin.WasteTips.update');

    Route::get('/collectionCenter', [CenteCollecteController::class, 'index'])->name('admin.collectionCenter');
    Route::post('/collectionCenter', [CenteCollecteController::class, 'store'])->name('admin.collectionCenter');
    Route::delete('/collectionCenter/{id}', [CenteCollecteController::class, 'destroy'])->name('admin.collectionCenter.destroy');
    Route::put('/collectionCenter/{id}', [CenteCollecteController::class, 'update'])->name('admin.collectionCenter.update');
}


    
);
require __DIR__.'/auth.php';
