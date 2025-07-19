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
            return redirect()->route('products');


    }


    public function login(UserRequest $request){

        sleep(1);

        //Validate
        $validate = $request->validated();


        //Attempt to log  validation/credentials
        if (Auth::attempt($validate, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('products');
        }
        //return back if there's an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


 public  function  logout(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');


    }
};
