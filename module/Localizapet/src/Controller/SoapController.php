<?php

namespace Localizapet\Controller;

use Localizapet\Model\Teste;
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
        $opts = array(
            'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
        );
// SOAP 1.2 client
        $params = array (
            'encoding' => 'UTF-8',
//            'verifypeer' => false,
//            'verifyhost' => false,
            'soap_version' => SOAP_1_2,
//            'trace' => 1,
//            'exceptions' => 1,
            "connection_timeout" => 180,
            'stream_context' => stream_context_create($opts)
        );
//        $client = new \Zend\Soap\Client('http://localizapet.esy.es/public/soap.php?wsdl');
        $client = new \Zend\Soap\Client('http://localizapet.pe.hu/localizapet/public/soap.php?wsdl');
//        libxml_disable_entity_loader(false);
//        $client->setOptions($params);
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);
        $teste = $client->getSoapClient();
        print_r($teste);
//        $client = new Teste();
        $temp = $client->listar();
//            $temp = $client->listar();
            \Zend\Debug\Debug::dump($temp);
        echo base64_encode($temp[0]['image']);




    }

    public function nosoapAction(){
        $client = new Teste();
        $temp = $client->listar();
//            $temp = $client->listar();
//            \Zend\Debug\Debug::dump($temp);
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $host = $_SERVER[HTTP_HOST];
        $uri = $_SERVER[REQUEST_URI];
        echo "Host:" . $host . "<br>";
        echo "Path:" . $uri . "<br>";
        echo $actual_link . "<br>";
        echo base64_encode($temp[0]['image']);
    }

    public function serverAction(){
        $url="http://localizapet.pe.hu/localizapet/public/soap.php?wsdl";
//        $url="http://localizapet.pe.hu/localizapet/public/soap.php?wsdl";
        if (isset($_GET['wsdl'])) {
            $autodiscover = new AutoDiscover();
            $autodiscover->setClass(Teste::class);
//                            ->setBindingStyle(array('style' => 'document'))
             $autodiscover->setUri("http://localizapet.pe.hu/localizapet/public/soap.php");
//            $autodiscover->setServiceName('Teste');
//            $autodiscover->setUri("http://localizapet.esy.es/public/soap.php");
            $viewModel = new viewModel();
            $viewModel->setTerminal(true);

            $wsdl = $autodiscover->generate();
//            $wsdl->addComplexType(Teste::class);
//            $wsdl->addType('base64', 'xsd:base64Binary');
//            $element = array(
//                'name' => 'Teste',
//                'all' => array(
//                    array(
//                        'name' => 'id',
//                        'type' => 'xsd:int'
//                    ),
//                    array(
//                        'name' => 'image',
//                        'type' => 'xsd:base64Binary'
//
//                    )
//                )
//            );
//            $wsdl->addElement($element);


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
//            $soap->setEncoding('ISO-8859-1');
//            $soap->setEncoding('UTF-8');
            $soap->handle();
            exit();
        }
    }
    
}

