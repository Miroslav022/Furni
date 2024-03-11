<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
            'address' => 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'country' => 'required|exists:countries,id',
            'city' => 'required|exists:cities,id',

        ];
    }

    public function messages()
    {
        return[
            'address' => "Address must contain letters and numbers only"
        ];
    }
}
