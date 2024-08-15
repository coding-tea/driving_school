<?php

namespace App\Services;

use App\DTO\PaymentDto as Dto;
use App\Models\Office;
use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class PaymentService extends Service
{
    public function __construct()
    {
    }

    /***
     *
     * @return
     */
    public function query()
    {
        return Payment::query();
    }

    public function create(Dto $dto)
    {
        $data = $this->query()->create([
            'profil_id' => $dto->profil_id,
            'date' => $dto->date,
            'amount' => $dto->amount,
            'office_id' => Office::query()->where('user_id', Auth::id())->first()->id,
        ]);

        return $data;
    }

    public function delete(Payment $payment): void
    {
        $payment->delete();
    }

    public function deleteFromArrayOfIds(array $ids): void
    {
        self::query()->whereIn('id', $ids)->delete();
    }

    public function update(Payment $payment, Dto $dto)
    {
        $payment->fill([
            'profil_id' => $dto->profil_id,
            'date' => $dto->date,
        ]);

        if ($payment->isDirty()) {
            $payment->save();
            $payment->refresh();
        }
    }
}
