<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarDataRequest extends FormRequest
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
            'brand' => 'required|numeric|exists:brands,id',
            'model' => 'required|numeric|exists:car_brand_models,id',
            'price' => 'required|numeric',
            'manufacturingYear' => 'required|numeric|digits:4',
            'year' => 'required|numeric|digits:4',
            'version' => 'string|nullable',
            'color' => 'required|numeric|exists:colors,id',
            'doors' => 'required|numeric',
            'transmission' => 'required|numeric|exists:car_transmissions,id',
            'motor' => 'required|numeric',
            'km' => 'required|numeric',
            'lastDigit' => 'required|numeric',
            'images' => 'nullable|array|max:10|min:2',
            'images.*' => 'image',
            'details' => 'nullable|string',
            'optionals' => 'nullable|array',
            'optionals.*' => 'nullable|numeric|exists:car_optionals,id'
        ];
    }
}
