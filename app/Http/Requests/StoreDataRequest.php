<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'store_number' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,11',
            'whatsapp' => 'required|numeric|digits_between:10,11',
            'users' => 'required|array',
            'users.*' => 'nullable|required|numeric|exists:users,id',
            'logo_url' => 'nullable|file|mimes:png,jpg,jpeg,gif,webp|max:1024'
        ];
    }
}
