<?php

namespace App\Http\Controllers;

use App\DTO\RoleDto;
use App\Enums\YesNo;
use App\EditConsult\RoleEditConsult;
use App\Http\Requests\CreateRoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use App\View\Components\Group\BreadCrumbItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct(private readonly RoleService $roleService)
    {
    }

    /***
     *
     * @return array
     */
    public function BreadCrumb() : array
    {
        return [
            new BreadCrumbItem(trans('app.home'), 'dashboard'),
            new BreadCrumbItem(trans('roles.page_index.page_title'), route('roles.index'))
        ];
    }

    /***
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        // dd();
        $this->setPageTitle(trans('roles.page_index.page_title'));
        $this->setPageBreadCrumb($this->BreadCrumb());

        return view('pages.roles.index', [
            'actions' => RoleEditConsult::actions(),
            'heads' => RoleEditConsult::heads(),
            'roles' => Role::select("id", "name","nomRoleAr","management","descrptionFr","descrptionAr")->get()
        ]);
    }

    public function create()
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans('app.create'))]);
        $this->setPageTitle(trans('roles.page_create.page_title'));
        return view('pages.roles.create', [
            "yesno" => YesNo::toArray()
        ]);
    }

    public function show(Role $role)
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans('app.edit'))]);
        $this->setPageTitle(trans('roles.page_edit.page_title_with_user'));
        return view('pages.roles.edit', [
            'role' => $role,
            "yesno" => YesNo::toArray()
        ]);
    }

    public function destroy(Role $role)
    {
        $this->roleService->delete(
            $role
        );
        $this->success(__('app.done'), __('roles.deleted_notification'));
        return redirect()->route('roles.index');
    }

    public function destroyGroup(Request $request)
    {
        $this->roleService->deleteFromArrayOfIds(
            $request->get('ids')
        );
        $this->success(__('app.delete'), __('roles.selected_deleted_notification'));
    }


    public function store(CreateRoleRequest $request)
    {
        // dd($request);
        $role = $this->roleService->create(
            RoleDto::fromRequest($request)
        );


        $this->success(__('app.create'), __('roles.created_notification'));
        return redirect()->route('roles.show', $role);
    }

    public function update(CreateRoleRequest $request, Role $role)
    {
        $this->roleService->update(
            $role,
            RoleDto::fromRequest($request)
        );
        $this->success(__('app.update'), trans('roles.updated_notification'));
        return redirect()->route('roles.index');
    }




}
