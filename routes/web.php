<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;

//Public Routes

//Login
Route::get('/', function(){
    return Inertia::render('Auth/Login');
})->name('login');
//User validation
Route::post('/login',  [AuthController::class, 'login'])->name('user.login');



//Register
Route::inertia('/register', 'Auth/Register')->name('register');
Route::post('/register',  [AuthController::class, 'register'])->name('user.store');  //register function

//Logout
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');




Route::inertia('/dashboard', 'Dashboard')->name('dashboard');


