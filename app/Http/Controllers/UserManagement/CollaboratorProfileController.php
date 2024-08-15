<?php

namespace App\Http\Controllers\UserManagement;

use App\DTO\UserManagement\CollaboratorDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\CollaboratorProfileRequest;
use App\Models\Establishment;
use App\Services\SessionService;
use App\Services\UserManagement\CollaboratorService;
use App\View\Components\Group\BreadCrumbItem;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class CollaboratorProfileController extends Controller
{

    public function __construct(public CollaboratorService $collaboratorService)
    {

    }

    public function index()
    {

        $this->setPageTitle(trans("user-management/profile.page_title"));
        $this->setPageBreadCrumb([
            new BreadCrumbItem(trans('app.home'), route('dashboard')),
            new BreadCrumbItem(trans("user-management/profile.page_title"), route('profile.index'))
        ]);

        return view('pages.profile', [
            'collaborator' => user()->owner,
            'collaboratorDto' => user()->owner->dto(),
            'first_connection' => SessionService::init('mrx')->has('first_connection')
        ]);
    }

    public function Establishment()
    {
        $this->setPageTitle('Profile Establishment ');
        $this->setPageBreadCrumb([
            new BreadCrumbItem(trans('app.home'), route('dashboard')),
            new BreadCrumbItem(trans("Profile Establishment "), route('profile.establishment'))
        ]);

        $establishment = Establishment::query()->findOrFail(user()['establishment_id']);

        return view('pages.profile.establishment', [
            'establishment' => $establishment,
            'establishmentDto' => $establishment->dto(),
        ]);
    }

    public function save(CollaboratorProfileRequest $request)
    {
        if (!user()->isTestAccount()) {
            $this->collaboratorService->updateFromProfile(
                user()->owner,
                CollaboratorDto::fromRequest($request),
            );
            $this->success(__('app.update'), __('users.updated_notification'));
        } else
            $this->error(__('error'), "you cant change demo account");
        return back();
    }

    public function updateAccount(Request $request)
    {
        if (!user()->isTestAccount()) {
            $validated = $request->validate([
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            user()->update([
                'password' => Hash::make($validated['password']),
                'is_password_dirty' => true
            ]);

            $this->success(__('app.update'), __('users.updated_notification'));
        } else
            $this->error(__('error'), "you cant change demo account");
        return back();
    }
}
