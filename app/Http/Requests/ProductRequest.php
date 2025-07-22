<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
{
    if(request()->routeIs('products.store')){
        return [
            'product_name'=> 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'image_path'  => 'required|image|mimes:jpeg,gif,png|max:5120',
            'description' => 'nullable|string|max:255',
        ];
    } else if(request()->routeIs('products.update')){
        return [
            'product_name'=> 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'description' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,gif,png|max:5120'
        ];



    }
    return [] ;
    // Default rules
    // return [
    //     'product_name'=> 'required|string|max:255',
    //     'category_id' => 'required|exists:categories,id',
    //     'price'       => 'required|numeric',
    //     'quantity'    => 'required|integer',
    //     'image_path'  => 'required|image|mimes:jpeg,gif,png|max:5120',
    //     'description' => 'nullable|string|max:255',
    // ];
}

}
