<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'=>'Administrador',
                'guard_name'=> 'usuario administrador'
            ],
            [
                'name'=>'Empresa',
                'guard_name'=> 'usuario de empresa'
            ],
        ]);
    }
}
