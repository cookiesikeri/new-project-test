<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('login/google', [LoginController::class, 'redirectToProvider']);
Route::get('login/google/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/category/{slug}', [HomeController::class, 'categoryPost'])->name('category.post');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/posts', [HomeController::class, 'posts'])->name('posts');
Route::get('/post/{slug}', [HomeController::class, 'post'])->name('post');
Route::get('/tag/{name}', [HomeController::class, 'tagPosts'])->name('tag.posts');
Route::post('/like-post/{post}', [HomeController::class, 'likePost'])->name('post.like')->middleware(['auth', 'verified']);


Route::post('/comment/{post}', [CommentController::class, 'store'])->name('comment.store');
Route::post('/comment-reply/{comment}', [CommentController::class, 'CommentReply'])->name('reply.store')->middleware(['auth', 'verified']);


// View Composer
View::composer('layouts.frontend.partials.sidebar', function ($view) {

    $categories = Category::all()->take(10);
    $recentTags = Tag::all();
    $recentPosts = Post::latest()->take(3)->get();
    return $view->with('categories', $categories)->with('recentPosts', $recentPosts)->with('recentTags', $recentTags);
});


// Admin ////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin','verified']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [DashboardController::class, 'changePassword'])->name('profile.password');


    Route::resource('user', 'UserController')->except(['create', 'show', 'edit', 'store']);

    Route::resource('category',CategoryController::class)->except(['create', 'show', 'edit']);

    Route::resource('post', 'PostController');
    Route::get('/comments', 'CommentController@index')->name('comment.index');
    Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');
    Route::get('/reply-comments', 'CommentReplyController@index')->name('reply-comment.index');
    Route::delete('/reply-comment/{id}', 'CommentReplyController@destroy')->name('reply-comment.destroy');
    Route::get('/post-liked-users/{post}', 'PostController@likedUsers')->name('post.like.users');

});

// User ////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'user', 'verified']], function () {
    Route::get('dashboard', 'DashboardController@likedPosts')->name('dashboard');
    Route::get('profile', 'DashboardController@showProfile')->name('profile');
    Route::put('profile', 'DashboardController@updateProfile')->name('profile.update');
    Route::put('profile/password', 'DashboardController@changePassword')->name('profile.password');
    Route::get('comments', 'CommentController@index')->name('comment.index');
    Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');
    Route::get('/reply-comments', 'CommentReplyController@index')->name('reply-comment.index');
    Route::delete('/reply-comment/{id}', 'CommentReplyController@destroy')->name('reply-comment.destroy');
    Route::get('/user-liked-posts', 'DashboardController@likedPosts')->name('like.posts');
});


// View Composer
View::composer('layouts.frontend.partials.sidebar', function ($view) {
    $categories = Category::all()->take(10);
    $recentTags = Tag::all();
    $recentPosts = Post::latest()->take(3)->get();
    return $view->with('categories', $categories)->with('recentPosts', $recentPosts)->with('recentTags', $recentTags);
});









