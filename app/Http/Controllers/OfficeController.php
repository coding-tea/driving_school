<?php

namespace App\Http\Controllers;

//dto & Edir consult
use App\DTO\OfficeDto as Dto;
use App\EditConsult\OfficeEditConsult as EditConsult;

//data and the logic
use App\Models\Office as ModelTarget;
use App\Models\Office;
use App\Services\OfficeService as Sercice;
use App\Http\Requests\OfficeRequest as ModelRequest;

//required dependencies
use App\View\Components\Group\BreadCrumbItem;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\User;
use Illuminate\Http\Request;

class OfficeController extends Controller
{

    public $folder;
    public $route;
    public $langue;
    public function __construct(private Sercice $service)
    {
        $this->folder = "office";
        $this->route = "offices";
        $this->langue = "office";
    }

    public function BreadCrumb()
    {
        return [
            new BreadCrumbItem(trans('app.home'), 'dashboard'),
            new BreadCrumbItem(trans($this->langue . '.page_index.page_title'), route($this->route . '.index'))
        ];
    }

    public function index()
    {
        $this->setPageTitle(trans($this->langue . '.page_index.page_title'));
        $this->setPageBreadCrumb($this->BreadCrumb());
        return view('pages.' . $this->folder . '.index', [
            'actions' => EditConsult::actions(),
            'heads' => EditConsult::heads(),
            'data' => ModelTarget::all(),
        ]);
    }

    public function create()
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem('create')]);
        $this->setPageTitle(trans($this->langue . '.page_index.page_title'));

        $users = User::all();

        return view("pages." . $this->folder . ".create", [
            'actions' => EditConsult::actions(),
            'users' => $users,
        ]);
    }

    public function show(Office $office)
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans($this->langue . '.page_edit.page_title'))]);
        $this->setPageTitle(trans($this->langue .  '.page_edit.page_title_with_item'));

        return view("pages." . $this->folder . ".edit", [
            'item' => $office,
        ]);
    }

    public function destroy(Office $office)
    {
        $this->service->delete(
            $office
        );
        $this->success(__('app.done'), __($this->langue . '.deleted_notification'));
        return redirect()->back();
    }

    public function destroyGroup(Request $request)
    {
        $this->service->deleteFromArrayOfIds(
            $request->get('ids')
        );
        $this->success(__('app.delete'), __($this->langue . '.selected_deleted_notification'));
    }

    public function store(ModelRequest $request)
    {
        $data = $this->service->create(
            Dto::fromRequest($request)
        );
        $this->success(__('app.create'), __($this->langue . '.created_notification'));
        return redirect()->route($this->route . '.show', $data->id);
    }

    public function update(ModelRequest $request, Office $office)
    {
        // dd($request->all());
        $this->service->update(
            $office,
            Dto::fromRequest($request)
        );
        $this->success(__('app.update'), __($this->langue . '.updated_notification'));
        return redirect()->route($this->route . '.show', $office);
    }
}