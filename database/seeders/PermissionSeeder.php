<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name'=>'admin_view',
                'guard_name'=> 'sanctum'
            ],
            [
                'name'=>'admin_create',
                'guard_name'=> 'sanctum'
            ],
            [
                'name'=>'admin_edit',
                'guard_name'=> 'sanctum'
            ],
            [
                'name'=>'admin_del',
                'guard_name'=> 'sanctum'
            ],
            [
                'name'=>'empresa_view',
                'guard_name'=> 'sanctum'
            ],
            [
                'name'=>'empresa_create',
                'guard_name'=> 'sanctum'
            ],
            [
                'name'=>'empresa_edit',
                'guard_name'=> 'sanctum'
            ],
            [
                'name'=>'empresa_del',
                'guard_name'=> 'sanctum'
            ],
        ]);
    }
}
