<?php

use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* LISTA DE TODOS LOS ROLES */
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Cliente']);
    }
}
