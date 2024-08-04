<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\TagController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::get("/home", [PostController::class, 'index']);
        Route::post("/post/create", [PostController::class, 'store']);
        Route::post("/logout", [AuthController::class, 'logout']);
        Route::get("/show/post/{post}", [PostController::class, 'show']);
        Route::delete("/delete/post/{post}", [PostController::class, 'destroy']);
        Route::put("/post/update/{post}", [PostController::class, 'update']);

        Route::get("/home/category", [CategoryController::class, 'index']);
        Route::post("/create/category", [CategoryController::class, 'store']);
        Route::delete("/delete/category/{category}", [CategoryController::class, 'destroy']);
        Route::put("update/category/{category}", [CategoryController::class, 'update']);

        Route::get("/home/tag", [TagController::class, 'index']);
        Route::post("/create/tag", [TagController::class, 'store']);
        Route::delete("/delete/tag/{tag}", [TagController::class, 'destroy']);
        Route::put("update/tag/{tag}", [TagController::class, 'update']);

        Route::get("/all/comments", [CommentController::class, 'index']);
        Route::post("/create/comment", [CommentController::class, 'store']);
        Route::put("/update/comment/{comment}", [CommentController::class, 'update']);
        Route::delete("/delete/comment/{comment}", [CommentController::class, 'destroy']);
    }
);
