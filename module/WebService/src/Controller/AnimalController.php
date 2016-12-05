<?php

namespace WebService\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\Client;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Zend\Http\PhpEnvironment\Request;
use WebService\Model\Animal;
use WebService\Model\Usuario;
use WebService;
use WebService\Database\Database;
use Zend\Authentication\AuthenticationService;


class AnimalController extends AbstractActionController
{
    public function __construct()
    {
    }
    
    public function indexAction()
    {   
        $auth = new AuthenticationService();
        var_dump($auth->getIdentity()['usuario_id']);
        $client = new \Zend\Soap\Client('http://localizapet.esy.es/public/server.php?wsdl');
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);
        return $view = new ViewModel([
            'animals' => $client->lista_animais()
        ]);
    }
    
   public function addAction()
   {

        $form = new WebService\Form\AnimalForm();
        $form->get('submit')->setValue('Adicionar Pet');
        
        $request = $this->getRequest();
        
        if (!$request->isPost()){
            
            return $view = new ViewModel([
                'form' => $form,
            ]);
        }
        
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return ['form' => $form];
        }
        
        $client = new \Zend\Soap\Client('http://localizapet.esy.es/public/server.php?wsdl');
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);
        
//        $client = new \Zend\Soap\Client('http://localhost:8080/server.php?wsdl', $options=null);
        
        $animal = new Animal();
        $usuario = new Usuario();
        
        $auth = new AuthenticationService();
//        var_dump($auth->getIdentity());
        
//        var_dump($form->getData());
        $data = $form->getData();
        $animal->nome = $data['nome'];
        $animal->idade = $data['idade'];
        $animal->sexo = $data['sexo'];
        $animal->detalhes = $data['detalhes'];
        $animal->cor = $data['cor'];
        $animal->foto = $data['foto'];
        $animal->porte = $data['porte'];
        $animal->raca_id = $data['raca'];
        $animal->especie_id = $data['especie'];
        $animal->usuario_id = $auth->getIdentity()['usuario_id'];
        
//        $animal_data = [
//            'animal' => [
//                'animal_id' => '',
//                'nome' => 'Pluto',
//                'idade' => 2,
//                'sexo' => 2,
//                'detalhes' => 'teste',
//                'cor' => '#ffffff',
//                'foto' => '',
//                'porte' => 2,
//                'usuario_id'=> 1,
//                'raca_id' => 1,
//                'especie_id' => 2
//            ]
//        ];
        $client->cadastrar_animal($animal);
        
        return $this->redirect()->toRoute('pet');
                
   }
   
    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('post');
        }
        try {
            $post = $this->table->find($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('post');
        }
        $form = new PostForm();
        $form->bind($post);
        $form->get('submit')->setAttribute('value', 'Edit Post');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return [
                'id' => $id,
                'form' => $form
            ];
        }
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return [
                'id' => $id,
                'form' => $form
            ];
        }
        $this->table->save($post);
        return $this->redirect()->toRoute('post');
    }
    
    public function deleteAction(){
        $id = (int)$this->params()->fromRoute('id', 0);
        
        if (!$id){
            return $this->redirect()->toRoute('post');
        }
        
        $this->table->delete($id);
        return $this->redirect()->toRoute('post');
            
    }
    
    public function tcuAction(){
        libxml_disable_entity_loader(false);
        
        
        // options for ssl in php 5.6.5
        $opts = array(
            'ssl' => array(
                'ciphers'=>'RC4-SHA', 
                'verify_peer'=>false, 
                'verify_peer_name'=>false
            )
        );
        // SOAP 1.2 client
        $params = array (
            'encoding' => 'UTF-8', 
//             'verifypeer' => false, 
//             'verifyhost' => false, 
            'soap_version' => SOAP_1_1, 
            'trace' => 1, 
            'exceptions' => 1, 
            "connection_timeout" => 180, 
            'stream_context' => stream_context_create($opts) 
            
        );
//         $oSoapClient = new SoapClient ( $url . "?WSDL", $params );
        $opt = array('trace'=>true);
        
           $client = new Client('http://localhost:8080/service?wsdl', ['stream_context' => stream_context_create($opts)]);
           $client->setWSDLCache(false);
           $client->setSoapVersion(SOAP_1_1);
//            phpinfo();
           
//            $client->setOptions($opt);
//             $result = $client->soma(11,2);
//            file_get_contents("http://127.0.0.1:8080/service?wsdl");
        return new ViewModel([
            'client' => $client
        ]);
    }
    
    public function webAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (! isset($_GET['wsdl'])) {
                header('HTTP/1.1 400 Client Error');
                return;
            }
        
            $autodiscover = new AutoDiscover();
//             $autodiscover->setClass(\WebService\Soap\Client::class)
            $autodiscover->setClass(\WebService\Model\AnimalTable::class)
                            ->setBindingStyle(array('style' => 'document'))
                            ->setUri('http://localhost:8080/service');
            $viewModel = new viewModel();
            //desativa layout
            $viewModel->setTerminal(true);
            $wsdl = $autodiscover->generate();
            header('Content-type: application/xml');
//             $wsdl = $wsdl->toDomDocument();
            echo $wsdl->toXML();
//             return $viewModel;
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('HTTP/1.1 400 Client Error');
            return;
        }
        
        // pointing to the current file here
        $soap = new Server('http://localhost:8080/service?wsdl',[
            'cache_wsdl' => WSDL_CACHE_NONE
        ]);
        $request = new Request();
        $soap->setClass(\WebService\Model\AnimalTable::class)
             ->setSoapVersion(SOAP_1_1)
                ->setWSDLCache(false);
        $viewModel = new viewModel();
        $viewModel->setTerminal(true);
//         ob_start();
        $soap->handle($request);
//         simplexml_load_string(file_get_contents('http://127.0.0.1:8080/service?wsdl'));
        $request = $soap->getLastRequest();
        
//         return $viewModel;
//         $response = ob_get_clean();
        return;
        
    }
    
    public function serverAction(){
//        $url="http://localhost:8080/server.php?wsdl";
        $url="http://localizapet.esy.es/public/server.php?wsdl";
        if (isset($_GET['wsdl'])) {
            $autodiscover = new AutoDiscover();
            $autodiscover->setClass(\WebService\Soap\Servicos::class)
//                            ->setBindingStyle(array('style' => 'document'))
//                           ->setUri("http://localhost:8080/server.php");
                           ->setUri("http://localizapet.esy.es/public/server.php");
            $viewModel = new viewModel();
            $viewModel->setTerminal(true);
            
            $wsdl = $autodiscover->generate();
            $wsdl->addComplexType(WebService\Model\Registro::class);
            $wsdl->addComplexType(WebService\Model\Animal::class);
            $wsdl->addComplexType(WebService\Model\Raca::class);
            $wsdl->addComplexType(WebService\Model\Especie::class);
            $wsdl->addComplexType(WebService\Model\Usuario::class);
            
            header('Content-type: application/xml');
            echo $wsdl->toXml();
//            return $viewModel;
            exit();
            
        } else {
            $options = array(
                'uri' => 'urn:Servicos',
                'cache_wsdl' => WSDL_CACHE_NONE,
                'location' => $url
            );
            $soap = new Server(null, $options);
            $soap->setClass(\WebService\Soap\Servicos::class);
            $soap->handle();
            exit();
        }
    }
    
}

