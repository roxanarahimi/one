<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientAddressController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserAddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//    ->middleware(['signed', 'throttle:6,1'])
//    ->name('verification.verify');
//
//// Resend link to verify email
//Route::post('/email/verify/resend', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();
//    return back()->with('message', 'Verification link sent!');
//})->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');


//Route::middleware('auth:api')->group(function () {
    Route::get('/panel/user', [AuthController::class, 'currentUser']);
//    Route::get('/panel/admin/logout/{user}', [AuthController::class, 'logout']);
//});

//Route::middleware('auth:admin')->group(function () {
//    Route::get('/panel/admin', [AuthController::class, 'currentAdmin']);
//    Route::post('/panel/admin/logout', [AuthController::class, 'adminLogout']);
//});

Route::prefix('panel')->group(function () {
    Route::get('/user/logout/{user}', [AuthController::class, 'logout']);

    Route::post('/admin/login', [AuthController::class, 'login']);
    Route::post('/admin/register', [AuthController::class, 'register']);
    Route::post('/check/admin/token', [AuthController::class, 'updateLastActivity']);

    Route::post('/user/login', [AuthController::class, 'login']);
    Route::post('/user/register', [AuthController::class, 'register']);
    Route::post('/check/user/token', [AuthController::class, 'updateLastActivity']);

    Route::post('/update/user', [UserController::class, 'updateProfile']);
    Route::get('/users', [UserController::class, 'indexUsers']);
    Route::get('/user/{user}', [UserController::class, 'show']);
    Route::post('/user', [UserController::class, 'store']);
    Route::post('/user/{user}', [UserController::class, 'update']);
    Route::post('/delete/user', [UserController::class, 'destroy']);

    Route::post('/update/admin', [UserController::class, 'updateProfile']);
    Route::get('/admins', [UserController::class, 'indexAdmins']);
    Route::get('/admin/{admin}', [UserController::class, 'show']);
    Route::post('/admin', [UserController::class, 'store']);
    Route::post('/admin/{admin}', [UserController::class, 'update']);
    Route::post('/delete/admin', [UserController::class, 'destroy']);

    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/{product}', [ProductController::class, 'show']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::post('/product/{product}', [ProductController::class, 'update']);
    Route::post('/delete/product', [ProductController::class, 'destroy']);

    Route::get('/active/product/{product}', [ProductController::class, 'activeToggle']);
    Route::get('/latest/product', [ProductController::class, 'latest']);

    Route::get('/category/product', [ProductCategoryController::class, 'index']);
    Route::get('/category/product/{productCategory}', [ProductCategoryController::class, 'show']);
    Route::post('/category/product', [ProductCategoryController::class, 'store']);
    Route::post('/category/product/{productCategory}', [ProductCategoryController::class, 'update']);
    Route::post('/delete/category/product', [ProductCategoryController::class, 'destroy']);
    Route::get('/active/category/product/{productCategory}', [ProductCategoryController::class, 'activeToggle']);


    Route::get('/article', [ArticleController::class, 'index']);
    Route::get('/article/{article}', [ArticleController::class, 'show']);
    Route::post('/article', [ArticleController::class, 'store']);
    Route::post('/article/{article}', [ArticleController::class, 'update']);
    Route::post('/delete/article', [ArticleController::class, 'destroy']);

    Route::get('/active/article/{article}', [ArticleController::class, 'activeToggle']);
    Route::get('/latest/article', [ArticleController::class, 'latest']);

    Route::get('/category/article', [ArticleCategoryController::class, 'index']);
    Route::get('/category/article/{articleCategory}', [ArticleCategoryController::class, 'show']);
    Route::post('/category/article', [ArticleCategoryController::class, 'store']);
    Route::post('/category/article/{articleCategory}', [ArticleCategoryController::class, 'update']);
    Route::post('/delete/category/article', [ArticleCategoryController::class, 'destroy']);
    Route::get('/active/category/article/{articleCategory}', [ArticleCategoryController::class, 'activeToggle']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/order/{order}', [OrderController::class, 'showPanel']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::post('/order/{order}', [OrderController::class, 'update']);
    Route::post('/delete/order', [OrderController::class, 'destroy']);


    Route::get('/slide', [SlideController::class, 'index']);
    Route::get('/slide/{slide}', [SlideController::class, 'show']);
    Route::post('/slide', [SlideController::class, 'store']);
    Route::post('/slide/{slide}', [SlideController::class, 'update']);
    Route::post('/delete/slide', [SlideController::class, 'destroy']);
    Route::get('/active/slide/{slide}', [SlideController::class, 'activeToggle']);

    Route::get('/finance', [FinanceController::class, 'index']);
    Route::get('/finance/{finance}', [FinanceController::class, 'show']);
    Route::post('/finance', [FinanceController::class, 'store']);
    Route::post('/finance/{finance}', [FinanceController::class, 'update']);
    Route::post('/delete/finance', [FinanceController::class, 'destroy']);
//    Route::get('/active/finance/{finance}', [FinanceController::class, 'activeToggle']);

//
//    Route::get('/project', [ProjectController::class, 'index']);
//    Route::get('/project/{project}', [ProjectController::class, 'show']);
//    Route::post('/project', [ProjectController::class, 'store']);
//    Route::post('/project/{project}', [ProjectController::class, 'update']);
//    Route::post('/delete/project', [ProjectController::class, 'destroy']);

    Route::resource('project', ProjectController::class);

    Route::get('/course', [CourseController::class, 'index']);
    Route::get('/course/{course}', [CourseController::class, 'show']);
    Route::post('/course', [CourseController::class, 'store']);
    Route::post('/course/{course}', [CourseController::class, 'update']);
    Route::post('/delete/course', [CourseController::class, 'destroy']);
    Route::get('/active/course/{course}', [CourseController::class, 'activeToggle']);
    Route::get('/latest/course', [CourseController::class, 'latest']);



    Route::get('/category/course', [CourseCategoryController::class, 'index']);
    Route::get('/category/course/{courseCategory}', [CourseCategoryController::class, 'show']);
    Route::post('/category/course', [CourseCategoryController::class, 'store']);
    Route::post('/category/course/{courseCategory}', [CourseCategoryController::class, 'update']);
    Route::post('/delete/category/course', [CourseCategoryController::class, 'destroy']);
    Route::get('/active/category/course/{courseCategory}', [CourseCategoryController::class, 'activeToggle']);


    Route::get('/resume', [ResumeController::class, 'index']);
    Route::get('/resume/{resume}', [ResumeController::class, 'show']);
    Route::get('/delete/resume/{resume}', [ResumeController::class, 'destroy']);
});


Route::get('/product', [ProductController::class, 'indexSite']);
Route::get('/product/{product}', [ProductController::class, 'show']);
Route::get('/latest/product', [ProductController::class, 'latestSite']);
Route::get('/stock/product', [ProductController::class, 'stockSite']);
Route::get('/sizes/product/{id}/{color}', [ProductController::class, 'getSizes']);


Route::get('/category/product', [ProductCategoryController::class, 'indexSite']);
Route::get('/category/product/{productCategory}', [ProductCategoryController::class, 'show']);


Route::get('/article', [ArticleController::class, 'indexSite']);
Route::get('/article/{article}', [ArticleController::class, 'show']);
Route::get('/latest/article', [ArticleController::class, 'latestSite']);

Route::get('/category/article', [ArticleCategoryController::class, 'indexSite']);
Route::get('/category/article/{articleCategory}', [ArticleCategoryController::class, 'show']);

Route::get('/slide', [SlideController::class, 'indexSite']);


Route::get('/order', [OrderController::class, 'index']);
Route::get('/order/{order}', [OrderController::class, 'show']);
Route::post('/order', [OrderController::class, 'store']);
Route::post('/order/{order}', [OrderController::class, 'update']);
Route::post('/delete/order', [OrderController::class, 'destroy']);

Route::post('/pay/order/{order}', [OrderController::class, 'userToGateway']);
Route::get('/verify/order/{order}', [OrderController::class, 'verify']);
Route::post('/confirm/order/{order}', [OrderController::class, 'confirm']);

Route::post('/remove/order/item/{orderItem}', [OrderController::class, 'removeItem']);

Route::post('/cancel/order', [OrderController::class, 'cancelByUser']);
Route::get('/userOrders/{user}', [OrderController::class, 'userOrders']);


Route::get('/cart/{user}', [OrderController::class, 'cart']);
Route::post('/item/quantity/update', [OrderController::class, 'updateItemQuantity']);
Route::post('/item/remove', [OrderController::class, 'removeItem']);


Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/check/user/token', [AuthController::class, 'updateLastActivity']);
Route::get('/user/logout/{user}', [AuthController::class, 'logout']);
Route::post('/user/logout', [AuthController::class, 'logout']);

Route::post('/update/user', [UserController::class, 'updateProfile']);
Route::get('/users', [UserController::class, 'indexUsers']);
Route::get('/admins', [UserController::class, 'indexAdmins']);
Route::get('/user/{user}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::post('/user/{user}', [UserController::class, 'update']);
Route::post('/delete/user', [UserController::class, 'destroy']);


Route::get('/address/user', [UserAddressController::class, 'index']);
Route::get('/address/user/{userAddress}', [UserAddressController::class, 'show']);
Route::post('/address/user', [UserAddressController::class, 'store']);
Route::post('/address/user/{clientAddress}', [UserAddressController::class, 'update']);
Route::post('/delete/address/user', [UserAddressController::class, 'destroy']);


Route::get('/get/otp/{mobile}', [UserController::class, 'getOtpNoRedis']);//getOtp
Route::post('/verify/otp', [UserController::class, 'verifyOtp']);
Route::get('/login/otp/{user}', [UserController::class, 'loginOtp']);

Route::get('/otp1', [UserController::class, 'otp1']);
Route::get('/otp2', [UserController::class, 'otp2']);
