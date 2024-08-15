<?php

namespace App\Http\Requests\UserManagement;

use App\Enums\Civility;
use App\Enums\Gender;
use App\Enums\Status;
use App\Enums\YesNo;
use App\Rules\Rules;
use App\Rules\UniqueValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CollaboratorProfileRequest extends FormRequest
{
    public function rules(): array
    {
        $collaborator = user()->owner;
        return [
            'cin' => ['required','string','max:10',new UniqueValue($collaborator)],
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'dob' => 'nullable|date',
            'gender' => ['required', 'string', Rule::in(Gender::cases())],
            'civility' => ['nullable', 'string', Rule::in(Civility::cases())],
            'phone_number' => 'nullable',
            'email' => ['nullable' , 'email' , new UniqueValue($collaborator)],
            'city' => 'nullable|exists:cities,id',
            'postal_code' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'observation' => 'nullable|string',
            'image' => Rules::ImageValidationRules(),
        ];
    }
}
