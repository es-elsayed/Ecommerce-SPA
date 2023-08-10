<?php
namespace App\Services;

class Menu
{
    public static function nav()
    {
        return [
            [
                'label' => 'Dashboard',
                'url' => route('admin.dashboard'),
                'isActive' => request()->routeIs('admin.dashboard'),
                // 'type' => 'flat',
                'isVisible' => true,
            ],
            [
                'label' => 'Privileges',
                // 'type' => 'dropdown',
                'isActive' => request()->routeIs('admin.permissions.*') || request()->routeIs('admin.roles.*'),
                'url' => [
                    [
                        'label' => 'Roles',
                        'url' => route('admin.roles.index'),
                        'isActive' => request()->routeIs('admin.roles.*'),
                        'isVisible' => request()->user()?->can('roles-read'),
                    ],
                    [
                        'label' => 'Permissions',
                        'url' => route('admin.permissions.index'),
                        'isActive' => request()->routeIs('admin.permissions.*'),
                        'isVisible' => request()->user()?->can('permissions-read'),
                    ],
                ],
                'isVisible' => request()->user()?->can('permissions-read') || request()->user()?->can('roles-read'),
            ],
            [
                'label' => 'Users',
                'url' => route('admin.users.index'),
                'isActive' => request()->routeIs('admin.users.*'),
                // 'type' => 'flat',
                'isVisible' => request()->user()?->can('users-read'),
            ],
            // [
            //     'label' => 'Categories',
            //     'url' => route('admin.categories.index'),
            //     'isActive' => request()->routeIs('admin.categories.*'),
            // 'type' => 'flat',
            //     'isVisible' => request()->user()?->can('categories-read'),
            // ],
            // [
            //     'label' => 'Products',
            //     'url' => route('admin.products.index'),
            //     'isActive' => request()->routeIs('admin.products.*'),
            // 'type' => 'flat',
            //     'isVisible' => request()->user()?->can('products-read'),
            // ],
        ];
    }
}
