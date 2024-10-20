<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\AdviceTypeController;
use App\Http\Controllers\WasteTipController;
use App\Http\Controllers\ItemPostController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RecyclingCenterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-dashboard/recycling_centers', [RecyclingCenterController::class, 'index'])->name('recycling_centers.index');
    Route::get('/admin-dashboard/recycling_centers', [RecyclingCenterController::class, 'index'])->name('recycling_centers.admin');
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


Route::prefix('recycling_centers')->group(function () {
    Route::get('/create', [RecyclingCenterController::class, 'create'])->name('recycling_centers.create');
    Route::post('/', [RecyclingCenterController::class, 'store'])->name('recycling_centers.store');
    Route::get('/{id}/edit', [RecyclingCenterController::class, 'edit'])->name('recycling_centers.edit');
    Route::put('/{id}', [RecyclingCenterController::class, 'update'])->name('recycling_centers.update');
    Route::delete('/{id}', [RecyclingCenterController::class, 'destroy'])->name('recycling_centers.destroy');
});
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




Route::prefix('events')->group(function () {
    Route::get('/newevents', [EventController::class, 'index2'])->name('events.index2');
});

Route::prefix('tasks')->group(function () {
    Route::get('/newtasks', [TaskController::class, 'index2'])->name('tasks.index2');
});


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
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/createTasksView', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{task}/editTask', [TaskController::class, 'edit'])->name('tasks.editTask');
    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroyTask');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/createEventsView', [EventController::class, 'create'])->name('events.create');
    Route::post('/create', [EventController::class, 'store'])->name('events.store');
    Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/{id}/destroy', [EventController::class, 'destroy'])->name('events.destroy');



    // Routes pour WasteTip
    Route::get('/wasteTips', [WasteTipController::class, 'index'])->name('admin.WasteTips');
    Route::post('/wasteTips', [WasteTipController::class, 'store'])->name('admin.WasteTips');
    Route::delete('/wasteTips/{id}', [WasteTipController::class, 'destroy'])->name('wasteTips.destroy');
    Route::put('/wasteTips/{id}', [WasteTipController::class, 'update'])->name('admin.WasteTips.update');

}




);
require __DIR__.'/auth.php';
