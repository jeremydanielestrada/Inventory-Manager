<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserDashboardController extends Controller
{
    public function index(Request $request){


        $products = $request->user()->products()->latest()->paginate(10);

        return inertia::render('UserDashboard',[
        'products' => $products,
        'status'   => session('status')
    ]);

    }
}
