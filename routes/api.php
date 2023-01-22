<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/articles', [ApiController::class, 'Articles']);
Route::get('/articles/{id}', [ApiController::class, 'ArticleID']);
Route::get('/articles/{id}/comments', [ApiController::class, 'ArticleComments']);
Route::get('/articles/{id}/like', [ApiController::class, 'ArticleLikes']);
Route::get('/articles/{id}/view', [ApiController::class, 'ArticleView']);
