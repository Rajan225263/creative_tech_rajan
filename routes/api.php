<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookshelfController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\ChapterController;
use App\Http\Controllers\API\PageController;

use App\Http\Controllers\Api\TestSwaggerController;


Route::middleware('auth.token')->group(function () {

    Route::prefix('bookshelves')->group(function () {
        Route::get('/', [BookshelfController::class, 'index']);
        Route::post('/', [BookshelfController::class, 'store']);
        Route::get('/{id}', [BookshelfController::class, 'show']);
        Route::put('/{id}', [BookshelfController::class, 'update']);
        Route::delete('/{id}', [BookshelfController::class, 'destroy']);
    });

    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index']);
        Route::post('/', [BookController::class, 'store']);
        Route::get('/{id}', [BookController::class, 'show']);
        Route::put('/{id}', [BookController::class, 'update']);
        Route::delete('/{id}', [BookController::class, 'destroy']);

        Route::get('search', [BookController::class, 'search']);
    });

    Route::prefix('chapters')->group(function () {
        Route::get('/', [ChapterController::class, 'index']);
        Route::post('/', [ChapterController::class, 'store']);
        Route::get('/{id}', [ChapterController::class, 'show']);
        Route::put('/{id}', [ChapterController::class, 'update']);
        Route::delete('/{id}', [ChapterController::class, 'destroy']);
        Route::get('/{id}/full-content', [ChapterController::class, 'fullContent']);

    });

    Route::prefix('pages')->group(function () {
        Route::get('/', [PageController::class, 'index']);
        Route::post('/', [PageController::class, 'store']);
        Route::get('/{id}', [PageController::class, 'show']);
        Route::put('/{id}', [PageController::class, 'update']);
        Route::delete('/{id}', [PageController::class, 'destroy']);
    });

});

Route::get('/hello', [TestSwaggerController::class, 'hello']);



