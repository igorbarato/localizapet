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
//            'soap' => [
//                'type' => 'literal',
//                'options' => [
//                    'route' => '/soap.php',
//                    'defaults' => [
//                        'controller' => Controller\SoapController::class,
//                        'action' => 'server'
//                    ]
//                ]
//            ],
//            'webservicemanual' => [
//                'type' => 'literal',
//                'options' => [
//                    'route' => '/servermanual',
//                    'defaults' => [
//                        'controller' => Controller\WebServiceController::class,
//                        'action' => 'servermanual'
//                    ]
//                ]
//            ],
            'webservice' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/server',
                    'defaults' => [
                        'controller' => Controller\WebServiceController::class,
                        'action' => 'server'
                    ]
                ]
            ],
//            'temp' => [
//                'type' => 'literal',
//                'options' => [
//                    'route' => '/temp',
//                    'defaults' => [
//                        'controller' => Controller\SoapController::class,
//                        'action' => 'index'
//                    ]
//                ]
//            ],
//            'nosoap' => [
//                'type' => 'literal',
//                'options' => [
//                    'route' => '/nosoap',
//                    'defaults' => [
//                        'controller' => Controller\SoapController::class,
//                        'action' => 'nosoap'
//                    ]
//                ]
//            ],
            'registro' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/registro[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\RegistroController::class,
                        'action' => 'index'
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