<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PostController as PostController;
use App\Http\Controllers\Api\CategoryController as CategoryController;
use App\Http\Controllers\Api\LeadController as LeadController;

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

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/get_lasts_post', [PostController::class, 'get_lasts_posts']);
Route::get('/posts/{slug}', [PostController::class, 'show']);
Route::get('/posts/category/{slug}', [PostController::class, 'get_category_posts']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/get_categories_homepage', [CategoryController::class, 'categories_homepage']);

Route::post('/contacts', [LeadController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
