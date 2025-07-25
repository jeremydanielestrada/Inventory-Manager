<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function products()
{
    return $this->hasMany(Product::class);
}


protected $primaryKey = 'id';


protected $fillable = [ 'category_name'];


}
