<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('main.dashboard');

    Route::resource('companies', CompanyController::class)->middleware('editor');
    Route::resource('users', UserController::class)->middleware('editor');
    Route::resource('articles', ArticleController::class);

    Route::middleware(['writer'])->group(function () {
        Route::get('writer/dashboard', [DashboardController::class, 'writerDashboard'])->name('writer.dashboard');
        Route::get('writer/all-media', [ArticleController::class, 'allMedia'])->name('writer.all_media');
    });

    Route::middleware(['editor'])->group(function () {
        Route::get('editor/dashboard', [DashboardController::class, 'editorDashboard'])->name('editor.dashboard');
        Route::get('editor/all-media', [ArticleController::class, 'allMedia'])->name('editor.all_media');
        Route::patch('articles/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    });
});


require __DIR__.'/auth.php';
