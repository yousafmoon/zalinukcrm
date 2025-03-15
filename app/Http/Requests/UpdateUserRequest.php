<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isEdit = $this->route()->getName() === 'users.update'; 

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . ($isEdit ? $this->route('user')->id : '')],
            'image' => ['nullable', 'file', 'image', 'max:300'],
            'password' => $isEdit
                ? ['nullable', 'string', 'min:8', 'confirmed'] 
                : ['required', 'string', 'min:8', 'confirmed'], 
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id'],
           
        ];
    }
}

