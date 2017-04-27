<?php

namespace WebService\Controller;

use WebService\Form\UsuarioForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\Client;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Zend\Http\PhpEnvironment\Request;
use WebService\Model\Usuario;
use Zend\Authentication\Storage;
use Zend\Authentication\AuthenticationService;

class UsuarioController extends AbstractActionController
{
    public function __construct()
    {
    }
    
    public function indexAction()
    {   
        
        $auth = new AuthenticationService();
//        var_dump($auth->getIdentity());
        $auth->clearIdentity();
//        var_dump($auth->getIdentity());

//        session_reset();
        $form = new UsuarioForm();
        $form->get('submit')->setValue('Login');
        
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                $login = $form->get("login")->getValue();
                $senha = $form->get("senha")->getValue();
                
                $client = new \Zend\Soap\Client('http://localizapet.esy.es/public/server.php?wsdl');
                $client->setWSDLCache(false);
                $client->setSoapVersion(SOAP_1_2);
                $result = $client->login($login, $senha);
            }
            ////////////////////////
            //Verifica no banco se há o login e senha e retorna o ID do usuário
//            $db = new \WebService\DAO\DAO();
//            $result = $db->login($login, $senha);
            ///////////////////////////
            
            if($result != NULL){
                //Seta o ID do usuário como parâmetro de Sessão
                $auth->getStorage()->write(['usuario_id' => $result]);
                
//                var_dump($auth->getIdentity());
                
                $this->redirect()->toRoute('home');
            }else{
                $erro = 'Não foi possível realizar o login verifique o <strong>Usuário</strong> ou a <strong>Senha</strong>';
                return new ViewModel([
                    'form' => $form,
                    'dados' => $data,
                    'erro'  => $erro
                ]);
            }
        }
        $view = new ViewModel(['form' => $form]);
        return $view;
    }
    
   public function addAction()
   {

        $form = new WebService\Form\RegistroForm();
        $form->get('submit')->setValue('Adicionar Registro');
        
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
        
        $client = new \Zend\Soap\Client('http://localizapet.esy.es/public/server.php?wsdl');
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);
//        
//        
        $registro = new Registro();
//        $usuario = new Usuario();
//        
        $data = $form->getData();
        $registro->data = strtotime($data['data']);
        var_dump($registro->data);
        $registro->latitude = $data['latitude'];
        $registro->longitude = $data['longitude'];
        $registro->tipo_registro = $data['tipo_registro'];
        $registro->status = $data['status'];
//        $registro->animal_id = $data['animal_id'];
        $registro->animal_id = 1;
//        $registro->usuario_id = $data['usuario_id'];
        $registro->usuario_id = 1;
        
        $client->inserir_registro($registro);
//        
        return $this->redirect()->toRoute('registro');
                
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
}

