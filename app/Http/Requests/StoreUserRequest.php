<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();  // Only authorized users can make this request.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'password' => 'required|string|min:6|confirmed',           
            'roles' => 'required', 'array',                   
            'roles.*' => 'exists:roles,name',         
        ];
    }
}
