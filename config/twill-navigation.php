<?php

return [
    'pages' => [
        'title' => 'Pages',
        'module' => true,
        'can' => 'list',
    ],
    'partners' => [
        'title' => 'Partners',
        'module' => true,
        'can' => 'list',
    ],
    'settings' => [
        'title' => 'Settings',
        'route' => 'admin.settings',
        'params' => ['section' => 'home'],
        'primary_navigation' => [
            'home' => [
                'title' => 'Home page',
                'route' => 'admin.settings',
                'params' => ['section' => 'home']
            ],
            'home-boxes' => [
                'title' => 'Home page boxes',
                'route' => 'admin.settings',
                'params' => ['section' => 'home-boxes']
            ],
            'newsletter' => [
                'title' => 'Newsletter',
                'route' => 'admin.settings',
                'params' => ['section' => 'newsletter']
            ],
            'specialist-register' => [
                'title' => 'Specialist register',
                'route' => 'admin.settings',
                'params' => ['section' => 'specialist-register']
            ],
            'about' => [
                'title' => 'About the project',
                'route' => 'admin.settings',
                'params' => ['section' => 'about']
            ],
            'document' => [
                'title' => 'Document upload form',
                'route' => 'admin.settings',
                'params' => ['section' => 'document']
            ],
            'ask-for-help-form' => [
                'title' => 'Ask for help form',
                'route' => 'admin.settings',
                'params' => ['section' => 'ask-for-help-form']
            ],
        ],
    ],
    'static' => [
        'title' => 'Dashboard',
        'route' => 'twill.admin.dashboard',
    ],
];
