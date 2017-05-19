<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 04/05/2017
 * Time: 05:15
 */

namespace Localizapet\Controller;


use Localizapet\Model\Raca;
use Localizapet\Model\Registro;
use Localizapet\Service\Servicos;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Zend\Soap\Wsdl;
use Zend\View\Model\ViewModel;

class WebServiceController extends AbstractActionController
{

    public function __construct()
    {
    }

    public function serverAction()
    {
        $url="http://localizapet.pe.hu/localizapet/public/soap.php?wsdl";
//        $url = "http://localhost/zend/localizapet/public/server?wsdl";
        if (isset($_GET['wsdl'])) {
            $autodiscover = new AutoDiscover();
            $autodiscover->setClass(Servicos::class);
            $autodiscover->setUri("http://localhost/zend/localizapet/public/server");
            $viewModel = new ViewModel();
            $viewModel->setTerminal(true);

            $wsdl = $autodiscover->generate();
//            $wsdl->addComplexType(\Localizapet\Model\Registro::class);
//            $wsdl->addComplexType(\Localizapet\Model\Raca::class);

            header('Content-type: application/xml');
            echo $wsdl->toXml();
            exit();


        } else {
            $viewModel = new ViewModel();
            $viewModel->setTerminal(true);
            $options = array(
                'uri' => 'urn:Servicos',
                'cache_wsdl' => WSDL_CACHE_NONE,
                'location' => $url
            );
            $soap = new Server(null, $options);
            $soap->setClass(Servicos::class);
//            $soap->setEncoding('ISO-8859-1');
//            $soap->setEncoding('UTF-8');
            $soap->handle();
            exit();
        }
    }

        public function servermanualAction()
        {


//        $url="http://localizapet.pe.hu/localizapet/public/soap.php?wsdl";
            $url = "http://localhost/zend/localizapet/public/server?wsdl";
            if (isset($_GET['wsdl'])) {

                $wsdl = new Wsdl('Servicos', 'http://localhost/zend/localizapet/public/servermanual');

                $raca = array(
                    'name' => 'item',
                    'sequence' => array(
                        array(
                            'name' => 'id',
                            'type' => 'xsd:int'
                        ),
                        array(
                            'name' => 'especie',
                            'type' => 'xsd:int'
                        ),
                        array(
                            'name' => 'raca',
                            'type' => 'xsd:string'

                        )
                    )
                );
                $element = array(
                    'name' => 'getRaca',
                    'type' => 'tns:Raca'
                );

                $wsdl->addElement($raca);
                $wsdl->addElement($element);


                $wsdl->addMessage('listaRacasIn',null);
                $wsdl->addMessage('listaRacasResponse',array('getRaca' => array('element' => 'tns:getRaca')));
                $viewModel = new ViewModel();
                $viewModel->setTerminal(true);
                $wsdl->addComplexType(\Localizapet\Model\Raca::class);
//                $wsdl->addComplexType('Raca');


                $portType = $wsdl->addPortType('ServicosPort');
                $wsdl->addPortOperation($portType, 'listaRacas','tns:listaRacasIn', 'tns:listaRacasResponse');

                $binding = $wsdl->addBinding('ServicosBinding', 'tns:ServicosPort');
                $wsdl->addSoapBinding($binding, $style = 'rpc', $transport = 'http://schemas.xmlsoap.org/soap/http');
                $body = array(
                    'use' => 'literal'
//                    'encodingStyle' => 'http://schemas.xmlsoap.org/soap/encoding/',
//                    'namespace' => 'http://localhost/zend/localizapet/public/servermanual'
                );
                $operation = $wsdl->addBindingOperation($binding, 'listaRacas', $body, $body);
                $wsdl->addSoapOperation($operation, 'http://localhost/zend/localizapet/public/servermanual#listaRacas');

                $wsdl->addService('ServicoService', 'ServicosPort', 'tns:ServicosBinding', 'http://localhost/zend/localizapet/public/servermanual');


//            $wsdl->addComplexType(\Localizapet\Model\Raca::class);

//            $wsdl->addType(Servicos::class, 'tns:Raca');
//                $portType = $wsdl->addPortType('ServicosPort');

//                $wsdl->addPortOperation($portType, 'listaRacas', 'tns:listaRacasIn', 'tns:listaRacasOut');
//                $wsdl->addMessage('listaRacasOut', array('element' => 'tns:Raca'));


                header('Content-type: application/xml');
                echo $wsdl->toXml();
                exit();
                function listaRacas()
                {
                    $racas = new \Localizapet\Database\DaoRacas();
                    return $racas->findAll();
                }

            } else {
                $viewModel = new ViewModel();
                $viewModel->setTerminal(true);
                $options = array(
                    'uri' => 'urn:Servicos',
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'location' => $url
                );
                $soap = new Server(null, $options);
                $soap->setClass(Servicos::class);
//            $soap->setEncoding('ISO-8859-1');
//            $soap->setEncoding('UTF-8');
                $soap->handle();
                exit();
            }
        }



}
