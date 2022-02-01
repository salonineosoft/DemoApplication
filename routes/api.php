<?php

use App\Http\Controllers\Frontend\ConfigrationController;
use App\Http\Controllers\Frontend\BannerApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\JWTController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\CategoryApiController;
use App\Http\Controllers\Frontend\ProductApiController;
use App\Http\Controllers\Frontend\UserDetailController;
use App\Http\Controllers\Frontend\orderDetailController;
use App\Http\Controllers\Frontend\CmsApiController;
use App\Http\Controllers\Frontend\WishlistApiController;
use App\Http\Controllers\Frontend\CouponApiController;

use App\Http\Controllers\Frontend\NewsLetterController;


use App\Models\Configration;

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
Route::group(['middleware'=>'api'], function($router){
Route::post('/register', [JWTController::class, 'register']);
Route::post('/login', [JWTController::class, 'login']);
Route::post('/logout', [JWTController::class, 'logout']);
Route::post('/refresh', [JWTController::class, 'refresh']);
Route::get('profile',[JwtController::class,'profile']);
Route::post('/updateprofile',[JWTController::class,'updateProfile']);
Route::post('/changepassword',[JWTController::class,'changepassword']);
Route::get('/Configration',[ConfigrationController::class,'configration']);


});
Route::post('/NewsLetter',[NewsLetterController::class,'PostNewsLetter']);
Route::apiResource('/contact', ContactUsController::class)->except('create','show','edit','update','destroy');
Route::apiResource('/banners', BannerApiController::class)->except('create','store','show','edit','update','destroy');
Route::apiResource('/category', CategoryApiController::class)->except('create','store','edit','update','destroy');
Route::apiResource('/products', ProductApiController::class)->except('create','store','edit','update','destroy');
Route::apiResource('/userDetails', UserDetailController::class)->except('create','index','edit','update','destroy');
Route::apiResource('/orderDetails', orderDetailController::class)->except('create','edit','update','destroy');
Route::apiResource('/cms', CmsApiController::class)->except('create','store','edit','update','destroy');
Route::apiResource('/wishlist', WishlistApiController::class)->except('create','edit','update');
Route::apiResource('/coupons', CouponApiController::class)->except('create','store','edit','update','destroy');





