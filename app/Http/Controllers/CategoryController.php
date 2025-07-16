<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $category = $request->validate(['category_name' => 'required', 'string']);
       Category::create($category);
    }






}
