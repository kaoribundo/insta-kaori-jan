<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


Auth::routes();


Route::group(["middleware" => "auth"] ,function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // posts
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/show/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');

    // comments
    Route::post('/post/comment/{post_id}', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment.delete');

    // profile
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/follower', [ProfileController::class, 'follow'])->name('profile.follower');
    Route::get('/profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');

    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update',[ProfileController::class,'update'])->name('profile.update');
    // Route::post('/profile/{id}/softdelete',[ProfileController::class,'softdelete'])->name('profile.softdelete');
    // Route::post('/profile/{id}/activate',[ProfileController::class,'activate'])->name('profile.activate');

    // likes
    Route::post('/like/store/{id}', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/delete/{id}', [LikeController::class, 'destroy'])->name('like.delete');

    // follows
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');

    //admin
    Route::group(["as"=>"admin.","prefix"=>"admin/","middleware"=>"admin"],function(){
        Route::get("users/index",[UserController::class,'index'])->name('users.index');
        Route::post("users/{id}/deactivate",[UserController::class,'deactivate'])->name('users.deactivate');
        Route::post("users/{id}/activate",[UserController::class,'activate'])->name('users.activate');

        Route::get("posts/index",[PostsController::class,'index'])->name('posts.index');
        Route::delete("posts/{id}/hide",[PostsController::class,'hide'])->name('posts.hide');
        Route::patch("posts/{id}/update",[PostsController::class,'restore'])->name('posts.restore');

        Route::get("categories/index",[CategoriesController::class,'index'])->name('categories.index');
        Route::post("categories/create",[CategoriesController::class,'create'])->name('categories.create');
        Route::patch("categories/{id}/edit",[CategoriesController::class,'edit'])->name('categories.edit');
        Route::delete("categories/{id}/delete",[CategoriesController::class,'delete'])->name('categories.delete');
    });

    //search / user suggestions
    Route::get('/suggestions', [HomeController::class, 'suggest_all'])->name('suggests');
    Route::get('/people', [HomeController::class, 'search'])->name('search');
});
