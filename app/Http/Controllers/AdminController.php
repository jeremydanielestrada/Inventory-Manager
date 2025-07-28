<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){

        $users = User::with('products')->paginate(10);


        return Inertia::render('AdminDashboard',
         [
            'users'=> $users

        ]);

    }
}
