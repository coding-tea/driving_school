<?php

namespace App\DTO;

use App\Models\Office;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class OfficeDto extends DTO
{
    public function __construct(
        public readonly UploadedFile|null $image_id,
        public readonly String $name,
        public readonly String $adress,
        // public readonly String $user_id,
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            image_id: $request->validated('image_id'),
            name: $request->validated('name'),
            adress: $request->validated('adress'),
            // user_id: $request->validated('user_id'),
        );
    }

    public static function fromModel(Office $office): self
    {
        return new self(
            image_id: $office->image_id,
            name: $office->name,
            adress: $office->adress,
            // user_id: $office->user_id,
        );
    }
}
