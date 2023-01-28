<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\CommentReplyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CommentController as UserCommentController;
use App\Http\Controllers\User\CommentReplyController as UserCommentReplyController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/category/{slug}', [HomeController::class, 'categoryPost'])->name('category.post');

Route::get('/posts', [HomeController::class, 'posts'])->name('posts');
Route::get('/post/{slug}', [HomeController::class, 'post'])->name('post');
Route::get('/tag/{name}', [HomeController::class, 'tagPosts'])->name('tag.posts');
Route::post('/like-post/{post}', [HomeController::class, 'likePost'])->name('post.like')->middleware(['auth', 'verified']);


Route::post('/comment/{post}', [CommentController::class, 'store'])->name('comment.store');
Route::post('commentreply/{comment}', [CommentReplyController::class, 'CommentReply'])->name('replycomment.store');


// View Composer
View::composer('layouts.frontend.partials.sidebar', function ($view) {

    $categories = Category::all()->take(10);
    $recentTags = Tag::all();
    $recentPosts = Post::latest()->take(3)->get();
    return $view->with('categories', $categories)->with('recentPosts', $recentPosts)->with('recentTags', $recentTags);
});









