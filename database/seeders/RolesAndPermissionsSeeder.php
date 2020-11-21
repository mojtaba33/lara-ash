<?php
namespace Database\Seeders;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('permission.default_roles');
        foreach($roles as $role)
        {
            Role::firstOrCreate([
                'title' => $role['title'],
                'fa_title' => $role['fa_title']
            ]);
        }

        $permissions = config('permission.default_permissions');
        foreach($permissions as $permission)
        {
            Permission::firstOrCreate([
                'title' => $permission['title'],
                'fa_title' => $permission['fa_title']
            ]);
        }

        $role = Role::where('title','Senior-administrator')->first();
        $role->permissions()->sync(Permission::select('id')->get());

        $super_admin = config('permission.default_super_admin');
        $admin = User::firstOrCreate(
            [
                'email' => $super_admin['email'],
            ],
            [
            'name' => $super_admin['name'],
            'email_verified_at' => now(),
            'password' => Hash::make($super_admin['password']),
            'remember_token' => Str::random(10),
            'level' => 'admin'
            ]
        );
        $admin->roles()->sync(Role::where('title','Senior-administrator')->first()->id);
    }
}
