<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function index(){
        $users = User::with('products')
            ->where(function ($query) {
            if (request('search')) {
                $query->where('firstName', 'like', '%' . request('search') . '%')
                      ->orWhere('lastName', 'like', '%' . request('search') . '%')
                      ->orWhere('email', 'like', '%' . request('search') . '%');
                   }
        })
         ->paginate(10);

       $categories = Category::withCount('products')->get();

       $totalProducts = Product::count();


    // Add percent to each category
    $categories->transform(function ($category) use ($totalProducts) {
        $category->percentage = $totalProducts > 0
            ? round(($category->products_count / $totalProducts) * 100, 2)
            : 0;

        return $category;
    });

        return Inertia::render('AdminDashboard',
         [
            'users'=> $users,
            'categories' => $categories,

        ]);

    }



    public function show(User $user){
                                //get the product function from the user model
        $user_products = $user->products()->latest()
         ->where(function ($query) {
            if (request('search')) {
                $query->where('product_name', 'like', '%' . request('search') . '%');
            }
        })

        ->paginate(10)
        ->withQueryString();


        return Inertia::render('UserPage',[
            'user' => $user,
            'products' => $user_products
        ]);
    }
}
