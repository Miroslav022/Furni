<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            "first_name" => "required|min:3",
            "last_name" => "required|min:3",
            "country" => "required|exists:countries,id",
            "city" => "required|exists:cities,id",
            "address" => "required|min:3",
            "username" => "required|min:3",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/",
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => "Password must contain characters from at least three of the following categories: uppercase letters, lowercase letters, digits (0-9), non-alphanumeric (!, $, #, or %), and Unicode characters."
        ];
    }
}
