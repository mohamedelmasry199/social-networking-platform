<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendShipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class ,'index'])->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/requests', [FriendShipController::class, 'displayRequests'])->name('friend_requests.index');
    Route::get('/friend-requests/{userId}', [FriendshipController::class, 'displayAllFriendRequests'])->name('friend-requests.index');
    Route::get('/friends/{userId}', [FriendshipController::class,'displayFriends'])->name('friends.display');
    Route::post('/friend-requests/{friendshipId}/accept', [FriendshipController::class, 'acceptFriendRequest'])->name('friend-requests.accept');
    Route::delete('/friend-requests/{friendshipId}', [FriendshipController::class, 'deleteFriendRequest'])->name('friend-requests.delete');
    Route::post('/send-friend-request',  [FriendshipController::class,'sendRequest'])->name('sendFriendRequest');

    Route::get('/users/search', [HomeController::class, 'search'])->name('users.search');

    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/post/my-posts', [PostController::class, 'userPosts'])->name('posts.user');
    Route::put('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');


    Route::get('/posts/{post}/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/like',[LikeController::class, 'store'])->name('like.store');
    Route::get('/posts/{post}/likes', [LikeController::class,'showLikes'])->name('post.likes');



});

require __DIR__.'/auth.php';
