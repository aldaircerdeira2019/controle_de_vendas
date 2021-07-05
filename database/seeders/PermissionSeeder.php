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
                'guard_name'=> 'vizualizar'
            ],
            [
                'name'=>'admin_create',
                'guard_name'=> 'cadastrar'
            ],
            [
                'name'=>'admin_edit',
                'guard_name'=> 'atualizar'
            ],
            [
                'name'=>'admin_del',
                'guard_name'=> 'apagar'
            ],
            [
                'name'=>'empresa_view',
                'guard_name'=> 'vizualizar'
            ],
            [
                'name'=>'empresa_create',
                'guard_name'=> 'cadastrar'
            ],
            [
                'name'=>'empresa_edit',
                'guard_name'=> 'atualizar'
            ],
            [
                'name'=>'empresa_del',
                'guard_name'=> 'apagar'
            ],
        ]);
    }
}
