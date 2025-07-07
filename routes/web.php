<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Public Routes





Route::get('/', function(){
    return Inertia::render('Home');
});



Route::inertia('/about', 'About');
