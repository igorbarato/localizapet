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
            'home' => [
                'type' => 'literal',
                'options' => [
                    'route'    => '/home',
                    'defaults' => [
                        'controller' => Controller\WebServiceController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
//            'post' => [
//                'type' => 'segment',
//                'options' => [
//                    'route' => '/blog[/:action[/:id]]',
//                    'constraints' => [
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id' => '[0-9]+',
//                    ],
//                    'defaults' => [
//                        'controller' => Controller\WebServiceController::class,
//                        'action' => 'index'
//                    ]
//                ]
//            ],
            'pet' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/pet[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AnimalController::class,
                        'action' => 'index'
                    ]
                ]
            ],
//            'registro' => [
//                'type' => 'segment',
//                'options' => [
//                    'route' => '/registro[/:action[/:id]]',
//                    'constraints' => [
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id' => '[0-9]+',
//                    ],
//                    'defaults' => [
//                        'controller' => Controller\RegistroController::class,
//                        'action' => 'index'
//                    ]
//                ]
//            ],
            'login' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/login[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\UsuarioController::class,
                        'action' => 'index'
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
            'registro' => __DIR__ . "/../view",
            'usuario' => __DIR__ . "/../view",
            'webservice' => __DIR__ . "/../view",
            'animal' => __DIR__ . "/../view"
        ]
    ]
];