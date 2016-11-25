<?php

namespace Blog\Controller;

use Blog\Form\PostForm;
use Blog\Model\Post;
use Blog\Model\PostTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\Client;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Zend\Http\PhpEnvironment\Request;

class BlogController extends AbstractActionController
{
    /**
     * @var PostTable
     */
    private $table;
    
    public function __construct(PostTable $table)
    {
        $this->table = $table;
    }
    
    public function indexAction()
    {
        $postTable = $this->table;
        return new ViewModel([
            'posts' => $postTable->fetchAll()
        ]);
    }
   public function addAction()
   {

        $form = new PostForm();
        $form->get('submit')->setValue('Add Post');
        
        $request = $this->getRequest();
        
        if (!$request->isPost()){
            return new ViewModel([
                'form' => $form,
            ]);   
        }
        
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return ['form' => $form];
        }
        
        $post = new Post();
        $post->exchangeArray($form->getData());
        $this->table->save($post);
        return $this->redirect()->toRoute('post');
                
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
        
           $client = new Client('http://localizapet.esy.es/public/service?wsdl', ['stream_context' => stream_context_create($opts)]);
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
            $autodiscover->setClass(\Blog\Soap\Client::class)
                            ->setBindingStyle(array('style' => 'document'))
                            ->setUri('http://localizapet.esy.es/public/service');
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
        $soap = new Server('http://localizapet.esy.es/public/service?wsdl',[
            'cache_wsdl' => WSDL_CACHE_NONE
        ]);
        $request = new Request();
        $soap->setClass(\Blog\Soap\Client::class)
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
        libxml_disable_entity_loader(false);
        $server = new \Zend\Soap\Server("http://localizapet.esy.es/public/service.wsdl", [
            'cache_wsdl' => WSDL_CACHE_NONE
        ]);
//         $server->setUri("http://localhost:8080/blog/server");
        $viewModel = new viewModel();
        $viewModel->setTerminal(true);
        $server
            ->setReturnResponse(true)
            ->setClass(\Blog\Soap\Client::class)
            ->setWSDLCache(false)
            ->setSoapVersion(SOAP_1_2)
            ->handle();
        return $viewModel;
    }
    
}

