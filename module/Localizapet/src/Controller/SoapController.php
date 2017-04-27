<?php

namespace Localizapet\Controller;

use Localizapet\Model\Testes;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\Client;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Localizapet;


class SoapController extends AbstractActionController
{
    public function __construct()
    {
    }

    public function indexAction()
    {
        $client = new \Zend\Soap\Client('http://localizapet.esy.es/public/soap.php?wsdl');
//        $client = new \Zend\Soap\Client('"http://localhost/zend/localizapet/public/soap.php?wsdl');
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);
        $temp = $client->listar();
        \Zend\Debug\Debug::dump($temp);

    }

    public function serverAction(){
//        $url="http://localhost/zend/localizapet/public/soap.php?wsdl";
        $url="http://localizapet.esy.es/public/soap.php?wsdl";
        if (isset($_GET['wsdl'])) {
            $autodiscover = new AutoDiscover();
            $autodiscover->setClass(Localizapet\Model\Teste::class);
//                            ->setBindingStyle(array('style' => 'document'))
//             $autodiscover->setUri("http://localhost/zend/localizapet/public/soap.php");
//            $autodiscover->setServiceName('Teste');
            $autodiscover->setUri("http://localizapet.esy.es/public/soap.php");
            $viewModel = new viewModel();
            $viewModel->setTerminal(true);
            
            $wsdl = $autodiscover->generate();
            $element = array(
                'name' => 'Teste',
                'all' => array(
                    array(
                        'name' => 'id',
                        'type' => 'xsd:int'
                    ),
                    array(
                        'name' => 'Image',
                        'type' => 'xsd:base64Binary'

                    )
                )
            );
            $wsdl->addElement($element);


//            $wsdl->addComplexType(WebService\Model\Registro::class);
//            $wsdl->addComplexType(WebService\Model\Animal::class);
//            $wsdl->addComplexType(WebService\Model\Raca::class);
//            $wsdl->addComplexType(WebService\Model\Especie::class);
//            $wsdl->addComplexType(WebService\Model\Usuario::class);
            
            header('Content-type: application/xml');
            echo $wsdl->toXml();
//            return $viewModel;
            exit();
            
        } else {
            $options = array(
                'uri' => 'urn:Teste',
                'cache_wsdl' => WSDL_CACHE_NONE,
                'location' => $url
            );
            $soap = new Server(null, $options);
            $soap->setClass(Teste::class);
            $soap->handle();
            exit();
        }
    }
    
}

