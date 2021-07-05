<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(ModelRoleSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(ProdutoSeeder::class);
        $this->call(EmpresaHasUserSeeder::class);
        $this->call(VendaSeeder::class);

    }
}
