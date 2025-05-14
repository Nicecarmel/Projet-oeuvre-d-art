<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\OeuvreController;
use Illuminate\Support\Facades\Route;

// Page d'accueil


// Routes pour les catégories
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategorieController::class, 'index'])->name('index');
    Route::get('/create', [CategorieController::class, 'create'])->name('create');
    Route::post('/', [CategorieController::class, 'store'])->name('store');
    Route::get('/{categorie}', [CategorieController::class, 'show'])->name('show');
    Route::get('/{categorie}/edit', [CategorieController::class, 'edit'])->name('edit');
    Route::put('/{categorie}', [CategorieController::class, 'update'])->name('update');
    Route::delete('/{categorie}', [CategorieController::class, 'destroy'])->name('destroy');
});

// Routes pour les œuvres
Route::prefix('oeuvres')->name('oeuvres.')->group(function () {
    Route::get('/', [OeuvreController::class, 'index'])->name('index');
    Route::get('/create', [OeuvreController::class, 'create'])->name('create');
    Route::post('/', [OeuvreController::class, 'store'])->name('store');
    Route::get('/{oeuvre}', [OeuvreController::class, 'show'])->name('show');
    Route::get('/{oeuvre}/edit', [OeuvreController::class, 'edit'])->name('edit');
    Route::put('/{oeuvre}', [OeuvreController::class, 'update'])->name('update');
    Route::delete('/{oeuvre}', [OeuvreController::class, 'destroy'])->name('destroy');
});


