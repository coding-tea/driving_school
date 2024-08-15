<?php

namespace App\Http\Controllers;

use App\DTO\UserDto;
use App\DTO\UserManagement\CollaboratorDto;
use App\EditConsult\CityEditConsult;
use App\EditConsult\UsersEditConsult;
use App\Enums\UserRole;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\City;
use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use App\Services\UserService;
use App\View\Components\Group\BreadCrumbItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function __construct(private UserService $userService){}
    /***
     *
     * @return
     */
    public function BreadCrumb()
    {
        return [
            new BreadCrumbItem(trans('app.home'), 'dashboard'),
            new BreadCrumbItem(trans('users.page_index.page_title'), route('users.index'))
        ];
    }

    /***
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws \Exception
     */
    public function index(Request $request)
    {


//        Collaborator::factory()->create();
        $this->setPageTitle(trans('roles.page_index.page_title'));
        $this->setPageBreadCrumb($this->BreadCrumb());
        return view('pages.users.index', [
            'actions' => UsersEditConsult::actions(),
            'heads' => UsersEditConsult::heads(),
            'users' => User::all()->except(user()->id),
            'citites' => City::paginate($request->get('lenght',10))->withQueryString(),
        ]);
    }

    public function create()
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem('create')]);
        $this->setPageTitle(trans('users.page_create.page_title'));
        return view('pages.users.create');
    }

    public function show(User $user)
    {


        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans('users.page_index.page_th_user'))]);
        $this->setPageTitle(trans('users.page_edit.page_title_with_user', ['user' => $user->dto()->fullname()]));
        return view('pages.users.edit', [
            'user' => $user,
            'userRoles' => $user->roles,
            'userPermissions' => $user->getAllPermissions(),
            'cities' => CityEditConsult::allForSelect()
        ]);
    }

    public function destroy(User $user)
    {
        $this->userService->delete(
            $user
        );
        $this->success(__('app.done'), __('users.deleted_notification'));
        return redirect()->route('users.index');
    }

    public function destroyGroup(Request $request)
    {
        $this->userService->deleteFromArrayOfIds(
            $request->get('ids')
        );
        $this->success(__('app.delete'), __('users.selected_deleted_notification'));
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userService->create(
            UserDto::fromRequest($request)
        );
        $this->success(__('app.create'), __('users.created_notification'));
        return redirect()->route('users.show', $user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update(
            $user,
            UserDto::fromRequest($request)
        );
        $this->success(__('app.update'), __('users.updated_notification'));
        return redirect()->route('users.show', $user);
    }

    /***
     *
     * @return
     */
    public function updateStatus(User $user, $status)
    {
        $user->update([
            'status' => $status
        ]);
        $this->success(__('app.update'), __('users.status_updated'));
        return redirect()->back();
    }

    public function updateRole(User $user, $role)
    {
        if (UserRole::tryFrom($role)) {
            $user->assignRole($role);
            $this->success(__('app.update'), __('users.role_updated'));
        } else {
            $this->error('vdfd', 'ggfd');
        }
        return redirect()->back();
    }

    /***
     *
     * @return
     */
    public function resetPassword(User $user)
    {
        if ($user !== \user()) {
            $this->userService->resetPassword($user);
            $this->success(__('app.done'), __('users.password_initialized'));
        } else {
            $this->error('vdfd', 'ggfd');
        }
        return redirect()->back();
    }


}
