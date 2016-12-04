<?php

namespace WebService;

use WebService\Controller\WebServiceController;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
//                 Model\PostTable::class => function ($container) {
//                     $tableGateway = $container->get(Model\PostTableGateway::class);
//                     return new Model\PostTable($tableGateway);
//                 },
//                 Model\PostTableGateway::class => function ($container) {
                    
//                     //dbAdapter = Variável de conexão com banco de Dados
//                     $dbAdapter = $container->get(AdapterInterface::class);
                    
//                     //resultSetPrototype = retorno do banco
//                     $resultSetPrototype = new ResultSet();
                    
//                     //Modelar como os dados devem vir no resultSetPrototype
//                     $resultSetPrototype->setArrayObjectPrototype(new Model\Post());
                    
//                     return new TableGateway('post', $dbAdapter, null, $resultSetPrototype);
//                 },
//                 Model\AnimalTable::class => function ($container) {
//                     $tableGateway = $container->get(Model\AnimalTableGateway::class);
//                     return new AnimalTable($tableGateway);
//                 },
//                 Model\AnimalTableGateway::class => function ($container) {
                
//                     //dbAdapter = Variável de conexão com banco de Dados
//                     $dbAdapter = $container->get(AdapterInterface::class);
                
//                     //resultSetPrototype = retorno do banco
//                     $resultSetPrototype = new ResultSet();
                
//                     //Modelar como os dados devem vir no resultSetPrototype
//                     $resultSetPrototype->setArrayObjectPrototype(new Animal());
                
//                     return new TableGateway('animal', $dbAdapter, null, $resultSetPrototype);
//                 }
            ]
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                WebServiceController::class => function ($container) {
                    return new WebServiceController(
//                         $container->get(Model\PostTable::class)
//                         $container->get(Model\AnimalTable::class)
                    );
                }
            ]
        ];
    }
}