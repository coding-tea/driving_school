<?php

namespace App\Http\Controllers\UserManagement;

use App\DataTable\UserManagement\CollaboratorDataTable;
use App\DTO\UserManagement\CollaboratorDto;
use App\EditConsult\UserManagement\CollaboratorEditConsult;
use App\Exports\DataExport;
use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\CollaboratorProfileRequest;
use App\Http\Requests\UserManagement\CollaboratorsRequest;
use App\Http\Requests\UserManagement\CollaboratorsUpdateRequest;
use App\Imports\CollaboratorImport;
use App\Models\CategoriesCollaborateur;
use App\Models\FunctionModel;
use App\Models\NatureContrat;
use App\Models\UserManagement\Collaborator;
use App\Services\SessionService;
use App\Services\UserManagement\CollaboratorService;
use App\View\Components\Group\BreadCrumbItem;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Maatwebsite\Excel\Facades\Excel;

class CollaboratorsController extends Controller
{

    public function __construct(public CollaboratorService $collaboratorService)
    {

    }
    public function BreadCrumb()
    {
        return [
            new BreadCrumbItem(trans('app.home'), 'dashboard'),
            new BreadCrumbItem(trans('collaborators.page_title'), route('collaboratorss.index'))
        ];
    }
    public function index()
    {

        $this->setPageTitle(trans("collaborators.page_title"));
        $this->setPageBreadCrumb([
            new BreadCrumbItem(trans('app.home'), route('dashboard')),
            new BreadCrumbItem(trans("collaborators.page_title"), route('collaboratorss.index'))
        ]);
        return view('pages.collaboratorss.index', [
            'actions' => CollaboratorDataTable::actionss(),
            'heads' => CollaboratorDataTable::onlyCollaboratorsHeads(),
            'collaborators' => $this->collaboratorService->getAllByJoined(),
            'function' => FunctionModel::pluck('name' , 'id'),
            'category' => CategoriesCollaborateur::pluck('name' , 'id'),
            'contractType' => NatureContrat::pluck('name' , 'id')

        ]);
    }


    public function create()
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans("app.create"))]);
        $this->setPageTitle(trans('users.page_create.page_title'));
        return view('pages.collaboratorss.create', [
            'function' => FunctionModel::pluck('name' , 'id'),
            'category' => CategoriesCollaborateur::pluck('name' , 'id'),
            'contractType' => NatureContrat::pluck('name' , 'id')
        ]);
    }

    public function show(Collaborator $collaborator)
    {
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans("app.edit"))]);
        $this->setPageTitle(trans('collaborators.page_create.page_title'));
        return view('pages.collaboratorss.edit', [
            'collaborator' => $collaborator ,
            'function' => FunctionModel::pluck('name' , 'id'),
            'category' => CategoriesCollaborateur::pluck('name' , 'id'),
            'contractType' => NatureContrat::pluck('name' , 'id')
        ]);
    }

    public function destroy(Collaborator $collaborator)
    {
        $this->collaboratorService->delete(
            $collaborator
        );
        $this->success(__('app.done'), __('collaborators.deleted_notification'));
        return redirect()->route('collaboratorss.index');
    }

    public function destroyGroup(Request $request)
    {
        $this->collaboratorService->deleteFromArrayOfIds(
            $request->get('ids')
        );
        $this->success(__('app.delete'), __('collaborators.selected_deleted_notification'));
    }

    public function store(CollaboratorsRequest $request)
    {
        $collaborator = $this->collaboratorService->createFromController(
            CollaboratorDto::fromRequest($request)
        );
        $this->success(__('app.create'), __('collaborators.created_notification'));
        return redirect()->route('collaboratorss.show', $collaborator);
    }

    public function update(CollaboratorsUpdateRequest $request, Collaborator $collaborator)
    {
        $this->collaboratorService->updateFromController(
            $collaborator,
            CollaboratorDto::fromRequest($request)
        );
        $this->success(__('app.update'), __('collaborators.updated_notification'));
        return redirect()->route('collaboratorss.show', $collaborator);
    }


    public  function download()
    {
        $export = new ModelExport([
            ['matricule', 'cin', 'last_name', 'first_name', 'email' , 'phone_number' , 'postal_code' , 'address' , 'observation', 'gender'], //Create a Headers name for table

        ]);
        return Excel::download($export, 'collaborator.xlsx');
    }

    public function import(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|max:50000|mimes:xlsx',
            'function_id' => 'required|exists:functions,id',
            'category_id' => 'required|exists:categories_collaborators,id',
            'contract_type_id' => 'required|exists:contract_nature,id',
        ]);

        Excel::import(new CollaboratorImport($validated['function_id'],$validated['category_id'],$validated['contract_type_id']), $validated['file']); // Use Laravel-excel 'import' method to import the Excel file using the 'UsersImport' class.  // $validated['file'] contains the validated file, assumed to be an uploaded Excel file.
        $this->success(__('app.create'), __('collaborators.importe_notification'));

        return redirect()->route('collaboratorss.index');
    }

    public function export(Request $request)
    {
        $ids = $request['ids'] ?? []; // Retrieve 'ids' from the incoming request or set an empty array if 'ids' are not available

        $heads = CollaboratorDataTable::ExportHeads(); // Fetch column headers or headings needed for the Excel file export
        if (count($ids) > 0) {
            $query = Collaborator::query()->whereIn('id', $ids)->get(); // Retrieve data from the 'User' model based on the provided 'ids'
        } else {
            $query = $this->collaboratorService->getAllByJoined();
        }

        return response()->json(['path' => DataExport::path($heads, $query)]); // Returning the path as a JSON response
    }


}
