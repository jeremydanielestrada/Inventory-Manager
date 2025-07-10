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

}
