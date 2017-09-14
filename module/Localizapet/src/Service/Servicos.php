<?php

namespace Localizapet\Service;
//use Localizapet\Model\Raca;


use Localizapet\Database\DaoRegistros;
use Localizapet\Model\Raca;
use Localizapet\Model\Registro;
use Localizapet\Model\UsuarioModel;
use Zend\Stdlib\ArrayObject;

class Servicos
{
    /**
     * @param string $login
     * @param string $senha
     * @return string $id
     */
    function login($login, $senha){
        $dao_usuarios = new \Localizapet\Database\DaoUsuarios();
        $result = $dao_usuarios->login($login, $senha);
        return $result;
    }

    /**
     * @param string $login
     * @param string $senha
     * @param string $telefone
     *
     * @return string $result
     */
    function cadastrarUsuario($login, $senha, $telefone){
        $dao_usuarios = new \Localizapet\Database\DaoUsuarios();
        $usuario = new UsuarioModel();
        $usuario->setLogin($login);
        $usuario->setSenha($senha);
        $usuario->setTelefone($telefone);
        $result = $dao_usuarios->save($usuario);
        return $result;
    }

//    /**
//     * @param \Localizapet\Model\UsuarioModel $usuario
//     *
//     */
//    function cadastrarUsuario(UsuarioModel $usuario){
//        $dao_usuarios = new \Localizapet\Database\DaoUsuarios();
//        $result = $dao_usuarios->save($usuario);
//        return $result;
//    }

    /**
     * @return \Localizapet\Model\Raca $raca
     */
    function listaRacas(){
        $racas = new \Localizapet\Database\DaoRacas();
        $rows = $racas->findAll();
        $listaRacas = new ArrayObject();
        $result = [];
        foreach($rows as $key => $row){
//            $result[$key] = array($row['id'], $row['especie'], $row['raca']);
            $raca = new Raca();
            $raca->setId($row['id']);
            $raca->setEspecie($row['especie']);
            $raca->setRaca($row['raca']);
            $result[$key] = $raca;
            $listaRacas->append($raca);
        }
        return $listaRacas->getArrayCopy();
    }

    /**
     * @param string $endereco
     * @param string $data
     * @param double $latitude
     * @param double $longitude
     * @param int $tipoRegistro
     * @param int $status
     * @param string $nome
     * @param int $sexo
     * @param string $detalhes
     * @param string $foto
     * @param int $raca_id
     * @param int $usuario_id
     */
    function insereRegistro($endereco, $data, $latitude, $longitude, $tipoRegistro,
                            $status, $nome, $sexo, $detalhes, $foto, $raca_id, $usuario_id){

    }

    /**
     * @param \Localizapet\Model\Registro $registro
     */
    function cadastraRegistro(Registro $registro){
        $client = new DaoRegistros();
        $client->save($registro);
    }

    /**
     * @return \Localizapet\Model\Registro $registro
     */
    function listaRegistros(){
        $daoRegistro = new DaoRegistros();
        //Método de busca de todos os registros
        $rows = $daoRegistro->findAll();

        //Trata o array retornado para uma lista de objetos
        $listaRegistros = new ArrayObject();
        foreach($rows as $key => $row){
            $registro = new Registro();
            $registro->convertArrayObject($row);
            $listaRegistros->append($registro);
        }

        //Retorna a lista de registros
        return $listaRegistros->getArrayCopy();
    }

    /**
     * @param Array
     * @return \Localizapet\Model\Registro $registro
     */
    function buscaRegistros($buscas){
        $daoRegistro = new DaoRegistros();
        //Método de busca de todos os registros
        $rows = $daoRegistro->findPerParameter($buscas);

        //Trata o array retornado para uma lista de objetos
        $listaRegistros = new ArrayObject();
        foreach($rows as $key => $row){
            $registro = new Registro();
            $registro->convertArrayObject($row);
            $listaRegistros->append($registro);
        }

        //Retorna a lista de registros
        return $listaRegistros->getArrayCopy();
    }

    /**
     * @return String
     */
    function hello(){
        return 'Hello Brasil';
    }
}