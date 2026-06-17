<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Owner\AnnouncementController;
use App\Http\Controllers\Owner\EventController;
use App\Http\Controllers\Owner\GalleryItemController;
use App\Http\Controllers\Owner\InquiryController;
use App\Http\Controllers\Owner\OwnerAuthenticatedSessionController;
use App\Http\Controllers\Owner\OwnerDashboardController;
use App\Http\Controllers\Owner\RoomController;
use App\Http\Controllers\Owner\SiteSettingController;
use App\Http\Controllers\PublicSiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicSiteController::class, 'home'])->name('home');
Route::get('/about', [PublicSiteController::class, 'about'])->name('about');
Route::get('/stay', [PublicSiteController::class, 'stay'])->name('stay');
Route::get('/cafe-bar', [PublicSiteController::class, 'cafe'])->name('cafe');
Route::get('/news-events', [PublicSiteController::class, 'news'])->name('news');
Route::get('/gallery', [PublicSiteController::class, 'gallery'])->name('gallery');
Route::get('/access', [PublicSiteController::class, 'access'])->name('access');
Route::get('/contact', [PublicSiteController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/owner-login', [OwnerAuthenticatedSessionController::class, 'create'])->name('owner.login');
    Route::post('/owner-login', [OwnerAuthenticatedSessionController::class, 'store'])->name('owner.login.store');
});

Route::prefix('owner')->name('owner.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', OwnerDashboardController::class)->name('dashboard');
    Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
    Route::resource('rooms', RoomController::class)->except(['show']);
    Route::resource('announcements', AnnouncementController::class)->except(['show']);
    Route::resource('events', EventController::class)->except(['show']);
    Route::resource('gallery-items', GalleryItemController::class)->except(['show']);
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::post('/logout', [OwnerAuthenticatedSessionController::class, 'destroy'])->name('logout');
});
