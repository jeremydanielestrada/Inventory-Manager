<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(Request $request){
        $User = $request->user();


        return Inertia::render("Profile", [
            "user"=> $User,
        ]);
    }




    public function image(Request $request){

         $request->validate([
        'image' => 'image|mimes:jpeg,gif,png|max:5120', // 5MB max
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

     return redirect()->back()->with('succes','Image updated successfully');


    }

}
