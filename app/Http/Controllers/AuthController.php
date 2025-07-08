<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{


    public function register(UserRequest $request){

            sleep(1);

            //Validate
            $validated = $request->validated();

            //Encrypt password using Hash class/function
            $validated['password'] = Hash::make($validated['password']);

            //Regitser
            $user = User::create($validated);

            //Login
            Auth::login($user);

            //Redirect
            return redirect()->route('dashboard');


    }
};
