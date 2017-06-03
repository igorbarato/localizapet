<?php

namespace Localizapet\Controller;

use Localizapet\Database\DaoRegistros;
use Localizapet\Form\RegistroForm;
use Localizapet\Form\PostForm;
use Localizapet\Model\PostTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap\Client;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Zend\Http\PhpEnvironment\Request;
use Localizapet\Model\Registro;
use Localizapet\Model\Usuario;
use Localizapet;
use Localizapet\Database\Database;

class RegistroController extends AbstractActionController
{
    public function __construct()
    {
    }

    public function indexAction()
    {
        $client = new \Zend\Soap\Client('http://192.168.0.80/server?wsdl');
        ini_set("soap.wsdl_cache_enabled", 0);
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_1);
        \Zend\Debug\Debug::dump($client->getFunctions());
        $response = [];

//        \Zend\Debug\Debug::dump($client->__());

        try{
            $response = $client->call('listaRegistros', null);
        }catch (\SoapFault $e){
            $response = $client->getLastResponse();
//            $response = str_replace("&#x1A",'',$response); ///My Invalid Symbol
//            $response = str_ireplace(array('SOAP-ENV:','SOAP:'),'',$response);
//            $response = simplexml_load_string($response);
            \Zend\Debug\Debug::dump($response);
        }
        return $view = new ViewModel([
            'registro' => $client->listaRegistros()
        ]);
    }

    public function listaAction()
    {
        $client = new \Zend\Soap\Client('http://192.168.0.80/server?wsdl');
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);
        \Zend\Debug\Debug::dump($client->getFunctions());
        return $view = new ViewModel([
            'registro' => $client->listaRegistros()
        ]);
    }

    public function addAction()
    {

        $form = new RegistroForm();
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

//        $client = new \Zend\Soap\Client('http://localizapet.esy.es/public/server.php?wsdl');
//        $client->setWSDLCache(false);
//        $client->setSoapVersion(SOAP_1_2);
//      
        //Retorna ID do usuário logado
//        $auth = new AuthenticationService();

        $registro = new Registro();
        $client = new DaoRegistros();
//
        $data = $form->getData();
//        $registro->setData(strtotime($data['data']));
//        var_dump($registro->data);
        $registro->setTipoRegistro($data['tipo_registro']);
        $registro->setNome($data['nome']);
        $registro->setSexo($data['sexo']);
        $registro->setDetalhes($data['detalhes']);
        $registro->setFoto($data['foto']);
        $registro->setRacaId($data['raca']);
        $registro->setData($data['data']);
        $registro->setEndereco($data['endereco']);
        $registro->setLatitude($data['latitude']);
        $registro->setLongitude($data['longitude']);
        $registro->setStatus($data['status']);
        $registro->setUsuarioId($data['usuario_id']);

        $client->save($registro);
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