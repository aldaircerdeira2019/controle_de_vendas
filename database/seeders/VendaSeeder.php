<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venda;

class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Venda::factory()->count(1000)->create();
    }
}
