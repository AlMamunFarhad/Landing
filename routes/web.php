<?php

use App\Http\Controllers\LandingPages\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

// Admin CRUD
Route::get('/pages', [LandingPageController::class, 'pages'])->name('pages');
Route::get('/pages/create', [LandingPageController::class, 'create'])->name('pages.create');
Route::post('/pages/store', [LandingPageController::class, 'store'])->name('pages.store');
Route::get('/pages/{page}/edit', [LandingPageController::class, 'edit'])->name('pages.edit');
Route::delete('/pages/{page}', [LandingPageController::class, 'destroy'])->name('pages.destroy');
Route::get('/pages/{page}', [LandingPageController::class, 'show'])->name('pages.show'); // Show admin view

// Public landing page by slug
Route::get('/landing/{slug}', [LandingPageController::class, 'showBySlug'])->name('landing.show');
Route::get('/landing/{page}/edit', [LandingPageController::class, 'edit'])->name('landing.edit');
Route::put('/pages/{page}', [LandingPageController::class, 'update'])->name('pages.update');
// Route::get('/landing/{slug}', [LandingPageController::class, 'showBySlug'])->name('landing.show');


// // Home / Dashboard
// Route::get('/', [LandingPageController::class, 'index'])->name('home');

// // Admin Pages CRUD (specific first)
// Route::get('/pages/create', [LandingPageController::class, 'create'])->name('pages.create');
// Route::post('/pages/store', [LandingPageController::class, 'store'])->name('pages.store');
// Route::get('/pages/{page}', [LandingPageController::class, 'show'])->name('pages.show');
// Route::get('/pages/{page}/edit', [LandingPageController::class, 'edit'])->name('pages.edit');
// Route::put('/pages/{page}', [LandingPageController::class, 'update'])->name('pages.update');
// Route::delete('/pages/{page}', [LandingPageController::class, 'destroy'])->name('pages.destroy');
// Route::get('/pages', [LandingPageController::class, 'pages'])->name('pages');

// // Public Landing Page
// Route::get('/landing/{slug}', [LandingPageController::class, 'showBySlug'])->name('landing.show');

// // Optional admin preview for unpublished page
// Route::get('/landing/preview/{page}', [LandingPageController::class, 'preview'])->name('landing.preview');


// Route::get('/', [LandingPageController::class, 'index'])->name('home');
// Route::get('/pages', [LandingPageController::class, 'pages'])->name('pages');
// Route::get('/pages/create', [LandingPageController::class, 'create'])->name('pages.create');
// Route::post('/pages/store', [LandingPageController::class, 'store'])->name('pages.store');
// Route::get('/pages/{page}', [LandingPageController::class, 'show'])->name('pages.show');
// Route::get('/pages/{page}/edit', [LandingPageController::class, 'edit'])->name('pages.edit');
// Route::put('/pages/{page}', [LandingPageController::class, 'update'])->name('pages.update');
// Route::delete('/pages/{page}/destroy', [LandingPageController::class, 'destroy'])->name('pages.destroy');
// Route::get('/pages/{page}/destroy', [LandingPageController::class, 'destroy'])->name('pages.destroy');
// Route::get('/landing/{page}', [LandingPageController::class, 'show'])->name('landing.show');
// Route::get('/landing/{slug}', [LandingPageController::class, 'showBySlug'])->name('landing.show-by-slug');
// Route::get('/landing/preview/{page}', [LandingPageController::class, 'preview'])->name('landing.preview');

