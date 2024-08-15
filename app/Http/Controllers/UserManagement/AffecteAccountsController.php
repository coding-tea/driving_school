<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;

use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use App\Services\EtablissementService;
use App\Services\UserManagement\CollaboratorService;
use App\Services\UserService;
use App\View\Components\Group\BreadCrumbItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AffecteAccountsController extends Controller
{
    public function __construct(public UserService $userService , public EtablissementService $etablissementService , public CollaboratorService $collaboratorService)
    {}
    public function BreadCrumb() : array
    {
        return [new BreadCrumbItem(trans('app.home'), 'dashboard'), new BreadCrumbItem(trans('Affectation Comptes aux Collaborateurs'), route('affecte_account.index'))];
    }
    public function index()
    {
        $this->setPageTitle('Affectation Comptes aux Collaborateurs');
        $this->setPageBreadCrumb($this->BreadCrumb());

        return view('pages.affecteAccounts.index',
            [
                'establishments' => [$this->collaboratorService->getEstablishmentsHasCollaborator(user()->owner->id) , ['id' , 'name']],
                'collaborators' => [Collaborator::query()->whereDoesntHave('account')
                            ->select('collaborators.id', DB::raw('CONCAT(first_name , " " , last_name , " " , matricule) as full_name'))
                            ->get() , ['id' , 'full_name']] ,

            ]);
    }

    public function getAccounts(Request $request){

        $validator = validator($request->all(), ['establishmentId' => 'required|exists:establishments,id' , 'is_manager' => 'nullable']);
        $accounts = User::query()->where('establishment_id' , $validator->validated()['establishmentId'])->where('is_manager' , $validator->validated()['is_manager'])->get() ;
        return response()->json(['data' => $accounts]);

    }

    public function getDataAccount(Request $request){

        $validator = validator($request->all(), [
            'id_user' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }

        $account = User::query()
                    ->leftJoin('collaborators' , 'collaborators.id' , 'users.collaborator')
                    ->where('users.id', $validator->validated()['id_user'])
                    ->select('users.*', DB::raw('CONCAT(collaborators.first_name , " " , collaborators.last_name , " " , collaborators.matricule) as full_name'))
                    ->get();

        return response()->json([
            'data' => $account,
        ]);

    }

    public function getCollaborator(Request $request){

        $validator = validator($request->all(), ['id_collaborator' => 'required|exists:collaborators,id']);
        $data = Collaborator::query()->where('id' , $validator->validated()['id_collaborator'])->get() ;
        return response()->json(['data' => $data]);

    }

    public function Save(Request $request){

        $validator = validator($request->all(), [
            'id_user' => 'required',
            'id_collaborators' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }

        $collaborator = Collaborator::query()->find($validator->validated()['id_collaborators']);
        $user = User::query()->find($validator->validated()['id_user']);
        $user->update([

            'login' => $collaborator->matricule,
            'password' => Hash::make($collaborator->dto()->passwordFormat()),
            'collaborator' => $collaborator->id,


        ]);

        return response()->json(['data' => 'success']);
    }

    public function passwordReset(Request $request)
    {
        $validator = validator($request->all(), [
            'id_user' => 'required',
            'id_collaborator' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }

        $collaborator = Collaborator::query()->find($validator->validated()['id_collaborator']);
        $user = User::query()->find($validator->validated()['id_user']);
        $user->update([
            'password' => Hash::make($collaborator->dto()->passwordFormat()),
        ]);

        return response()->json(['data' => 'success']);
    }

}

