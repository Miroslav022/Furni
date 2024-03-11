<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;;

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
            "product_name" => 'required|min:3',
            'category'=>"required|exists:categories,id",
            'inventory'=>"required|exists:inventories,id",
            'quantity' => "required|numeric",
            'price' => "required|numeric",
            'bg_image' => [
                'required',
                File::types(['jpg', 'jpeg', 'png', 'webp'])
            ],
            'images.*' => [
                'required',
                File::types(['jpg', 'jpeg', 'png', 'webp'])
            ],
            'description' => 'required',
            'materials' => 'required|exists:materials,id'
        ];
    }
}
