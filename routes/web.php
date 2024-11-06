<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SpecialMenuController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookedController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SslCommerzPaymentController;

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

Route::get('/register',[UserController::class, 'loadRegister'])->name('register.page');
Route::post('/register',[UserController::class, 'register'])->name('register.store');
Route::get('/login',[UserController::class,'loadLogin'])->name('login.page');
Route::post('/login',[UserController::class,'userLogin'])->name('login');
Route::post('/logout',[UserController::class,'logout'])->name('logout');


Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/about',[AboutController::class, 'index'])->name('about');
Route::get('/menu',[MenuController::class, 'index'])->name('menu');
Route::get('/specialmenu',[SpecialMenuController::class, 'index'])->name('special');
Route::get('/event',[EventController::class, 'index'])->name('event');
Route::get('/chef',[ChefController::class, 'index'])->name('chef');
Route::get('/gallery',[GalleryController::class, 'index'])->name('gallery');
Route::get('/tablebooking',[BookedController::class, 'index'])->name('booked');
Route::post('/tablebooking',[BookedController::class, 'store'])->name('booked.store');

Route::get('/contact',[ContactController::class, 'index'])->name('contact');
Route::post('/contact',[ContactController::class, 'store'])->name('contacts.store');
Route::delete('/contact',[ContactController::class, 'destroy'])->name('contacts.destroy');


Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart-count', [CartController::class, 'getCartCount']);

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('example1');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('example2');

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



Route::get('/testimonial',[TestimonialController::class, 'index'])->name('testimonial');

Route::get('/order-confirmation/{id}', [OrderController::class, 'confirmationById'])->name('order.confirmationbyid');
Route::get('/order-confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');



Route::middleware(['auth', 'role:admin,super admin'])->group(function () {

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::get('/contact/all',[ContactController::class, 'index2'])->name('contact.index');
    Route::resource('reservations', ReservationController::class);
    Route::get('reservations/{reservation}/status', [ReservationController::class, 'editStatus'])->name('reservations.editStatus');
    Route::post('reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
    Route::get('/orderlist', [OrderController::class, 'orderList'])->name('orders.list');
    Route::get('/orders', [OrderController::class, 'order'])->name('orders');
    Route::get('/orders/update/status/{id}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/{id}/status', [OrderController::class, 'changeStatus'])->name('orders.updateStatus');


    Route::resource('roles', RoleController::class);


});