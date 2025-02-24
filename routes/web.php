<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
});

Route::middleware('auth', 'admin', 'havePermission')->group(function(){
    // Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    // Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users',[AdminController::class, 'users'])->name('users');
    Route::get('user/add',[AdminController::class, 'add_new'])->name('add_new');
    Route::post('/add_new_post',[AdminController::class, 'add_new_post'])->name('add_new_post');
    Route::get('user/{id}/edit',[AdminController::class, 'edit'])->name('edit');

    Route::resource('hotel', HotelController:: class);
    Route::resource('room', RoomController:: class);
    Route::resource('bookings', BookingController:: class);

    //bookings_before_confirm
    Route::post('bookings_before_confirm',[BookingController::class, 'bookingsBeforeConfirm'])->name('bookings_before_confirm');

    Route::get('manage-role',[RoleController::class, 'manageRole'])->name('manage-role');
    Route::get('create-role',[RoleController::class, 'createRole'])->name('create-role');
    route::post('store-role',[RoleController::class, 'storeRole'])->name('store-role');
    route::get('edit-role/{id}',[RoleController::class, 'editRole'])->name('edit-role');
    route::put('update-role/{id}',[RoleController::class, 'updateRole'])->name('update-role');
    route::delete('delete-role/{id}',[RoleController::class, 'deleteRole'])->name('delete-role');

    Route::resource('permission', PermissionController:: class);

    // assign permission to role routes
    Route::get('assign-permission-role', [PermissionController::class, 'assignPermissionRole'])->name('assignPermissionRole');
    Route::get('assign-new-permission-role', [PermissionController::class, 'assignNewPermissionRole'])->name('assignNewPermissionRole');
    Route::post('assign-new-permission-role', [PermissionController::class, 'assignNewPermissionRolePost'])->name('assignNewPermissionRolePost');
    Route::get('edit-permission-role/{id}', [PermissionController::class, 'editPermissionRole'])->name('editPermissionRole');
    Route::post('edit-assign-permission-role-post', [PermissionController::class, 'editAssignPermissionRolePost'])->name('editAssignPermissionRolePost');
    Route::delete('delete-permission-role/{id}',[PermissionController::class, 'deletePermissionToRole'])->name('deletePermissionToRole');


    //assign permission to route

    Route::get('assign-permission-route',[PermissionController::class, 'assignPermissionRoute'])->name('assignPermissionRoute');
    Route::get('assign-new-permission-route',[PermissionController::class, 'assignNewPermissionRoute'])->name('assignNewPermissionRoute');
    Route::post('assign-new-permission-route-post', [PermissionController::class, 'assignNewPermissionRoutePost'])->name('assignNewPermissionRoutePost');
    Route::get('edit-permission-route/{id}', [PermissionController::class, 'editPermissionRoute'])->name('edit.permission.route');
    Route::post('editAssignPermissionRoutePost', [PermissionController::class, 'editAssignPermissionRoutePost'])->name('editAssignPermissionRoutePost');
    Route::delete('deletePermissionRouter/{id}', [PermissionController::class, 'deletePermissionRouter'])->name('deletePermissionRouter');
});
