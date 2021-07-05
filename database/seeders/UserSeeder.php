<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name'=>'Aldair Cerdeira',
                'email'=>'admin@admin',
                'password'=>Hash::make('12345678'),
            ],
            [
                'name'=>'Usuario empresa',
                'email'=>'admin@empresa',
                'password'=>Hash::make('12345678'),
            ],
        ]);

        User::factory()->count(200)->create();

    }
}
