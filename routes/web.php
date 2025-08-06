<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

//Public Routes

//Login
Route::get('/', function(){

     if (Auth::check()) {
        return redirect()->route('dashboard');
    }

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
    Route::controller(ProductController::class)->group(function (){

        Route::get('/products', 'index')->name('products');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{product}', 'show')->name('products.show');
        Route::put('/products/{id}', 'update')->name('products.update');
        Route::delete('/products/{id}', 'destroy')->name('products.delete');

    });






//UserDashboard
Route::get('/dashboard',[ UserDashboardController::class,'index'])->name('dashboard');


//Profile
Route::get('/profile',[ ProfileController::class,'index'])->name('profile.index');



});

//Admin Routes
Route::middleware(['auth', isAdmin::class])->group(function(){

//Category
Route::post('/category',[CategoryController::class, 'store'])->name('category.store');
Route::inertia('/category', 'Categories')->name('categories');


//AdminDashboard
Route::get('/admin',[AdminController::class, 'index'])->name('admin.index');
Route::get('/users/{user}',[AdminController::class, 'show'])->name('user.show');
});


//Register
Route::inertia('/register', 'Auth/Register')->name('register');
Route::post('/register',  [AuthController::class, 'register'])->name('user.store');  //register function







