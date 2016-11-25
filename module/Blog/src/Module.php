<?php
namespace Blog;
use Blog\Controller\BlogController;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
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
                Model\PostTable::class => function ($container) {
                    $tableGateway = $container->get(Model\PostTableGateway::class);
                    return new Model\PostTable($tableGateway);
                },
                Model\PostTableGateway::class => function ($container) {
                    
                    //dbAdapter = Variável de conexão com banco de Dados
                    $dbAdapter = $container->get(AdapterInterface::class);
                    
                    //resultSetPrototype = retorno do banco
                    $resultSetPrototype = new ResultSet();
                    
                    //Modelar como os dados devem vir no resultSetPrototype
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Post());
                    
                    return new TableGateway('post', $dbAdapter, null, $resultSetPrototype);
                }
            ]
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                BlogController::class => function ($container) {
                    return new BlogController(
                        $container->get(Model\PostTable::class)
                    );
                }
            ]
        ];
    }
}