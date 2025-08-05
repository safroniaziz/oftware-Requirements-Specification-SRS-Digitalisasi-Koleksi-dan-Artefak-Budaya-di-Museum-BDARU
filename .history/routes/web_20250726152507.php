<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/collections', [App\Http\Controllers\CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{collection}', [App\Http\Controllers\CollectionController::class, 'show'])->name('collections.show');

// Contact and About pages
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');

Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');

// Testimonials routes
Route::get('/testimonials', [App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/testimonials', [App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');

// Team Members routes
Route::resource('team-members', App\Http\Controllers\TeamMemberController::class);
Route::post('/team-members/{teamMember}/upload-photo', [App\Http\Controllers\TeamMemberController::class, 'uploadPhoto'])->name('team-members.upload-photo');

// Add import at the top
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TeamMemberController;

// Dashboard route - using blade.php for admin and pengelola
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Pengelola dashboard route (same as admin for now, using same controller)
Route::get('/pengelola/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('pengelola.dashboard');

// Admin dashboard routes using blade templates
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/collections', [AdminController::class, 'collections'])->name('collections.index');
    Route::get('/news', [AdminController::class, 'news'])->name('news.index');
    Route::get('/events', [AdminController::class, 'events'])->name('events.index');
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('testimonials.index');
    Route::get('/team-members', [AdminController::class, 'teamMembers'])->name('team-members.index');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
    Route::get('/news-categories', [AdminController::class, 'newsCategories'])->name('news-categories.index');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
