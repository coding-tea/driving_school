<?php

namespace App\Http\Controllers\UserManagement;

use App\DataTable\UserManagement\CollaboratorDataTable;
use App\DTO\UserDto;
use App\DTO\UserManagement\CollaboratorDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\CreateCollaboratorRequest;
use App\Http\Requests\UserManagement\UpdateCollaboratorRequest;
use App\Models\Profile;
use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use App\Models\UserManagement\UserProfile;
use App\Services\UserManagement\CollaboratorService;
use App\Services\UserService;
use App\View\Components\Group\BreadCrumbItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CollaboratorController extends Controller
{


    public function __construct(private CollaboratorService $collaboratorService)
    {
    }

    /***
     *
     * @return array
     */
    public function BreadCrumb()
    {
        return [
            new BreadCrumbItem(trans('app.home'), 'dashboard'),
            new BreadCrumbItem(trans('users.page_index.page_title'), route('collaborators.index'))
        ];
    }

    /***
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
//        $this->collaboratorService->factory(10);
        $this->setPageTitle(trans('users.page_index.page_title'));
        $this->setPageBreadCrumb($this->BreadCrumb());

        return view('pages.collaborators.index', [
            'actions' => CollaboratorDataTable::actions(),
            'heads' => CollaboratorDataTable::heads(),
            'users' => $this->collaboratorService->all(),
        ]);
    }


    public function create()
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans("app.create"))]);
        $this->setPageTitle(trans('users.page_create.page_title'));
        return view('pages.collaborators.create');
    }

    public function show(Collaborator $collaborator)
    {

        $unAssignedAccounts = app(UserService::class)->getUnAssignedAccount();
        $unAssignedAccountsManager = collect([]);
        $unAssignedAccountsNotManager = collect([]);
        $unAssignedAccounts->map(function (User $user) use ($unAssignedAccountsNotManager, $unAssignedAccountsManager) {
            if ($user->isManager()) {

                $unAssignedAccountsManager->add($user);
            } else {
                $unAssignedAccountsNotManager->add($user);
            }
        });

        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans('users.page_index.page_th_user'))]);
        $this->setPageTitle(trans('users.page_edit.page_title_with_user', ['user' => $collaborator->dto()->fullname()]));
        return view('pages.collaborators.edit', [
            'collaborator' => $collaborator,
            'collaboratorDto' => $collaborator->dto(),
            'unAssignedAccountsManager' => $unAssignedAccountsManager,
            'unAssignedAccountsNotManager' => $unAssignedAccountsNotManager,
        ]);
    }

    public function destroy(Collaborator $collaborator)
    {
        $this->collaboratorService->delete(
            $collaborator
        );
        $this->success(__('app.done'), __('users.deleted_notification'));
        return redirect()->route('collaborators.index');
    }

    public function destroyGroup(Request $request)
    {
        $this->collaboratorService->deleteFromArrayOfIds(
            $request->get('ids')
        );
        $this->success(__('app.delete'), __('users.selected_deleted_notification'));
    }

    public function store(CreateCollaboratorRequest $request)
    {


        $user = $this->collaboratorService->createFromController(
            CollaboratorDto::fromRequest($request),
            UserDto::fromCollaboratorController($request)
        );
        $this->success(__('app.create'), __('users.created_notification'));
        return redirect()->route('collaborators.show', $user);
    }

    public function update(UpdateCollaboratorRequest $request, Collaborator $collaborator)
    {
        $this->collaboratorService->updateFromController(
            $collaborator,
            CollaboratorDto::fromRequest($request),
            UserDto::fromCollaboratorController($request)
        );
        $this->success(__('app.update'), __('users.updated_notification'));
        return redirect()->route('collaborators.show', $collaborator);
    }

    /***
     *
     * @param User $user
     * @param $status
     * @return RedirectResponse
     * @throws \Exception
     */
    public function updateStatus(Collaborator $collaborator, $status)
    {
        if ($collaborator->account !== \user()) {
            $this->collaboratorService->updateAccountStatus($collaborator, $status);
            $this->success(__('app.done'), __('users.password_initialized'));
        } else {
            $this->error('vdfd', 'ggfd');
        }
        return redirect()->back();
    }

    public function updateRole(Collaborator $collaborator, $role)
    {
        if ($collaborator->account !== \user()) {
            $this->collaboratorService->updateAccountRole($collaborator);
            $this->success(__('app.done'), __('users.password_initialized'));
        } else {
            $this->error('vdfd', 'ggfd');
        }
        return redirect()->back();
    }

    public function updateManager(Collaborator $collaborator, $role)
    {
        if ($collaborator->account !== \user()) {
            $this->collaboratorService->updateAccountIsManager($collaborator);
            $this->success(__('app.done'), __('users.password_initialized'));
        } else {
            $this->error('vdfd', 'ggfd');
        }
        return redirect()->back();
    }

    /***
     *
     * @return
     */
    public function resetPassword(Collaborator $collaborator)
    {
        if ($collaborator->account !== \user()) {
            $this->collaboratorService->resetAccountPassword($collaborator);
            $this->success(__('app.done'), __('users.password_initialized'));
        } else {
            $this->error('vdfd', 'ggfd');
        }
        return redirect()->back();
    }

    public function assign(Collaborator $collaborator, User $user)
    {
        if ($collaborator->hasAccount()) {
            if ($collaborator->account == user()) {
                abort(500);
            }
            abort(404);
        } else {
            $user->update([
                'collaborator' => $collaborator->id
            ]);
            $this->success(__('app.done'), __('users.password_initialized'));
        }
        return redirect()->back();
    }


    public function affectation()
    {
        $this->setPageTitle(trans("users.page_affectation.page_title"));
        $this->setPageBreadCrumb($this->BreadCrumb());
        $collaborators = $this->collaboratorService->allWithAccount();
        return view('pages.collaborators.affectation', [
            'collaborators' => [ $collaborators, ['id', ['id', 'first_name', 'last_name'], ' ']]
        ]);
    }

    public function getProfiles(Request $request)
    {

        $collaboratorProfiles = Collaborator::find($request->get('id'))->profiles();
        $profiles = Profile::all()->except($collaboratorProfiles->pluck('id')->toArray());
        return response()->json([
            'collaboratorProfiles' => $collaboratorProfiles,
            'profiles' => $profiles
        ]);
    }

    public function profileAssign(Collaborator $collaborator, Request $request)
    {


        if ($collaborator->account->UserProfile instanceof  Collection){
            $collaborator->account->UserProfile->map(function (UserProfile $profile) {
                $profile->delete();
            });
        }
        $ids = explode(',', $request['ids']);


        if(count($ids)){
            foreach ($ids as $id) {
                if(Profile::find($id) !== null){
                    UserProfile::query()->create([
                        'profile_id' => $id,
                        'user_id' => $collaborator->account->id,
                    ]);

                }
            }
        }

        return response()->json(['data' => $this->success(trans("app.done") , trans('users.page_affectation.profiles_affected_notification') , false) ]);


    }

}
