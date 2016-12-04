<?php

namespace WebService;

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
                        'controller' => Controller\WebServiceController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'pet' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/pet[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\WebServiceController::class,
                        'action' => 'indexpet'
                    ]
                ]
            ],
            'server' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/server.php',
                    'defaults' => [
                        'controller' => Controller\WebServiceController::class,
                        'action' => 'server'
                    ]
                ]
            ],           

        ]


    ],
    'view_manager' => [
        'template_path_stack' => [
            'webservice' => __DIR__ . "/../view"
        ]
    ]
];