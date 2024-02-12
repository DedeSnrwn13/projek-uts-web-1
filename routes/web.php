<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController as BackendProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostCountController;
use App\Http\Controllers\UserController;

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

Route::middleware('language')->group(function () {
    // Front
    Route::get("/", [FrontendController::class, 'index'])->name('front.index');
    Route::get('/all-post', [FrontendController::class, 'all_post'])->name('front.all_post');
    Route::get('/search', [FrontendController::class, 'search'])->name('front.search');
    Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('front.category');
    Route::get('/category/{cat_slug}/{sub_cat_slug}', [FrontendController::class, 'sub_category'])->name('front.sub_category');
    Route::get('/tag/{slug}', [FrontendController::class, 'tag'])->name('front.tag');
    Route::get('/single-post/{slug}', [FrontendController::class, 'single'])->name('front.single');
    Route::get('/contact-us', [FrontendController::class, 'contact_us'])->name('front.contact');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/get-cities/{province_code}', [BackendProfileController::class, 'getCity']);
    Route::get('/get-districts/{city_code}', [BackendProfileController::class, 'getDistrict']);
    Route::get('/get-villages/{district_code}', [BackendProfileController::class, 'getVillage']);
    Route::get('/post-count/{post_id}', [FrontendController::class, 'postReadCount']);

    // Dashboard
    Route::prefix('dashboard')->middleware(['auth'])->group(function () {
        Route::get('/', [BackendController::class, 'index'])->name('back.index');
        Route::resource('post', PostController::class);
        Route::resource('comment', CommentController::class);
        Route::resource('profile', BackendProfileController::class);
        Route::post('/upload-photo', [BackendProfileController::class, 'uploadPhoto']);

        Route::middleware('admin')->group(function () {
            Route::resource('category', CategoryController::class);
            Route::resource('sub-category', SubCategoryController::class);
            Route::resource('tag', TagController::class);
            Route::resource('user', UserController::class);
            Route::get('user/export/pdf', [UserController::class, 'exportPdf'])->name('user.export.pdf');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
