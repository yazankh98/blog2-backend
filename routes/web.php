<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MangeUsersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterByAdminController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
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

Route::middleware(['auth'])->group(
    function () {
        Route::get("/logout", [AuthController::class, 'logout'])->name('logout');

        Route::get("/home", [PostController::class, 'index'])->name('posts.home');
        Route::get("/post/create", [PostController::class, 'create'])->name('posts.create');
        Route::post("/post/store", [PostController::class, 'store'])->name('posts.store');
        Route::delete("/post/delete/{post}", [PostController::class, 'destroy'])->name('post.delete');
        Route::get("/post/edit/{post}", [PostController::class, 'edit'])->name('post.edit');
        Route::put("/post/update/{post}", [PostController::class, 'update'])->name('post.update');
        Route::get("/post/show/{post}", [PostController::class, 'show'])->name('post.show');


        Route::get("/add/tags", [TagController::class, 'index'])->name('add.tags');
        Route::post("/tag/store", [TagController::class, 'store'])->name('tag.store');
        Route::delete("/tag/delete/{tag}", [TagController::class, 'destroy'])->name('tag.delete');

        Route::get("/add/category", [CategoryController::class, 'index'])->name('add.category');
        Route::post("/Category/store", [CategoryController::class, 'store'])->name('category.store');
        Route::delete("/Category/delete/{category}", [CategoryController::class, 'destroy'])->name('Category.delete');
        Route::get("/Category/edit/{category}", [CategoryController::class, 'edit'])->name('category.edit');
        Route::put("/Category/update/{category}", [CategoryController::class, 'update'])->name('post.update');

        Route::get("/profile/image", [UserController::class, 'index'])->name('add.image');
        Route::post("/update/image", [UserController::class, 'update'])->name('update.image');
        Route::delete("/profile/delete/{id}", [UserController::class, 'destroy'])->name('profileImg.delete');

        Route::post("/comment/store/{id}", [CommentController::class, 'store'])->name('comment.store');
        Route::delete("/comment/delete/{comment}", [CommentController::class, 'destroy'])->name('comment.delete');
        Route::get("/comment/edit/{comment}", [CommentController::class, 'edit'])->name('comment.edit');
        Route::put("/update/comment/{comment}", [CommentController::class, 'update'])->name('comment.update');

        Route::get("/mange/users", [MangeUsersController::class, 'index'])->name('mange.users');
        Route::put("/block/user/{id}", [MangeUsersController::class, 'block'])->name('block.users');
        Route::put("/unblock/user/{id}", [MangeUsersController::class, 'unblock'])->name('unblock.users');
        Route::post("/register/by/admin", [ RegisterByAdminController::class, 'registerByAdmin'])->name('register.by.admin');
    }
);

Route::middleware(['guest'])->group(
    function () {

        Route::get("/", [AuthController::class, 'showLoginForm'])->name('login');
        Route::post("/login", [AuthController::class, 'login']);
        Route::get("/register", [AuthController::class, 'showRegisterForm'])->name('showFormRegister');
        Route::post("/register", [AuthController::class, 'register'])->name('register');
    }
);
