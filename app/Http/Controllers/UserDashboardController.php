<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;

class UserDashboardController extends Controller
{
    public function index(Request $request){


        $products = $request->user()->products()->latest()->paginate(10);
        $categories = Category::with("products")->get();

        return inertia::render('UserDashboard',[
        'products' => $products,
        'categories' => $categories,
        'status'   => session('status')
    ]);

    }
}
