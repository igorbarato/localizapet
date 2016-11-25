<?php

namespace Blog;

return [
    'controllers' => [
        'factories' => [
            #Controller\BlogController::class => InvokableFactory::class
        ]
    ],
    'router' => [
        'routes' => [

            'post' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/blog[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\BlogController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'soap' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/service',
                    'defaults' => [
                        'controller' => Controller\BlogController::class,
                        'action' => 'web'
                    ]
                ]
            ],

        ]


    ],
    'view_manager' => [
        'template_path_stack' => [
            'blog' => __DIR__ . "/../view"
        ]
    ]
];