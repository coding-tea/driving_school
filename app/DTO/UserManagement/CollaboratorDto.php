<?php

namespace App\DTO\UserManagement;

use App\DTO\DTO;
use App\Enums\Civility;
use App\Enums\Gender;
use App\Enums\Status;
use App\Enums\YesNo;
use App\Http\Requests\UserManagement\CreateCollaboratorRequest;
use App\Interfaces\DTOInterface;
use App\Models\UserManagement\Collaborator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class CollaboratorDto extends DTO
{

    public function __construct(
        public readonly mixed                     $matricule = null,
        public readonly mixed                     $cin = null,
        public readonly mixed                     $lastName  = null,
        public readonly mixed                     $firstName  = null,
        public readonly mixed                     $id = null,
        public readonly mixed                     $dob = null,
        public readonly mixed                     $function_id = null,
        public readonly mixed                     $category_id = null,
        public readonly mixed                     $contract_type_id = null,
        public readonly mixed                     $gender = null,
        public readonly mixed                     $civility = null,
        public readonly mixed                     $phoneNumber = null,
        public readonly mixed                     $email = null,
        public readonly mixed                     $city = null,
        public readonly mixed                     $postalCode = null,
        public readonly mixed                     $address = null,
        public readonly mixed                     $observation = null,
        public readonly mixed                     $enseignant = null,
        public readonly UploadedFile|string|null $image = null,
    )
    {
    }


    /***
     * @param $data
     * @return CollaboratorDto
     */
    public static function fromFactory($data): self
    {
        return new self(
            matricule: $data['matricule'],
            cin: $data['cin'],
            lastName: $data['last_name'],
            firstName: $data['first_name'],
        );
    }

    /***
     * @param $data
     * @return CollaboratorDto
     */
    public static function fromRequest($request): self
    {

        return new self(
            matricule: $request->validated('matricule'),
            cin: $request->validated('cin'),
            lastName: $request->validated('last_name'),
            firstName: $request->validated('first_name'),
            dob: $request->validated('dob'),
            gender: $request->validated('gender'),
            civility: $request->validated('civility'),
            phoneNumber: $request->validated('phone_number'),
            email: $request->validated('email'),
            city: $request->validated('city'),
            postalCode: $request->validated('postal_code'),
            address: $request->validated('address'),
            observation: $request->validated('observation'),
            function_id: $request->validated('function_id'),
            category_id: $request->validated('category_id'),
            contract_type_id: $request->validated('contract_type_id'),
            enseignant: $request->validated('enseignant'),
            image: $request->validated('image'),
        );
    }


    /***
     * @param Collaborator $collaborator
     * @return self
     */
    public static function fromModel(Collaborator $collaborator): self
    {

        return new self(
            matricule: $collaborator->matricule,
            cin: $collaborator->cin,
            lastName: $collaborator->last_name,
            firstName: $collaborator->first_name,
            id: $collaborator->id,
            dob: $collaborator->dob,
            gender: $collaborator->gender,
            civility: $collaborator->civility,
            phoneNumber: $collaborator->phoneNumber,
            email: $collaborator->email,
            city: $collaborator->city,
            postalCode: $collaborator->postalCode,
            address: $collaborator->address,
            observation: $collaborator->observation,
            function_id: $collaborator->function_id,
            category_id: $collaborator->category_id,
            contract_type_id: $collaborator->contract_type_id,
            enseignant: $collaborator->enseignant,
            image: $collaborator->image,
        );
    }

    /***
     * @return string
     */
    public function fullname()
    {
        return $this->lastName . ' ' . $this->firstName;
    }

    /***
     * @return Carbon|string|null
     */
    public function dob()
    {
        if (empty($this->dob)) {
            return $this->dob;
        }
        return Carbon::parse($this->dob);
    }

    /***
     * @return Gender|YesNo
     */
    public function gender()
    {
        return Gender::tryFrom($this->gender) ?? YesNo::NO;
    }

    /***
     * @return Civility|YesNo
     */
    public function civility(): Civility|YesNo
    {
        return Civility::tryFrom($this->civility) ?? YesNo::NO;
    }


    public function passwordFormat()
    {
        return $this->cleanString($this->lastName) . '-' . $this->cleanString($this->firstName) . '@' . $this->matricule;
    }

    private function cleanString($string)
    {
        return trim($string);
    }


}
