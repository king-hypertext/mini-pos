<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name',
            'description' => 'nullable|string',
            'market_price' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1|gt:market_price',
            'expiry_date' => 'nullable|date|after:' . now()->addMonth()->format('Y-m-d'),
            'image' => 'nullable|file|mimes:png,jpg,jpeg,webp',
            'quantity' => 'nullable|integer',
            // 'product_status' => 'nullable|exists:product_statuses,id',
            // 'brand' => 'required|exists:brands,id',
            // 'category' => 'required|exists:categories,id',
            // 'size' => 'required|exists:product_sizes,id',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Product already exists',
            'price.gt' => 'Price must be greater than Market Price'
        ];
    }
}
