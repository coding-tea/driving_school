<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\CollaboratorEstablishment;
use App\Models\Establishment;
use App\Models\UserManagement\Collaborator;
use App\Services\EtablissementService;
use App\Services\UserManagement\CollaboratorService;
use App\View\Components\Group\BreadCrumbItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EstablishmentCollaboratorController extends Controller
{
    public function __construct(public EtablissementService $etablissementService)
    {}
    public function BreadCrumb() : array
    {
        return [new BreadCrumbItem(trans('app.home'), 'dashboard'), new BreadCrumbItem(trans('Affectations'), route('establishment_collaborators.index'))];
    }
    public function index()
    {
        $this->setPageTitle('Affectations');
        $this->setPageBreadCrumb($this->BreadCrumb());
        return view('pages.affectationCollaboratorsEstablishments.establishments_collaborators', ['establishments' => $this->etablissementService->getEstablishmentsForSelect()]);
    }
    public function getCollaborators(Request $request){
        $validator = validator($request->all(), ['id' => 'required|exists:establishments,id']);
        if ($validator->fails()) {return ['errors' => $validator->errors()->toArray()];}
        $collaboratorsHasEstablishment = $this->etablissementService->getCollaboratorsHasEstablishment($validator->validated()['id']);
        $collaboratorsDoesntHaveEstablishment = $this->etablissementService->getCollaboratorsDoesntHaveEstablishment($collaboratorsHasEstablishment->pluck('id')->toArray());
        return response()->json(['collaboratorsHasEstablishment' => $collaboratorsHasEstablishment , 'collaboratorsDoesntHaveEstablishment' => $collaboratorsDoesntHaveEstablishment ]);
    }
    public function affecte(Request $request)
    {
        $validator = validator($request->all(), ['establishment' => 'required|exists:establishments,id' , 'ids' => 'string|nullable']);
        $this->etablissementService->affectedEstablishmentCollaborator($validator->validated()['ids'] , $validator->validated()['establishment']);
        return response()->json(['success' => true]);
    }


}
