<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use Illuminate\Support\Facades\Hash;
class AuthController
{


    public function register(userRequest $request){

            sleep(1);

            //Validate
            $request->validated();

            // $validated['password'] = Hash::make($validated['password']);

            dd('pass');

    }
}
