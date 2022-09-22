<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        $role = Role::create(['name' => 'admin','guard_name'=>'api']);
        $permission = Permission::create(['name' => 'create blogs','guard_name'=>'api']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        //User
        $role = Role::create(['name' => 'user','guard_name'=>'api']);
        $permission = Permission::create(['name' => 'view','guard_name'=>'api']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);


    }
}
