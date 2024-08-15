<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\CollaboratorEstablishment;
use App\Models\Establishment;
use App\Models\UserManagement\Collaborator;
use App\Services\UserManagement\CollaboratorService;
use App\View\Components\Group\BreadCrumbItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CollaboratorEstablishmentController extends Controller
{
    public function __construct(public CollaboratorService $collaboratorService)
    {}
    public function BreadCrumb() : array
    {
        return [new BreadCrumbItem(trans('app.home'), 'dashboard'), new BreadCrumbItem(trans('Affectations'), route('collaborators_establishments.index'))];
    }
    public function index()
    {
        $this->setPageTitle('Affectations');
        $this->setPageBreadCrumb($this->BreadCrumb());
        return view('pages.affectationCollaboratorsEstablishments.collaborators_establishments',
            ['collaborators' => $this->collaboratorService->getCollaboratorForSelect()]);
    }
    public function getEstablishments(Request $request){
        $validator = validator($request->all(), ['id' => 'required|exists:collaborators,id']);
        if ($validator->fails()) {return ['errors' => $validator->errors()->toArray()];}
        $establishmentsHasCollaborator = $this->collaboratorService->getEstablishmentsHasCollaborator($validator->validated()['id']);
        $establishmentsDoesntHaveCollaborator = $this->collaboratorService->getEstablishmentsDoesntHaveCollaborator($establishmentsHasCollaborator->pluck('id')->toArray());
        return response()->json(['establishmentsHasCollaborator' => $establishmentsHasCollaborator , 'establishmentsDoesntHaveCollaborator' => $establishmentsDoesntHaveCollaborator ]);
    }
    public function affecte(Request $request)
    {
        $validator = validator($request->all(), ['collaboratore' => 'required|exists:collaborators,id' , 'ids' => 'string|nullable']);
        $this->collaboratorService->affectedCollaboratorEstablishment($validator->validated()['ids'] , $validator->validated()['collaboratore']);
        return response()->json(['success' => true]);
    }


}
