
<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectGalleryController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// Halaman utama portfolio
Route::get('/', [PortfolioController::class, 'home'])->name('home');

// Halaman publik: daftar project dan detail project
Route::get('/projects', [PortfolioController::class, 'projects'])
    ->name('projects');

Route::get('/projects/{project}', [PortfolioController::class, 'show'])
    ->name('projects.show');

// Dashboard bawaan Laravel
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Pengaturan profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Halaman admin portfolio
Route::prefix('post')->name('post.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile admin
    Route::get('profile-saya', function () {
        return 'Halo, ' . auth()->user()->name;
    })->name('profile-saya');

    // Project
    Route::resource('projects', ProjectController::class)->except('destroy');

    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])
        ->middleware('admin')
        ->name('projects.destroy');

    // Upload gambar gallery
    Route::post('projects/{project}/images', [ProjectGalleryController::class, 'store'])
        ->name('projects.images.store');

    // Edit caption gallery
    Route::put(
        'projects/{project}/images/{image}',
        [ProjectGalleryController::class, 'update']
    )->name('projects.images.update');

    // Skill (daftar, edit, dan update)
    Route::resource('skills', SkillController::class)
        ->only(['index', 'edit', 'update']);

    // Hapus gambar gallery
    Route::delete(
        'projects/{project}/images/{image}',
        [ProjectGalleryController::class, 'destroy']
    )->middleware('admin')->name('projects.images.destroy');
});

require __DIR__.'/auth.php';
