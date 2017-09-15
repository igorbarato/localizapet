<?php

namespace Localizapet\Controller;

use Localizapet\Database\DaoUsuarios;
use Localizapet\Form\UsuarioForm;
use Localizapet\Model\UsuarioModel;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\Client;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Zend\Http\PhpEnvironment\Request;
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
        $auth->clearIdentity();
//        \Zend\Debug\Debug::dump($auth->getIdentity());
        return $this->redirect()->toRoute('usuario',['action'=>'login']);
    }

    public function loginAction()
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


                //SOAP
                $client = new \Zend\Soap\Client('http://localizapet.site/server?wsdl');
                $client->setWSDLCache(false);
                $client->setSoapVersion(SOAP_1_2);
                $result = $client->login($login, $senha);

                //Database
//                $user = new \Localizapet\Database\DaoUsuarios();
//                $result = $user->login($login, $senha);
//                \Zend\Debug\Debug::dump($result);
            }
            ////////////////////////
            //Verifica no banco se há o login e senha e retorna o ID do usuário
//            $db = new \WebService\Database\Database();
//            $result = $db->login($login, $senha);
            ///////////////////////////
            
            if($result != NULL){
                //Seta o ID do usuário como parâmetro de Sessão
                $auth->getStorage()->write(['usuario_id' => $result]);

                $this->redirect()->toRoute('home');

            }else{
                $erro = 'Não foi possível realizar o login verifique o <strong>Usuário</strong> ou a <strong>Senha</strong>';
                return new ViewModel([
                    'form' => $form,
//                    'dados' => $data,
                    'erro'  => $erro
                ]);
            }
        }
//        \Zend\Debug\Debug::dump($form);
        return new ViewModel([ 'form' => $form ]);
    }
    
   public function cadastrarAction()
   {

        $form = new UsuarioForm();
        $form->get('submit')->setValue('Criar conta');
        
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

       $client = new \Zend\Soap\Client('http://localizapet.site/server?wsdl');
       ini_set("soap.wsdl_cache_enabled", 0);
       $client->setWSDLCache(false);
       $client->setSoapVersion(SOAP_1_2);
//       $client = new DaoUsuarios();
//        
//        $registro = new Registro();
        $usuario = new \Localizapet\Model\UsuarioModel();

//        
        $data = $form->getData();
       $usuario->setLogin($data['login']);
       $usuario->setSenha($data['senha']);
       $usuario->setTelefone($data['telefone']);

//       $client->save($usuario);

       $result = $client->call("cadastrarUsuario",array(
           $data['login'],
           $data['senha'],
           $data['telefone']
       ) );
//
//       $result = $client->call("cadastrarUsuario", $usuario);
//       \Zend\Debug\Debug::dump($result);
        return $this->redirect()->toRoute('usuario');
                
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

