<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\CutController;
use App\Http\Controllers\api\ColorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ShapeController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\api\PolishController;
use App\Http\Controllers\api\ClarityController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartAddressController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\VerifyEmailController;
use App\Http\Controllers\DiamondMaster\DiamondMasterController;
use App\Http\Controllers\Api\PayPalController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
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

Route::get('/get-all-products', [ProductController::class, 'jewelryData']);
Route::get('/get-all-engagementData/{slug?}', [ProductController::class, 'engagementData']);
Route::get('/jewelry', [CategoryController::class, 'jewelryData']);
Route::get('/get-all-styleShapeData', [ShapeController::class, 'styleShapeData']);
Route::get('/product-by-id/{id}', [ProductController::class, 'showById']);
Route::get('/engagement-buildproduct/{id}', [ProductController::class, 'showBuildProductById']);
Route::get('/jewelry-product/{id}', [ProductController::class, 'showRegularProductById']);
Route::get('/get-all-diamonds', [DiamondMasterController::class, 'data']);
Route::post('/contact', [ContactController::class, 'submit']);
//shape
Route::get('/diamond-shapes', [ShapeController::class, 'getFrontShapes']);
Route::get('diamonds/by-shape/{shape_id}', [ShapeController::class, 'filterDiamondsByShape']);
//color
Route::get('/diamond-colors', [ShapeController::class, 'getFrontColors']);
Route::get('diamonds/by-color/{color_id}', [ColorController::class, 'filterDiamondsByColor']);
//Cut
Route::get('diamonds/by-cut/{cut_id}', [CutController::class, 'filterDiamondsByCut']);
//clarity
Route::get('diamonds/by-clarity/{clarity_id}', [ClarityController::class, 'filterDiamondsByClarity']);

Route::get('diamonds/by-polish/{polish_id}', [PolishController::class, 'filterDiamondsByPolish']);

// Route::post('/register', [RegisterController::class, 'register']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->name('verification.verify');


// Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Route::middleware('auth:sanctum')->get('/logout', [LogoutController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::post('/password/email', [AuthController::class, 'sendResetLink']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);

Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'forgetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::post('/profile/update', [ProfileController::class, 'updateProfile']);
    Route::post('/reset-password-auth', [AuthController::class, 'resetPassword']);

});
Route::post('/add-to-cart', [CartController::class, 'store']);
Route::get('/user-address/{user_id}', [AddressController::class, 'getAddress']);
Route::post('/store-addresses', [AddressController::class, 'store']);
Route::post('/store-order', [OrderController::class, 'store']);
Route::middleware('auth:sanctum')->get('/get-orders', [OrderController::class, 'index']);

Route::post('/paypal/create-order', [PayPalController::class, 'createOrder'])->name('paypal.create');
Route::get('/paypal/capture', [PayPalController::class, 'captureOrder'])->name('paypal.capture');
Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');
