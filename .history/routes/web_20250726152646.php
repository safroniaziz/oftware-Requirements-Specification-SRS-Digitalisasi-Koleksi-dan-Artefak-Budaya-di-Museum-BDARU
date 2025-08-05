<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPengelolaKoleksiController;
use App\Http\Controllers\AdminPengelolaBeritaController;
use App\Http\Controllers\AdminPengelolaAgendaController;
use App\Http\Controllers\AdminPengelolaTestimoniController;
use App\Http\Controllers\AdminPengelolaTimController;
use App\Http\Controllers\AdminPengelolaKategoriController;
use App\Http\Controllers\AdminPengelolaPengaturanController;
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

// Admin & Pengelola dashboard routes using blade templates
Route::middleware(['auth', 'verified'])->group(function () {
    // Collections Management
    Route::get('/collections-management', [AdminPengelolaKoleksiController::class, 'index'])->name('collections-management.index');
    Route::get('/collections-management/create', [AdminPengelolaKoleksiController::class, 'create'])->name('collections-management.create');
    Route::post('/collections-management', [AdminPengelolaKoleksiController::class, 'store'])->name('collections-management.store');
    Route::get('/collections-management/{id}/edit', [AdminPengelolaKoleksiController::class, 'edit'])->name('collections-management.edit');
    Route::put('/collections-management/{id}', [AdminPengelolaKoleksiController::class, 'update'])->name('collections-management.update');
    Route::delete('/collections-management/{id}', [AdminPengelolaKoleksiController::class, 'destroy'])->name('collections-management.destroy');

    // News Management
    Route::get('/news-management', [AdminPengelolaBeritaController::class, 'index'])->name('news-management.index');

    // Events Management
    Route::get('/events-management', [AdminPengelolaAgendaController::class, 'index'])->name('events-management.index');

    // Testimonials Management
    Route::get('/testimonials-management', [AdminPengelolaTestimoniController::class, 'index'])->name('testimonials-management.index');

    // Team Members Management
    Route::get('/team-members-management', [AdminPengelolaTimController::class, 'index'])->name('team-members-management.index');

    // Categories Management
    Route::get('/categories-management', [AdminPengelolaKategoriController::class, 'index'])->name('categories-management.index');

    // Settings Management
    Route::get('/settings-management', [AdminPengelolaPengaturanController::class, 'index'])->name('settings-management.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
