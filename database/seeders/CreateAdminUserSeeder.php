<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'WAJEEH WAJEEH',
            'name_en' => 'WAJEEH WAJEEH',
            'email' => 'snuora2019@gmail.com',
            'password' => bcrypt('123123123'),
            'image' => 'profile.png',
            'gender' => "1",
            'status' => "1",
            'location' => "wqeqwe",
            'mobile' => '0595913186',
            'role' => "admin",
            "email_verified_at" => now(),
        ]);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'user']);
        $role = Role::create(['name' => 'chef']);


        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
