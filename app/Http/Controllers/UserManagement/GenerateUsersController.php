<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\CollaboratorEstablishment;
use App\Models\Establishment;
use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use App\Services\EtablissementService;
use App\Services\UserManagement\CollaboratorService;
use App\Services\UserService;
use App\View\Components\Group\BreadCrumbItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GenerateUsersController extends Controller
{
    public function __construct(public UserService $userService , public EtablissementService $etablissementService)
    {}
    public function BreadCrumb() : array
    {
        return [new BreadCrumbItem(trans('app.home'), 'dashboard'), new BreadCrumbItem(trans('générer des comptes'), route('generete_users.index'))];
    }
    public function index()
    {
        $this->setPageTitle('générer des comptes');
        $this->setPageBreadCrumb($this->BreadCrumb());
        return view('pages.generateAccounts.index', ['establishments' => $this->etablissementService->getEstablishmentsForSelect()]);
    }
    public function Save(Request $request){

        $validated = $request->validate([
            'establishment' => 'required|exists:establishments,id',
             'notmanager' => 'nullable|integer',
             'manager' => 'nullable|integer',
        ]);

        if(!empty($validated['notmanager']) || !empty($validated['manager'])){

            if(!empty($validated['notmanager'])){
                for($i = 1; $i <= $validated['notmanager']; $i++){
                    User::query()->create([
                        'is_manager' => '0' ,
                        'establishment_id' =>  $validated['establishment'],
                    ]);
                }
            }
            if(!empty($validated['manager'])){
                for($i = 1; $i <=  $validated['manager']; $i++){
                    User::query()->create([
                        'is_manager' => '1' ,
                        'establishment_id' =>  $validated['establishment'],
                    ]);
                }
            }
            $this->success(__("app.done"), __('créé avec succès'));
            return redirect()->route('generete_users.index');
        }
        $this->error(__("Annuler l'opération"), __("choisissez un gestionnaire, s'il vous plait"));
        return redirect()->route('generete_users.index');

    }


}
