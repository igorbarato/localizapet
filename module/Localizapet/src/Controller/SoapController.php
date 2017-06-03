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
//        $client = new \Zend\Soap\Client('http://localhost/public/soap.php?wsdl');
        $client = new \Zend\Soap\Client('http://localizapet.pe.hu/localizapet/public/soap.php?wsdl');
//        $client->setOptions($params);
        $client->setEncoding('UTF-8');
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);
        $temp = $client->listar();
        \Zend\Debug\Debug::dump($temp);
        echo base64_encode($temp[0]['image']);





    }

    public function nosoapAction(){
        $viewModel = new viewModel();
        $viewModel->setTerminal(true);

        $client = new Localizapet\Database\DaoRegistros();
        $registro = new Localizapet\Model\Registro(
            76,
            'Pumer',
            1,
            'Cachorro de idade',
            null,
            1,
            1421766000,
            'Rua Marajó, 1830 - Vila Virgínia, Ribeirão Preto - SP',
            -21.194456,
            -47.837697,
            0,
            1,
            1
        );

        $client->save($registro);
            $temp = $client->findAll();
            \Zend\Debug\Debug::dump($temp);

        $clientRaca = new Localizapet\Service\Servicos();
        \Zend\Debug\Debug::dump($clientRaca->listaRacas());

//        echo "<img src=\"data:image/jpeg;base64, ". base64_encode($temp[0]['foto']) . "\" >";
//        echo "<img src=\"data:image/jpeg;base64, ". base64_encode($temp[1]['foto']) . "\" >";
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
            $soap->setEncoding('UTF-8');
            $soap->handle();
            exit();
        }
    }
    
}

