<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::post('/search', [WebsiteController::class, 'getInfo'])->name('search');
Route::get('/user-registration', [WebsiteController::class, 'user_registration'])->name('user_registration');
Route::post('/front-registration', [WebsiteController::class, 'registration'])->name('frontend.registration');

Route::middleware('guest')->group(function(){
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/admin-login', [AdminController::class, 'admin_login_post'])->name('admin_login_post');
});


Route::middleware('auth', 'admin')->group(function(){
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users',[AdminController::class, 'users'])->name('users');
    Route::get('user/add',[AdminController::class, 'add_new'])->name('add_new');
    Route::post('/add_new_post',[AdminController::class, 'add_new_post'])->name('add_new_post');
    Route::get('user/{id}/edit',[AdminController::class, 'edit'])->name('edit');

    Route::resource('hotel', HotelController:: class);
    Route::resource('room', RoomController:: class);
    Route::resource('bookings', BookingController:: class);

    //bookings_before_confirm
    Route::post('bookings_before_confirm',[BookingController::class, 'bookingsBeforeConfirm'])->name('bookings_before_confirm');
});


Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return 'Admin Page';
    });
});
