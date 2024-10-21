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
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\TaskCController;



use App\Http\Controllers\EventController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RecyclingCenterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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
    return view('HomePage.content');
});

Route::get('/dashboard', function () {
    if (Auth::user()->utype === 'USR') {
        return redirect()->route('layouts.user');
    } elseif (Auth::user()->utype === 'ADMIN') {
        return redirect()->route('layouts.adminLayout');
    }
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/user-dashboard', function () { return view('layouts.user');})->name('layouts.user');
Route::get('/admin-dashboard', function () {return view('layouts.adminLayout');})->name('layouts.adminLayout');

Route::get('auth/facebook',[FacebookController::class,'facebookpage']);
Route::get('auth/facebook/callback',[FacebookController::class,'facebookredirect']);

Route::get('auth/google',[GoogleController::class,'googlepage']);
Route::get('auth/google/callback',[GoogleController::class,'googleredirect']);

//ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/itemposts', [App\Http\Controllers\AdminPostController::class, 'index'])->name('admin.itemposts.index');
    Route::delete('/admin/itemposts/{id}', [App\Http\Controllers\AdminPostController::class, 'destroy'])->name('admin.itemposts.destroy');
    Route::get('/admin/itemposts/{id}/edit', [App\Http\Controllers\AdminPostController::class, 'edit'])->name('admin.itemposts.edit');
    Route::put('/admin/itemposts/{id}', [App\Http\Controllers\AdminPostController::class, 'update'])->name('admin.itemposts.update');
    // donations
    Route::get('/admin/donations', [DonationController::class, 'adminIndex'])->name('donations.admin.index');
    Route::get('/admin/donations/{id}/edit', [DonationController::class, 'edit'])->name('donations.admin.edit'); 
    Route::put('/admin/donations/{id}', [DonationController::class, 'update'])->name('donations.admin.update');
    Route::delete('/admin/donations/{id}', [DonationController::class, 'destroy'])->name('donations.destroy');
    //compaigns
    Route::get('/admin/campaigns', [CampaignController::class, 'index'])->name('admin.campaigns.index');
    Route::get('/admin/campaigns/create', [CampaignController::class, 'create'])->name('admin.campaigns.create'); 
    Route::post('/admin/campaigns', [CampaignController::class, 'store'])->name('admin.campaigns.store'); 
    Route::get('/admin/campaigns/{id}/edit', [CampaignController::class, 'edit'])->name('admin.campaigns.edit');
    Route::put('/admin/campaigns/{id}', [CampaignController::class, 'update'])->name('admin.campaigns.update');
    Route::delete('/admin/campaigns/{id}', [CampaignController::class, 'destroy'])->name('admin.campaigns.destroy');
    Route::prefix('dashboard_admin')->group(function () {
    Route::get('/adviceType', [AdviceTypeController::class, 'index'])->name('admin.adviceType');
    Route::post('/adviceType', [AdviceTypeController::class, 'store'])->name('admin.adviceType');
    Route::delete('/adviceType/{id}', [AdviceTypeController::class, 'destroy'])->name('admin.adviceType.destroy');
    Route::put('/adviceType/{id}', [AdviceTypeController::class, 'update'])->name('admin.adviceType.update');
    Route::get('/tasksE', [TaskController::class, 'index'])->name('taskse.index');
    Route::get('/createTasksView', [TaskController::class, 'create'])->name('taskse.create');
    Route::post('/', [TaskController::class, 'store'])->name('taskse.store');
    Route::get('/{task}/editTask', [TaskController::class, 'edit'])->name('taskse.editTask');
    Route::put('/task/{task}', [TaskController::class, 'update'])->name('taskse.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('taskse.destroyTask');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/createEventsView', [EventController::class, 'create'])->name('events.create');
    Route::post('/create', [EventController::class, 'store'])->name('events.store');
    Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/event/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/{id}/destroy', [EventController::class, 'destroy'])->name('events.destroy');
    // Routes pour WasteTip
    Route::get('/wasteTips', [WasteTipController::class, 'index'])->name('admin.WasteTips');
    Route::post('/wasteTips', [WasteTipController::class, 'store'])->name('admin.WasteTips');
    Route::delete('/wasteTips/{id}', [WasteTipController::class, 'destroy'])->name('wasteTips.destroy');
    Route::put('/wasteTips/{id}', [WasteTipController::class, 'update'])->name('admin.WasteTips.update');
    Route::resource('/communities', CommunityController::class);
    Route::resource('/tasks', TaskCController::class);
    Route::get('/recycling_centers/create', [RecyclingCenterController::class, 'create'])->name('recycling_centers.create');
    Route::post('/recycling_centers/', [RecyclingCenterController::class, 'store'])->name('recycling_centers.store');
    Route::get('/recycling_centers/{id}/edit', [RecyclingCenterController::class, 'edit'])->name('recycling_centers.edit');
    Route::put('/recycling_centers/{id}', [RecyclingCenterController::class, 'update'])->name('recycling_centers.update');
    Route::delete('/recycling_centers/{id}', [RecyclingCenterController::class, 'destroy'])->name('recycling_centers.destroy');
    Route::get('/admin-dashboard/materials/', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/admin-dashboard/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/admin-dashboard/materials/', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/admin-dashboard/materials/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/admin-dashboard/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/admin-dashboard/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    Route::get('/admin-dashboard', function () {
        return view('layouts.adminLayout');
    })->name('layouts.adminLayout');
});
});

Route::get('/user-dashboard/recycling_centers', [RecyclingCenterController::class, 'index'])->name('recycling_centers.index');
Route::get('/admin-dashboard/recycling_centers', [RecyclingCenterController::class, 'index'])->name('recycling_centers.admin');

//USER
Route::middleware(['auth', 'user'])->group(function () {
    Route::prefix('events')->group(function () {
        Route::get('/newevents', [EventController::class, 'index2'])->name('events.index2');
    });
    Route::get('user-dashboard/WasteTips', [\App\Http\Controllers\WasteTipController::class, 'index1'])->name('WasteTips.index');
    Route::prefix('tasks')->group(function () {
        Route::get('/newtasks', [TaskController::class, 'index2'])->name('tasks.index2');
    });
    Route::prefix('user-dashboard/materials')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('materials.user');

    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
    Route::get('/communities/user', [CommunityController::class, 'userIndex'])->name('communities.user.index');
    Route::get('communities/{id}/details', [CommunityController::class, 'showDetails'])->name('communities.details');
    //donations
    Route::get('/donations', [DonationController::class, 'userIndex'])->name('donations.user.index');
    Route::get('/donations/create', [DonationController::class, 'userCreate'])->name('donations.user.create');
    Route::post('/donations', [DonationController::class, 'userStore'])->name('donations.user.store');
    Route::get('/donations/{id}/edit', [DonationController::class, 'userEdit'])->name('donations.user.edit');
    Route::put('/donations/{id}', [DonationController::class, 'userUpdate'])->name('donations.user.update');
    Route::post('/donations/{id}/cancel', [DonationController::class, 'cancel'])->name('donations.user.cancel');
    //compaigns
    Route::get('/campaigns', [CampaignController::class, 'userIndex'])->name('user.campaigns.index'); 
    Route::get('/campaigns/{id}', [CampaignController::class, 'show'])->name('user.campaigns.show');

    Route::get('/user-dashboard', function () {
        return view('layouts.user');
    })->name('layouts.user');
});

require __DIR__.'/auth.php';