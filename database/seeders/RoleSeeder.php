<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'user'];
        foreach ($roles as $roleItem){
            $role = new Role();
            $role->role=$roleItem;
//            DB::table('roles')->insert(["role"=>$role]);
            $role->save();

        }

    }
}
