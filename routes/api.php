<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/admin-login', [UserController::class, 'index'])->name('login');


Route::group([
    "middleware" => ['auth:api']
], function(){
    Route::get('/list', [UserController::class, 'list'])->name('list');
});
