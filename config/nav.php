<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard.dashboard',

    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'active' => 'dashboard.categories.*',
        'ability' => 'categories.view'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'badge' => 'New',
        'active' => 'dashboard.products.*',
        'ability' => 'products.view'

    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.products.index',
        'title' => 'Orders',
        'badge' => '',
        'active' => 'dashboard.orders.*',
        'ability' => 'orders.view'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.roles.index',
        'title' => 'Roles',
        'badge' => '',
        'active' => 'dashboard.roles.*',
        'ability' => 'roles.view'
    ],


];
