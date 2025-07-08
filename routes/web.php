<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;

//Public Routes


Route::get('/', function(){
    return Inertia::render('Auth/Login');
})->name('login');



Route::inertia('/register', 'Auth/Register')->name('register'); //register

Route::post('/register',  [AuthController::class, 'register'])->name('user.store');




// Route::get('/', function(){
//     return Inertia::render('Home');
// });

// Route::inertia('/about', 'About');
