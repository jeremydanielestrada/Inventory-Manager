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
        return [
            'product_name' => 'string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image_path'   => 'required|image|mimes:jpg,gif,png|max:5120',
            'price'        => 'required|decimal:0,2',
            'description'  => 'string|nullable|max:255',
            'quantity'     => 'required|integer',
        ];
    }
}
