<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            /** module users */
            [
                'name' => 'view users',
                'description' => 'Ver usuarios',
                'module' => 'Usuarios',
            ],
            [
                'name' => 'create user',
                'description' => 'Crear usuario',
                'module' => 'Usuarios',
            ],
            [
                'name' => 'edit user',
                'description' => 'Editar usuario',
                'module' => 'Usuarios',
            ],
            [
                'name' => 'delete user',
                'description' => 'Eliminar usuario',
                'module' => 'Usuarios',
            ],

            /** module payment methods */
            [
                'name' => 'view payment_methods',
                'description' => 'Ver medios de pago',
                'module' => 'Medios de pago',
            ],
            [
                'name' => 'create payment_method',
                'description' => 'Crear medio de pago',
                'module' => 'Medios de pago',
            ],
            [
                'name' => 'edit payment_method',
                'description' => 'Editar medio de pago',
                'module' => 'Medios de pago',
            ],
            [
                'name' => 'delete payment_method',
                'description' => 'Eliminar medios de pago',
                'module' => 'Medios de pago',
            ],

            /** module roles */
            [
                'name' => 'view roles',
                'description' => 'Ver roles',
                'module' => 'Roles',
            ],
            [
                'name' => 'create roles',
                'description' => 'Crear roles',
                'module' => 'Roles',
            ],
            [
                'name' => 'edit roles',
                'description' => 'Editar roles',
                'module' => 'Roles',
            ],
            [
                'name' => 'delete roles',
                'description' => 'Eliminar roles',
                'module' => 'Roles',
            ],
            /** module permissions */
            [
                'name' => 'view permissions',
                'description' => 'Ver permisos',
                'module' => 'Permisos',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
