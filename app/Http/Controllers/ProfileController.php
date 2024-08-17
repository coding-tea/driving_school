<?php

namespace App\Http\Controllers;

//dto & Edir consult
use App\DTO\ProfileDto as Dto;
use App\EditConsult\ProfileEditConsult as EditConsult;
use App\EditConsult\ProfileEditConsult;

//data and the logic
use App\Models\Profile as ModelTarget;
use App\Models\Profile;
use App\Services\ProfileService as Sercice;
use App\Http\Requests\ProfileRequest as ModelRequest;

//required dependencies
use App\View\Components\Group\BreadCrumbItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Office;
use App\Models\Staff;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public $folder;
    public $route;
    public $langue;
    public function __construct(private Sercice $service)
    {
        $this->folder = "profile";
        $this->route = "profile";
        $this->langue = "profile";
    }

    public function BreadCrumb()
    {
        return [
            new BreadCrumbItem(trans('app.home'), 'dashboard'),
            new BreadCrumbItem(trans($this->langue . '.page_index.page_title'), route($this->route . '.index'))
        ];
    }

    public function candidat()
    {
        $this->setPageTitle("Dashboard");
        $this->setPageBreadCrumb([new BreadCrumbItem(trans('app.home'), 'dashboard'),]);

        return view('pages.'. $this->folder .'.index', [
            'actions' => EditConsult::actions(),
            'heads' => EditConsult::heads(),
            'data' => ModelTarget::all(),
        ]);
    }

    public function index()
    {
        $this->setPageTitle(trans($this->langue . '.page_index.page_title'));
        $this->setPageBreadCrumb($this->BreadCrumb());

        $item = Office::query()->where('user_id', Auth::id())->first();

        $candidats_count = Profile::query()->where('office_id', $item->id)->get()->count();

        $staffs_count = Staff::query()->where('office_id', $item->id)->get()->count();

        $candidats_count_last_mount = Profile::query()->where('office_id', $item->id)->get()->count();

        return view('pages.office.profile', [
            'actions' => EditConsult::actions(),
            'heads' => EditConsult::heads(),
            'data' => ModelTarget::all(),
            'item' => $item,
            'candidats_count' => $candidats_count,
            'staffs_count' => $staffs_count,
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

    public function show(Profile $profile)
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans($this->langue . '.page_edit.page_title'))]);
        $this->setPageTitle(trans($this->langue .  '.page_edit.page_title_with_item'));

        return view("pages." . $this->folder . ".edit", [
            'item' => $profile,
        ]);
    }

    public function destroy(Profile $profile)
    {
        $this->service->delete(
            $profile
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

    public function update(ModelRequest $request, Profile $profile)
    {
        // dd($request->all());
        $this->service->update(
            $profile,
            Dto::fromRequest($request)
        );
        $this->success(__('app.update'), __($this->langue . '.updated_notification'));
        return redirect()->route($this->route . '.show', $profile);
    }

    public function donwloaPdf($id)
    {
        $data = Profile::find($id);
        return view('pages.contract.formation', compact('data'));
    }
}
