<?php

use App\Http\Controllers\TestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/posts/store', [TestController::class, 'store']);

Route::get('/v1/posts', [TestController::class, 'index']);

Route::get('/v1/posts/{id?}', [TestController::class, 'show']);

Route::post('/v1/posts/update', [TestController::class, 'update']);

Route::delete('/v1/posts/{id?}', [TestController::class, 'destroy']);
