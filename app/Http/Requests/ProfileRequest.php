<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'name_ar' => 'required|string',
            'cin' => 'required|string|max:10',
            'adress' => 'required|string|',
            'birthday' => 'required|string|max:100',
            'birth_city' => 'required|string',
            'reference' => 'required|string|max:100',
            'signin_date' => 'required|string',
            'image' => 'nullable|image',
            'cinimage' => 'nullable|image',
        ];
    }
}
