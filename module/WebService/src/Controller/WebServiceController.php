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


class WebServiceController extends AbstractActionController
{
    public function __construct()
    {
    }
    
    public function indexAction()
    {
        $client = new \Zend\Soap\Client('http://localizapet.esy.es/public/server.php?wsdl');
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);
        return $view = new ViewModel([
            'animals' => $client->lista_animais()
        ]);
    }
    
   public function addActionOld()
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
        $animal->usuario_id = $auth->getIdentity();
        
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
            $soap = new Server();
            $soap->setOptions($options);
            $soap->setClass(\WebService\Soap\Servicos::class);
            $soap->handle();
            exit();
        }
    }
    
}

