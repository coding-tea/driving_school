<?php

namespace App\Http\Controllers\UserManagement;

use App\EditConsult\ProfileEditConsult;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\ProfileRole;
use App\Models\Role;
use App\View\Components\Group\BreadCrumbItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /***
     *
     * @return array
     */
    public function BreadCrumb() : array
    {
        return [
            new BreadCrumbItem(trans('app.home'), 'dashboard'),
            new BreadCrumbItem(trans('user-management/profiles.page_index.page_title'), route('profiles.index'))
        ];
    }
    public function index()
    {
        $this->setPageTitle(trans('user-management/profiles.page_index.page_title'));
        $this->setPageBreadCrumb($this->BreadCrumb());

        return view('pages.profile.index', [
            'actions' => ProfileEditConsult::actions(),
            'heads' => ProfileEditConsult::heads(),
            'profiles' => Profile::all()
        ]);

    }

    /***
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $this->setPageTitle(trans('user-management/profiles.page_create.page_title'));
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans('user-management/profiles.page_create.page_title') , route('profiles.create'))]);
        return view('pages.profiles.make', [
            'allRoles' => Role::all(),
        ]);
    }

    /***
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Profile $profile)
    {
        $this->setPageTitle(trans('user-management/profile.page_title'));
        $this->setPageBreadCrumb([...$this->BreadCrumb(), new BreadCrumbItem(trans('user-management/profiles.page_edit.page_title') , "") ]);
        return view('pages.profiles.make', [
            'profile' => $profile,
            'allRoles' => $profile->unassignedRoles(),
            'profileRoles' => $profile->roles(),
        ]);
    }


    public function store(Request $request)
    {
        $profile = Profile::query()->create([
            'name' => $request['name'],
            'description' => $request['description'],
            'is_for_manager' => $request->has('management'),
        ]);

        if (!empty($request['ids'])) {
            $ids = explode(',', $request['ids']);
            foreach ($ids as $id) {
                ProfileRole::query()->create([
                    'profile_id' => $profile['id'],
                    'role_id' => $id,
                ]);
            }
        }
        $this->success(__('app.create'), __('user-management/profiles.created_notification'));
        return redirect()->route('profiles.show', $profile);
    }


    public function update(Request $request, Profile $profile)
    {
        $profile->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'is_for_manager' => $request->has('management'),
        ]);

        ProfileRole::query()->where('profile_id', $profile['id'])->delete();

        if (!empty($request['ids'])) {
            $ids = explode(',', $request['ids']);
            foreach ($ids as $id) {
                ProfileRole::query()->create([
                    'profile_id' => $profile['id'],
                    'role_id' => $id,
                ]);
            }
        }
        $this->success(__('app.update'), __('user-management/profiles.updated_notification'));
        return redirect()->route('profiles.show', $profile);
    }
}
