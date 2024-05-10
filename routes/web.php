<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', [RecipeController::class, 'index'])->name('home');

Route::group(['prefix' => 'recipes'], function () {
    Route::get('/', [RecipeController::class, 'index']);
    Route::get('/create', [RecipeController::class, 'create']);
    Route::post('/create', [RecipeController::class, 'store']);
    Route::get('/{id}/edit', [RecipeController::class, 'edit']);
    Route::put('/{id}/edit', [RecipeController::class, 'update']);
    Route::delete('/{id}/delete', [RecipeController::class, 'destroy']);
    Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
    Route::get('/random-recipe', [RecipeController::class, 'getRandomRecipe'])->name('random.recipe');
});
