<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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

          if(request()->routeIs('user.login')) {
        return [
            "email"     => "required|string|max:255",
            "password"  => "required|min:8",
        ];
        } else  if(request()->routeIs('user.store')) {

        return [
            //Set rules
            "firstName"      => "required|string|max:255",
            "lastName"       => "required|string|max:255",
            "role"           => "nullable|string",
            "email"          => "required|string|email|unique:App\Models\Use55r,email|max:2",
            "password"       => "required|min:8|confirmed",

        ];

    }

      return [];
}

}
