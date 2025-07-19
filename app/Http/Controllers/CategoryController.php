<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;



class CategoryController extends Controller
{

    public function index(){

        return Category::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $category = $request->validate(['category_name' => 'required|string|max:255']);

       Category::create($category);

      return redirect()->back()->with('success', 'Category created successfully!');

    }






}
