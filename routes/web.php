<?php

use App\Http\Controllers\LandingPages\LandingPageController;
use Illuminate\Support\Facades\Route;

    Route::get('/', [LandingPageController::class, 'index'])->name('home');
    Route::get('/pages', [LandingPageController::class, 'pages'])->name('pages.index');
    Route::get('/pages/create', [LandingPageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [LandingPageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{page}/edit', [LandingPageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [LandingPageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{page}', [LandingPageController::class, 'destroy'])->name('pages.destroy');
    Route::get('/pages/{page}', [LandingPageController::class, 'show'])->name('pages.show');
