<?php

namespace App\DTO;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProfileDto extends DTO
{
    public function __construct(
        public readonly String $name,
        public readonly String $name_ar,
        public readonly String $cin,
        public readonly String $adress,
        public readonly String $birthday,
        public readonly String $birth_city,
        public readonly String $reference,
        public readonly String $signin_date,
        public readonly UploadedFile|null $image,
        // public readonly UploadedFile|null $cinimage,
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->validated('name'),
            name_ar: $request->validated('name_ar'),
            cin: $request->validated('cin'),
            adress: $request->validated('adress'),
            birthday: $request->validated('birthday'),
            birth_city: $request->validated('birth_city'),
            reference: $request->validated('reference'),
            signin_date: $request->validated('signin_date'),
            image: $request->validated('image'),
            // cinimage: $request->validated('cinimage'),
        );
    }

    public static function fromModel(Profile $profile): self
    {
        return new self(
            name: $profile->name,
            name_ar: $profile->name_ar,
            cin: $profile->cin,
            adress: $profile->adress,
            birthday: $profile->birthday,
            birth_city: $profile->birth_city,
            reference: $profile->reference,
            signin_date: $profile->signin_date,
            image: $profile->image,
            // cinimage: $profile->cinimage,
        );
    }
}
