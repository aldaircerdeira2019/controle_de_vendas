<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\EmpresaHasUser;

class EmpresaHasUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresa_has_users')->insert([
            [
                'user_id'=> 2,
                'empresa_id'=> 1,
            ]
        ]);

        EmpresaHasUser::factory()->count(50)->create();
    }
}
