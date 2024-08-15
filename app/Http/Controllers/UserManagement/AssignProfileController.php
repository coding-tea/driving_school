<?php

namespace App\Http\Controllers\UserManagement;

use App\DataTable\UserManagement\CollaboratorDataTable;
use App\Enums\Status;
use App\Enums\YesNo;
use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\UserManagement\User;
use App\Services\UserManagement\CollaboratorService;
use App\Services\UserService;
use App\View\Head;

class AssignProfileController extends Controller
{
    public function index()
    {
        $unAssignedAccounts = app(UserService::class)->getUnAssignedAccount();
        $unAssignedAccountsManager = collect([]);
        $unAssignedAccountsNotManager = collect([]);
        $unAssignedAccounts->map(function (User $user) use ($unAssignedAccountsNotManager, $unAssignedAccountsManager) {
            if ($user->is_manager())
                $unAssignedAccountsManager->add($user);
            else
                $unAssignedAccountsNotManager->add($user);

        });


        return view('pages.profiles.assign-to-collaborator', [
            'establishments' => Establishment::all(),
            'unAssignedAccountsManager' => $unAssignedAccountsManager,
            'unAssignedAccountsNotManager' => $unAssignedAccountsNotManager,
            'unAssignedAccounts' => app(UserService::class)->getUnAssignedAccount(),
            'CollaboratorsDataTableActions' => CollaboratorDataTable::actions(),
            'CollaboratorsDataTableHeads' => CollaboratorDataTable::onlyCollaboratorHeads(),
            'AccountDataTableHeads' => [
                new Head('', Head::TYPE_TEXT, 'id'),
                new Head('', Head::TYPE_TEXT, 'is_admin'),
                new Head('', Head::TYPE_TEXT, 'is_manager'),
                new Head('', Head::TYPE_TEXT, 'status'),
                new Head('', Head::TYPE_TEXT, 'login'),
            ],
            'AccountDataTableActions' => CollaboratorDataTable::actions(),
        ]);
    }
}
