<?php

namespace App\Http\Requests;

use App\Enums\Civility;
use App\Enums\Gender;
use App\Rules\Rules;
use App\Rules\UniqueValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'dob' => 'required|date',
            'email' => ['required', 'email', 'max:255',  new UniqueValue($user)],
            'cin' => ['required', 'max:255', new UniqueValue($user)],
            'description' => 'required|string',
            'city' => 'required|string|exists:cities,id',
            'phone_number' => 'required|string',
            'image' => Rules::ImageValidationRules(),
            'gender' => ['required', 'string', Rule::in(Gender::cases())],
            'civility' => ['required', 'string', Rule::in(Civility::cases())],
        ];
    }
}
