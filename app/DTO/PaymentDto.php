<?php

namespace App\DTO;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentDto extends DTO
{
    public function __construct(
        public readonly String $profil_id,
        public readonly String $date,
        public readonly String $amount,
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            profil_id: $request->validated('profil_id'),
            date: $request->validated('date'),
            amount: $request->validated('amount'),
        );
    }
}
