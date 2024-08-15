<?php

namespace App\Jobs\UserManagement;

use App\Enums\Status;
use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateCollaboratorAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private  Collaborator $collaborator)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::query()->create([
            'status' => Status::ACTIVE->value,
            'collaborator' => $this->collaborator->id,
            'created_by' => user()->id,
        ]);
    }
}
