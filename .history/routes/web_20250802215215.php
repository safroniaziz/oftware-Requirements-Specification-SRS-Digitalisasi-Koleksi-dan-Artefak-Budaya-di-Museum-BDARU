<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminPengelolaKoleksiController;
use App\Http\Controllers\AdminPengelolaBeritaController;
use App\Http\Controllers\AdminPengelolaAgendaController;
use App\Http\Controllers\AdminPengelolaTestimoniController;
use App\Http\Controllers\AdminPengelolaTimController;
use App\Http\Controllers\AdminPengelolaKategoriController;
use App\Http\Controllers\AdminPengelolaKategoriBeritaController;
use App\Http\Controllers\AdminPengelolaPengaturanController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/collections', [App\Http\Controllers\CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{slug}', [App\Http\Controllers\CollectionController::class, 'show'])->name('collections.show');

// Collection Rating routes
Route::post('/collections/{slug}/ratings', [App\Http\Controllers\CollectionRatingController::class, 'store'])->name('collections.ratings.store');
Route::put('/collections/{slug}/ratings/{rating}', [App\Http\Controllers\CollectionRatingController::class, 'update'])->name('collections.ratings.update');
Route::delete('/collections/{slug}/ratings/{rating}', [App\Http\Controllers\CollectionRatingController::class, 'destroy'])->name('collections.ratings.destroy');

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
use App\Http\Controllers\CollectionRatingController;
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
    Route::get('/news-management/create', [AdminPengelolaBeritaController::class, 'create'])->name('news-management.create');
    Route::post('/news-management', [AdminPengelolaBeritaController::class, 'store'])->name('news-management.store');
    Route::get('/news-management/{id}/edit', [AdminPengelolaBeritaController::class, 'edit'])->name('news-management.edit');
    Route::put('/news-management/{id}', [AdminPengelolaBeritaController::class, 'update'])->name('news-management.update');
    Route::delete('/news-management/{id}', [AdminPengelolaBeritaController::class, 'destroy'])->name('news-management.destroy');

    // Events Management
    Route::get('/events-management', [AdminPengelolaAgendaController::class, 'index'])->name('events-management.index');
    Route::get('/events-management/create', [AdminPengelolaAgendaController::class, 'create'])->name('events-management.create');
    Route::post('/events-management', [AdminPengelolaAgendaController::class, 'store'])->name('events-management.store');
    Route::get('/events-management/{id}/edit', [AdminPengelolaAgendaController::class, 'edit'])->name('events-management.edit');
    Route::put('/events-management/{id}', [AdminPengelolaAgendaController::class, 'update'])->name('events-management.update');
    Route::delete('/events-management/{id}', [AdminPengelolaAgendaController::class, 'destroy'])->name('events-management.destroy');

    // Testimonials Management (View Only)
    Route::get('/testimonials-management', [AdminPengelolaTestimoniController::class, 'index'])->name('testimonials-management.index');

    // Team Members Management
    Route::get('/team-members-management', [AdminPengelolaTimController::class, 'index'])->name('team-members-management.index');
    Route::get('/team-members-management/create', [AdminPengelolaTimController::class, 'create'])->name('team-members-management.create');
    Route::post('/team-members-management', [AdminPengelolaTimController::class, 'store'])->name('team-members-management.store');
    Route::get('/team-members-management/{id}/edit', [AdminPengelolaTimController::class, 'edit'])->name('team-members-management.edit');
    Route::put('/team-members-management/{id}', [AdminPengelolaTimController::class, 'update'])->name('team-members-management.update');
    Route::delete('/team-members-management/{id}', [AdminPengelolaTimController::class, 'destroy'])->name('team-members-management.destroy');

    // Categories Management
    Route::get('/categories-management', [AdminPengelolaKategoriController::class, 'index'])->name('categories-management.index');
    Route::get('/categories-management/create', [AdminPengelolaKategoriController::class, 'create'])->name('categories-management.create');
    Route::post('/categories-management', [AdminPengelolaKategoriController::class, 'store'])->name('categories-management.store');
    Route::get('/categories-management/{id}/edit', [AdminPengelolaKategoriController::class, 'edit'])->name('categories-management.edit');
    Route::put('/categories-management/{id}', [AdminPengelolaKategoriController::class, 'update'])->name('categories-management.update');
    Route::delete('/categories-management/{id}', [AdminPengelolaKategoriController::class, 'destroy'])->name('categories-management.destroy');

    // News Categories Management
    Route::get('/news-categories-management', [AdminPengelolaKategoriBeritaController::class, 'index'])->name('news-categories-management.index');
    Route::get('/news-categories-management/create', [AdminPengelolaKategoriBeritaController::class, 'create'])->name('news-categories-management.create');
    Route::post('/news-categories-management', [AdminPengelolaKategoriBeritaController::class, 'store'])->name('news-categories-management.store');
    Route::get('/news-categories-management/{id}/edit', [AdminPengelolaKategoriBeritaController::class, 'edit'])->name('news-categories-management.edit');
    Route::put('/news-categories-management/{id}', [AdminPengelolaKategoriBeritaController::class, 'update'])->name('news-categories-management.update');
    Route::delete('/news-categories-management/{id}', [AdminPengelolaKategoriBeritaController::class, 'destroy'])->name('news-categories-management.destroy');

    // Settings Management
    Route::get('/settings-management', [AdminPengelolaPengaturanController::class, 'index'])->name('settings-management.index');
    Route::put('/settings-management', [AdminPengelolaPengaturanController::class, 'update'])->name('settings-management.update');

    // Users Management
    Route::get('/users-management', [App\Http\Controllers\AdminPengelolaUserController::class, 'index'])->name('users-management.index');
    Route::get('/users-management/create', [App\Http\Controllers\AdminPengelolaUserController::class, 'create'])->name('users-management.create');
    Route::post('/users-management', [App\Http\Controllers\AdminPengelolaUserController::class, 'store'])->name('users-management.store');
    Route::get('/users-management/{id}/edit', [App\Http\Controllers\AdminPengelolaUserController::class, 'edit'])->name('users-management.edit');
    Route::put('/users-management/{id}', [App\Http\Controllers\AdminPengelolaUserController::class, 'update'])->name('users-management.update');
    Route::delete('/users-management/{id}', [App\Http\Controllers\AdminPengelolaUserController::class, 'destroy'])->name('users-management.destroy');

    // Roles Management
    Route::get('/roles-management', [App\Http\Controllers\AdminPengelolaRoleController::class, 'index'])->name('roles-management.index');
    Route::get('/roles-management/create', [App\Http\Controllers\AdminPengelolaRoleController::class, 'create'])->name('roles-management.create');
    Route::post('/roles-management', [App\Http\Controllers\AdminPengelolaRoleController::class, 'store'])->name('roles-management.store');
    Route::get('/roles-management/{id}/edit', [App\Http\Controllers\AdminPengelolaRoleController::class, 'edit'])->name('roles-management.edit');
    Route::put('/roles-management/{id}', [App\Http\Controllers\AdminPengelolaRoleController::class, 'update'])->name('roles-management.update');
    Route::delete('/roles-management/{id}', [App\Http\Controllers\AdminPengelolaRoleController::class, 'destroy'])->name('roles-management.destroy');

    // Permissions Management
    Route::get('/permissions-management', [App\Http\Controllers\AdminPengelolaPermissionController::class, 'index'])->name('permissions-management.index');
    Route::get('/permissions-management/create', [App\Http\Controllers\AdminPengelolaPermissionController::class, 'create'])->name('permissions-management.create');
    Route::post('/permissions-management', [App\Http\Controllers\AdminPengelolaPermissionController::class, 'store'])->name('permissions-management.store');
    Route::get('/permissions-management/{id}/edit', [App\Http\Controllers\AdminPengelolaPermissionController::class, 'edit'])->name('permissions-management.edit');
    Route::put('/permissions-management/{id}', [App\Http\Controllers\AdminPengelolaPermissionController::class, 'update'])->name('permissions-management.update');
    Route::delete('/permissions-management/{id}', [App\Http\Controllers\AdminPengelolaPermissionController::class, 'destroy'])->name('permissions-management.destroy');

    // Analytics Management
    Route::get('/analytics-management', [App\Http\Controllers\AdminAnalitikController::class, 'index'])->name('analytics-management.index');

    // Backup Management routes
    Route::get('/backup-management', [AdminBackupController::class, 'index'])->name('backup-management.index');
    Route::post('/backup-management', [AdminBackupController::class, 'create'])->name('backup-management.create');
    Route::get('/backup-management/{filename}/download', [AdminBackupController::class, 'download'])->name('backup-management.download');
    Route::get('/backup-management/{filename}/delete', [AdminBackupController::class, 'delete'])->name('backup-management.delete');

    // Logs Management routes
    Route::get('/logs-management', [AdminLogController::class, 'index'])->name('logs-management.index');
    Route::get('/logs-management/{filename}', [AdminLogController::class, 'show'])->name('logs-management.show');
    Route::get('/logs-management/{filename}/download', [AdminLogController::class, 'download'])->name('logs-management.download');
    Route::get('/logs-management/{filename}/clear', [AdminLogController::class, 'clear'])->name('logs-management.clear');

    // Reports Management routes
    Route::get('/reports-management', [AdminReportController::class, 'index'])->name('reports-management.index');
    Route::get('/reports-management/collections', [AdminReportController::class, 'collections'])->name('reports-management.collections');
    Route::get('/reports-management/qr-codes', [AdminReportController::class, 'qrCodes'])->name('reports-management.qrCodes');
});

// QR Code Management (outside admin middleware)
Route::middleware('auth')->group(function () {
    Route::post('/admin/collections/{id}/generate-qr', [AdminPengelolaKoleksiController::class, 'generateQrCode'])->name('collections-management.generate-qr');
    Route::post('/admin/collections/{id}/reset-qr', [AdminPengelolaKoleksiController::class, 'resetQrCode'])->name('collections-management.reset-qr');
    Route::get('/admin/collections/{id}/qr-codes', [AdminPengelolaKoleksiController::class, 'getQrCodes'])->name('collections-management.qr-codes');
    Route::get('/admin/collections/{id}/qr-code-preview', [AdminPengelolaKoleksiController::class, 'getQrCodePreview'])->name('collections-management.qr-code-preview');
    Route::get('/admin/collections/{id}/qr-code-download/{qrCode}', [AdminPengelolaKoleksiController::class, 'downloadQrCode'])->name('collections-management.qr-code-download');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
