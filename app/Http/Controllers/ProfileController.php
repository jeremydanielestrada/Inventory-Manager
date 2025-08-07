<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\User;
class ProfileController extends Controller
{
    public function index(Request $request){
        $User = $request->user();


        return Inertia::render("Profile", [
            "user"=> $User,
            "status" =>  session('success')
        ]);
    }




    public function image(Request $request){

         $request->validate([
        'image' => 'required|image|mimes:jpeg,gif,png|max:5120', // 5MB max
      ]);


    $user = $request->user();

         // If new image is uploaded
     // Delete old image if exists

     if($request->hasFile('image')){

    if (!is_null($user->image)) {
        Storage::disk('public')->delete($user->image);
    }

         // Store new image
    $user->image = $request->file('image')->storePublicly('avatar', 'public');

        // Save new image path to user
     $user->save();
    }

     return redirect()->back()->with('success','Image updated successfully');


    }



    public function update(Request $request){


        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
        ]);

        $user = $request->user();


        $user->update($validated);


        return redirect()->back()->with('success','Info updated successfully');

     }



     public function password(Request $request){

        $validated = $request->validate([

            "password"=> "required|min:8|confirmed",
        ]);

        $validated["password"] = Hash::make($validated["password"]);

        $user = $request->user();


        $user->update($validated);


        return redirect()->back()->with('success','Password updated successfully');



     }

}
