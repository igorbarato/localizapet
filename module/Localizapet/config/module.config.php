<?php

namespace Localizapet;

return [
    'controllers' => [
        'factories' => [
            #Controller\BlogController::class => InvokableFactory::class
        ]
    ],
    'router' => [
        'routes' => [
            'soap' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/soap.php',
                    'defaults' => [
                        'controller' => Controller\SoapController::class,
                        'action' => 'server'
                    ]
                ]
            ],
            'temp' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/temp',
                    'defaults' => [
                        'controller' => Controller\SoapController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'nosoap' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/nosoap',
                    'defaults' => [
                        'controller' => Controller\SoapController::class,
                        'action' => 'nosoap'
                    ]
                ]
            ],

        ]


    ],
    'view_manager' => [
        'template_path_stack' => [
            'registro' => __DIR__ . "/../view",
            'usuario' => __DIR__ . "/../view",
            'webservice' => __DIR__ . "/../view",
            'animal' => __DIR__ . "/../view"
        ]
    ]
];