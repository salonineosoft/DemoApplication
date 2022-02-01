<?php

use App\Http\Controllers\Admin\AdminControl;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Configration;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\PdfController;
use App\Models\category;
use Illuminate\Database\Eloquent\Model;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/dashboard', function () {
    return view('dashboard');
});

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


 
 Route::middleware([admin::class])->group(function(){
 Route::namespace('App\Http\Controllers\Admin')->group(function(){ 
 Route::resource('categories', CategoryController::class)->except('show');
 Route::resource('banners', BannerController::class)->except('show');
 Route::resource('users', UserController::class)->except('show');
 Route::resource('coupons', CouponController::class)->except('show');
 Route::resource('products', ProductController::class)->except('show');
 Route::get('Image/{id}', [ImageController::class,'image']);
 Route::resource('configrations', ConfigrationController::class)->except('store','destroy');
 Route::resource('cms', 'CmsController')->except('show');
 Route::get('/Charts',[ChartController::class,'salesReport']);
 Route::get('/UserChart',[ChartController::class,'userReport']);
 Route::get('/CouponChart',[ChartController::class,'couponReport']);
 Route::get('/EditOrder/{id}',[OrderController::class,'edit']);
 Route::post('/UpdateOrder',[OrderController::class,'update']);
 Route::get('/export_user_pdf', [PdfController::class,'export_user_pdf']);
 Route::get('/view_user_pdf', [PdfController::class,'view_user_pdf']);
});

Route::get('/ShowOrder', [OrderController::class,'order']);
});

 

