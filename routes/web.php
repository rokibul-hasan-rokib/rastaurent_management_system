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
use App\Http\Controllers\ProductController;



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

Route::get('/register',[UserController::class, 'loadRegister']);
Route::post('/register',[UserController::class, 'register'])->name('register.store');
Route::get('/login',[UserController::class,'loadLogin'])->name('login.page');
Route::post('/login',[UserController::class,'userLogin'])->name('login');


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
Route::get('/testimonial',[TestimonialController::class, 'index'])->name('testimonial');


Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');



Route::resource('products', ProductController::class);


Route::resource('reservations', ReservationController::class);
Route::get('reservations/{reservation}/status', [ReservationController::class, 'editStatus'])->name('reservations.editStatus');
Route::post('reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');