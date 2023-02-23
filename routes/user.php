<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('dang-nhap', [AuthController::class, 'signIn'])->name('auth.sign-in')
    ->middleware('authCheckMemberLogout');
Route::post('login', [AuthController::class, 'doLogin'])->name('auth.login')
    ->middleware('authCheckMemberLogout');
Route::get('dang-ky', [AuthController::class, 'signUp'])->name('auth.sign-up')
    ->middleware('authCheckMemberLogout');
Route::post('register', [AuthController::class, 'doRegister'])->name('auth.register')
    ->middleware('authCheckMemberLogout');
Route::get('dang-xuat', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('', function () {
    return redirect()->route('home');
});

Route::get('trang-chu', [HomeController::class, 'index'])->name('home');
Route::prefix('san-pham')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{slug}', [ProductController::class, 'getItemBySlug'])->name('products.slug');
});
Route::get('/loc-san-pham', [ProductController::class, 'getFilterProduct'])->name('products.filter');
Route::post('product/get-variant-price', [ProductController::class, 'getVariantPrice']);
Route::get('gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add/{slug}', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('thanh-toan', [PaymentController::class, 'index'])->name('payment.index');
Route::post('payment', [PaymentController::class, 'handlePayment'])->name('payment.handle');
Route::get('ho-so', [ProfileController::class, 'getProfileUser'])->name('profile');
Route::put('ho-so/cap-nhat/{id}', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::get('don-mua', [ProfileController::class, 'getViewOrder'])->name('profile.order');
Route::get('orders/{order}/update', [ProfileController::class, 'updateOrders'])->name('profile.order.update');
Route::get('thong-bao', [ProfileController::class, 'getViewNotifications'])->name('profile.notification');
Route::get('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAtRead']);
