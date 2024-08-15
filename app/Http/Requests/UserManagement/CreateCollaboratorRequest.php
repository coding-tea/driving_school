<?php

namespace App\Http\Requests\UserManagement;

use App\Enums\Civility;
use App\Enums\Gender;
use App\Enums\Status;
use App\Enums\YesNo;
use App\Rules\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCollaboratorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'matricule' => 'required|string|max:10|unique:collaborators',
            'cin' => 'required|string|max:10|unique:collaborators',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'dob' => 'nullable|date',
            'gender' => ['required', 'string', Rule::in(Gender::cases())],
            'civility' => ['nullable', 'string', Rule::in(Civility::cases())],
            'phone_number' => 'nullable',
            'email' => 'nullable',
            'city' => 'nullable|exists:cities,id',
            'postal_code' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'observation' => 'nullable|string',
            'enseignant' => 'nullable|boolean',
            'image' => Rules::ImageValidationRules(),
            'is_admin' => ['required', 'string', Rule::in(YesNo::cases())],
            'is_manager' => ['required', 'string', Rule::in(YesNo::cases())],
            'status' => ['required', 'string', Rule::in(Status::cases())],
        ];
    }
}
