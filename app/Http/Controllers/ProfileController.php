<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(Request $request){
        $User = $request->user();


        return Inertia::render("SideNavigation", [
            "user"=> $User,
        ]);
    }
}
