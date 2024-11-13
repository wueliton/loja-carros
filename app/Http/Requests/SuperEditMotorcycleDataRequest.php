<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuperEditMotorcycleDataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'storeId' => 'required|numeric|exists:stores,id',
            'brand' => 'required|numeric|exists:brands,id',
            'model' => 'required|numeric|exists:motorcycle_brand_models,id',
            'price' => 'required|numeric',
            'type' => 'required|numeric|exists:motorcycle_types,id',
            'manufacturingYear' => 'required|numeric|digits:4',
            'year' => 'required|numeric|digits:4',
            'cylinder' => 'required',
            'motor' => 'string|nullable',
            'color' => 'required|numeric|exists:colors,id',
            'km' => 'required|numeric',
            'optionals' => 'nullable|array',
            'optionals.*' => 'nullable|numeric|exists:motorcycle_optionals,id',
            'images' => 'nullable|array',
            'details' => 'nullable|string'
        ];
    }
}
