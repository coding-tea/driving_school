<?php

namespace App\DTO;

use Illuminate\Http\Request;

class StaffDto extends DTO
{
    public function __construct(
        public readonly String $name,
        public readonly String $role,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->validated('name'),
            role: $request->validated('role'),
        );
    }
}
