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
        Role::create(['name' => 'Administrator','language' => '{"en": "Administrator", "es": "Administrador"}']);
        Role::create(['name' => 'Customer','language' => '{"en": "Customer", "es": "Cliente"}']);
        Role::create(['name' => 'Member','language' => '{"en": "Member", "es": "Miembro"}']);
        Role::create(['name' => 'Provider','language' => '{"en": "Provider", "es": "Proveedor"}']);

    }
}
