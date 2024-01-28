<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get Sub Category by Category Id
Route::get('/get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);

// Post
Route::get('post', [PostController::class, 'postList']);
// Category
Route::get('category', [CategoryController::class, 'categoryList']);
Route::get('category/{id}', [CategoryController::class, 'categoryDetails']);
Route::post('category', [CategoryController::class, 'categoryStore']);
Route::put('category/{id}', [CategoryController::class, 'categoryUpdate']);
Route::delete('category/{id}', [CategoryController::class, 'categoryDelete']);
