<?php

return [
    'admin' => [
        [
            'name' => 'Medios de Pago',
            'route' => 'payment_methods.index',
            'icon' => 'wallet',
        ],
        [
            'name' => 'Configuración',
            'icon' => 'settings',
            'isGroup' => true,
            'children' => [
                [
                    'name' => 'Usuarios',
                    'route' => 'users.index',
                    'icon' => 'users',
                ],
                [
                    'name' => 'Roles',
                    'route' => 'roles.index',
                    'icon' => 'fingerprint',
                ],
                [
                    'name' => 'Permisos',
                    'route' => 'permissions.index',
                    'icon' => 'circle-key',
                ],
            ],
        ],
    ],
];
