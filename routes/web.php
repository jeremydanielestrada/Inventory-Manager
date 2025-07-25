<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\UserDashboardController;

//Public Routes

//Login
Route::get('/', function(){
    return Inertia::render('Auth/Login');
})->name('login');
//User validation
Route::post('/login',  [AuthController::class, 'login'])->name('user.login');

//test-route
Route::post('/test-post', function () {
    return response()->json(['message' => 'Success']);
})->middleware('auth');



Route::middleware(['auth'])->group(function(){
//Logout
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');



///Products
Route::get('/products',[ ProductController::class, 'index'])->name('products');
Route::post('/products',[ ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}',[ ProductController::class, 'show'])->name('products.show');
Route::put('/products/{id}',[ ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}',[ ProductController::class, 'destroy'])->name('products.delete');



//Category
Route::post('/category',[ CategoryController::class, 'store'])->middleware(IsAdmin::class)->name('category.store');
Route::inertia('/category', 'Categories')->middleware(IsAdmin::class)->name('categories');



//UserDashboard
Route::get('/dashboard',[ UserDashboardController::class,'index'])->name('dashboard');

});


//Register
Route::inertia('/register', 'Auth/Register')->name('register');
Route::post('/register',  [AuthController::class, 'register'])->name('user.store');  //register function







