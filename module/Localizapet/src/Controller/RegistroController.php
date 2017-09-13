<?php

namespace Localizapet\Controller;

use Localizapet\Database\DaoRegistros;
use Localizapet\Form\RegistroBuscaForm;
use Localizapet\Form\RegistroForm;
use Localizapet\Form\PostForm;
use Localizapet\Model\PostTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Uri\File;
use Zend\View\Model\ViewModel;
use Zend\Soap\Client;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Zend\Http\PhpEnvironment\Request;
use Localizapet\Model\Registro;
use Localizapet\Model\UsuarioModel;
use Localizapet;
use Localizapet\Database\Database;
use Zend\Authentication\AuthenticationService;

class RegistroController extends AbstractActionController
{
    public function __construct()
    {
    }

    public function indexAction()
    {

        $auth = new AuthenticationService();
//        \Zend\Debug\Debug::dump($auth->getIdentity());

        $client = new \Zend\Soap\Client('http://localizapet.site/server?wsdl');
        ini_set("soap.wsdl_cache_enabled", 0);
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_1);

//        $client = new DaoRegistros();
//        return $view = new ViewModel([
//            'registros' => $client->findAll()
//        ]);

        $rows = $client->call('listaRegistros');
        $listaRegistros = [];
        foreach ($rows as $row){
            $registro = new Registro();
            $registro = $row;
            array_push($listaRegistros, $registro);

        }
//        \Zend\Debug\Debug::dump($listaRegistros);

        return $view = new ViewModel([
//            'registros' => $client->call('listaRegistros')
            'registros' => $listaRegistros
        ]);
    }

    public function listAction()
    {

        $form = new RegistroBuscaForm();
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

        $client = new \Zend\Soap\Client('http://localizapet.site/server?wsdl');
        $client->setWSDLCache(false);
        $client->setSoapVersion(SOAP_1_2);


        $busca = [
                'operando' =>'r.raca_id',
                'operador'  => '=',
                'valor'     => '16'
        ];
        $buscas = [];
        array_push($buscas, $busca);

        $rows = $client->buscaRegistros($buscas);

        $listaRegistros = [];
        foreach ($rows as $row){
            $registro = new Registro();
            $registro = $row;
            array_push($listaRegistros, $registro);

        }
//        \Zend\Debug\Debug::dump($listaRegistros);

        return $view = new ViewModel([
//            'registros' => $client->call('listaRegistros')
            'registros' => $listaRegistros
        ]);
    }

    public function addAction()
    {
        $auth = new AuthenticationService();
//        \Zend\Debug\Debug::dump($auth->getIdentity());

        $form = new RegistroForm();
        $form->get('submit')->setValue('Adicionar Registro');

        $request = $this->getRequest();

        if (!$request->isPost()){
            return new ViewModel([
                'form' => $form,
            ]);
        }

         $data = array_merge_recursive(
             $request->getPost()->toArray(),
             $request->getFiles()->toArray()
         );

        $form->setData($data);
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
        $usuario = $auth->getIdentity();

        $data = $form->getData();
        $target_path = basename($data['foto']['name']);
        if(move_uploaded_file($data['foto']['tmp_name'], $target_path)) {
            $file = file_get_contents($data['foto']['name']);
            $imdata = base64_encode($file);
        }

//        $registro->setData(strtotime($data['data']));
//        var_dump($registro->data);
        $registro->setTipoRegistro($data['tipo_registro']);
        $registro->setNome($data['nome']);
        $registro->setSexo($data['sexo']);
        $registro->setDetalhes($data['detalhes']);
        $registro->setFoto(base64_encode($file));
        $registro->setRacaId($data['raca']);
        $registro->setData($data['data']);
        $registro->setEndereco($data['endereco']);
        $registro->setLatitude($data['latitude']);
        $registro->setLongitude($data['longitude']);
        $registro->setStatus($data['status']);
        $registro->setUsuarioId($usuario['usuario_id']);
        \Zend\Debug\Debug::dump($registro);

        $client->save($registro);
        exit();
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