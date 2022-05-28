<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\PostController;
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

Route::group(['middleware' => '\App\Http\Middleware\ApiToken', 'prefix' => 'v1'], function() {
    Route::get('/posts', [PostController::class, 'getPosts']);
    Route::get('/posts/{id}', [PostController::class, 'getPost']);
    Route::get('/posts/{id}/tags', [PostController::class, 'getPostTags']);
});

