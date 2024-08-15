<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Status;
use App\Enums\UserRole;
use App\Models\CentreFormationOption;
use App\Models\Etudieant;
use App\Models\GroupAnneEtudiant;
use App\Models\OptionAnneeCapacite;
use App\Models\UserManagement\Collaborator;
use App\Models\UserManagement\User;
use App\Services\UserManagement\CollaboratorService;
use App\Services\UserService;
use App\Services\WeatherService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('migrate:fresh');
        // $this->roles();

        $this->call([
            UserSeeder::class,
        ]);
    }


    /***
     *
     * @return
     */
    public function roles(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $userService = app(UserService::class);

        // Roles
        $super_admin = app(Role::class)->newQuery()->create([
            "name" => UserRole::SUPER_ADMIN->value, 'is_for_manager' => true
        ]);
        $admin = app(Role::class)->newQuery()->create([
            "name" => UserRole::ADMIN->value, 'is_for_manager' => true
        ]);
        $director = app(Role::class)->newQuery()->create([
            "name" => UserRole::DIRECTOR->value, 'is_for_manager' => true
        ]);
        $administrateur_establishment = app(Role::class)->newQuery()->create([
            "name" => UserRole::ADMINISTRATEUR_ESTABLISHMENT->value, 'is_for_manager' => true
        ]);
        $director_pedagogic = app(Role::class)->newQuery()->create([
            "name" => UserRole::DIRECTOR_PEDAGOGIC->value, 'is_for_manager' => true
        ]);
        $admin_centre_formation = app(Role::class)->newQuery()->create([
            "name" => UserRole::ADMIN_CENTRE_FORMATION->value, 'is_for_manager' => true
        ]);
        $teachers = app(Role::class)->newQuery()->create([
            "name" => UserRole::TEACHERS->value, 'is_for_manager' => true
        ]);
        $students = app(Role::class)->newQuery()->create([
            "name" => UserRole::STUDENTS->value, 'is_for_manager' => true
        ]);
        $parent = app(Role::class)->newQuery()->create([
            "name" => UserRole::PARENT->value, 'is_for_manager' => true
        ]);
        $autres = app(Role::class)->newQuery()->create([
            "name" => UserRole::AUTRES->value, 'is_for_manager' => true
        ]);
        // Permission

        $permission_store_user = app(Permission::class)->findOrCreate('store user', 'web');
        $permission_delete_users = app(Permission::class)->findOrCreate('delete users', 'web');
        $permission_show_user = app(Permission::class)->findOrCreate('show user', 'web');
        $permission_update_user = app(Permission::class)->findOrCreate('update user', 'web');
        $permission_see_users = app(Permission::class)->findOrCreate('see user', 'web');
        $permission_create_user = app(Permission::class)->findOrCreate('create user', 'web');
        $permission_delete_user = app(Permission::class)->findOrCreate('delete user', 'web');

        $admin->givePermissionTo([
            $permission_see_users,
            $permission_show_user
        ]);

        $super_admin->syncPermissions([
            $permission_store_user,
            $permission_delete_users,
            $permission_show_user,
            $permission_update_user,
            $permission_see_users,
            $permission_create_user,
            $permission_delete_user,
        ]);


        $roles = [
            $super_admin,
            $admin,
            $director,
            $administrateur_establishment,
            $director_pedagogic,
            $admin_centre_formation,
            $teachers,
            $students,
            $parent,
            $autres
        ];


        app(CollaboratorService::class)->factory(1);
        $first = Collaborator::all()->first();
        User::query()->create([
            'status' => Status::ACTIVE->value,
            'login' => 'test',
            'password' => Hash::make('test'),
            'collaborator' => $first['id'],
            "is_manager" => 1,
            "is_admin" => 1
        ]);
    }
}
