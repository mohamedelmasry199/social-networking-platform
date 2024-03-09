<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\CommentController;
use App\Http\Controllers\api\v1\ConnectionController;
use App\Http\Controllers\api\v1\LikeController;
use App\Http\Controllers\api\v1\PostController;
use App\Http\Controllers\api\v1\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
// });
// Route::group([
//     'middleware' => 'auth:sanctum',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/register', [AuthController::class, 'register']);
// });



Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']); });

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::resource('profiles', ProfileController::class)->except(['create', 'edit']);
    Route::resource('posts', PostController::class)->except(['create', 'edit']);
    Route::resource('comments', CommentController::class)->except(['create', 'edit','store']);
    Route::post('comments/{post}', [CommentController::class, 'store']);
    Route::resource('likes', LikeController::class)->except(['create', 'edit','store']);
    Route::post('likes/{post}', [LikeController::class, 'store']);
    Route::resource('connections', ConnectionController::class)->except(['create', 'edit','store']);
    Route::post('connections/acceptRequest/{friendshipId}', [ConnectionController::class, 'acceptRequest'])->name('connections.acceptRequest');;
    Route::post('connections/{id}', [ConnectionController::class, 'store'])->name('connections.sendRequest');;

  });
