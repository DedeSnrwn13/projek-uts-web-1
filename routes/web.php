<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\SubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Front
Route::get("/", [FrontendController::class, 'index'])->name('front.index');
Route::get('/single-post', [FrontendController::class, 'single'])->name('front.single');

// Dashboard
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [BackendController::class, 'index'])->name('back.index');

    // Category
    Route::resource('category', CategoryController::class);
    // SubCategory
    Route::get('get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);
    Route::resource('sub-category', SubCategoryController::class);
    // Tag
    Route::resource('tag', TagController::class);
    // Post
    Route::resource('post', PostController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
