<?php

namespace App\DTO;

use Illuminate\Http\Request;

class carDto extends DTO
{
    public function __construct(
        public readonly String $profil_id,
        public readonly String $date,
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            profil_id: $request->validated('profil_id'),
            date: $request->validated('date'),
        );
    }
}
