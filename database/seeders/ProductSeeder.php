<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $category = \App\Models\Category::first();
    $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

    \App\Models\Product::factory()->count(10)->create([
        'user_id' => $user->id,
         'category_id' => $category->id,
    ]);
    }
}
