<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoadmapController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\UpvoteController;
use App\Http\Controllers\Api\AuthController;

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
Route::get('/roadmaps', [RoadmapController::class, 'index']);

    Route::post('/login', [AuthController::class, 'login']); 
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); 

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/roadmaps', [RoadmapController::class, 'index']);
    Route::get('/roadmaps/{id}', [RoadmapController::class, 'show']);

    Route::post('/roadmaps/{roadmap}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    Route::post('/roadmaps/{roadmap}/upvote', [UpvoteController::class, 'toggle']);
});
