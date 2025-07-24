<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{



    public function view(User $user, Product $product): bool
    {
        return false;
    }


    public function create(User $user): bool
    {
        return false;
    }





    /**
     * Determine whether the user can permanently delete the model.
     */
    public function modify(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }
}
