<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserTokenController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductRatingController;

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

Route::resource('products', ProductController::class)->middleware('auth:sanctum');
Route::resource('categories', CategoryController::class);

Route::post('sanctum/token', UserTokenController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('newsletter/send', [NewsletterController::class, 'send'])->name('send.newsletter');
    Route::post('products/{product}/rate', [ProductRatingController::class, 'rate']);
    Route::post('products/{product}/unrate', [ProductRatingController::class, 'unrate']);
});
