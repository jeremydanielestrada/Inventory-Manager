<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function category()
{
    return $this->belongsTo(Category::class);
}
protected $table="products";
protected $fillable = ['
    product_name',
   'image_path',
   'category_id',
   'description',
   'quantity',
   'price'

   ];




    //For filtering
   public function scopeFilter($query, array $filters){

       if ($filters['search'] ?? false) {
            $query
            ->where('product_name', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%');
        }


        // if($filters['category'] ?? false) {
        //         $query->where('category_name', request('category'));
        // }

          }

}
