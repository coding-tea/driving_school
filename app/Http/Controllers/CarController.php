<?php

namespace App\Http\Controllers;

//dto & Edir consult
use App\DTO\carDto as Dto;
use App\EditConsult\CarEditConsult as EditConsult;

//data and the logic
use App\Models\Car as ModelTarget;
use App\Models\Car;
use App\Services\CarService as Sercice;
use App\Http\Requests\CarRequest as ModelRequest;

//required dependencies
use App\View\Components\Group\BreadCrumbItem;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\User;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public $folder;
    public $route;
    public $langue;
    public function __construct(private Sercice $service)
    {
        $this->folder = "cars";
        $this->route = "cars";
        $this->langue = "cars";
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

        return view("pages." . $this->folder . ".create", [
            'actions' => EditConsult::actions(),
        ]);
    }


    public function destroy(Car $car)
    {
        $this->service->delete(
            $car
        );
        $this->success(__('app.done'), __($this->langue . '.deleted_notification'));
        return redirect()->route($this->route  . '.index');
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
        return redirect()->route($this->route  . '.index');
    }

    public function update(ModelRequest $request, Car $car)
    {
        $this->service->update(
            $car,
            Dto::fromRequest($request)
        );
        $this->success(__('app.update'), __($this->langue . '.updated_notification'));
        return redirect()->route($this->route  . '.index');
    }
}