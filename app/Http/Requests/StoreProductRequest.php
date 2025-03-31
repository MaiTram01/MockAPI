<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unitPrice' => 'required|numeric|min:0', 
            'promotionPrice' => 'nullable|numeric|min:0', 
            'image' => 'nullable|string', 
            'unit' => 'nullable|string|max:50',
            'new' => 'nullable|boolean',
        ];
    }
}
