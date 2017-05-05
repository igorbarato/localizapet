<?php

namespace Localizapet\Service;
//use Localizapet\Model\Raca;


use Localizapet\Model\Raca;
use Localizapet\Model\Registro;
use Zend\Stdlib\ArrayObject;

class Servicos
{

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
    function cadastraRegistro(Registro $registro){}


    function listaRegistros(){
        $daoRegistro = new \Localizapet\Database\DaoRegistros();
        $rows = $daoRegistro->findAll();
        $listaRegistros = new ArrayObject();
//        $result = [];
        foreach($rows as $key => $row){
//            $result[$key] = array($row['id'], $row['especie'], $row['raca']);
            $foto = base64_encode($row['foto']);
            $registro = new Registro();
            $registro->setId($row['id']);
            $registro->setData($row['data']);
            $registro->setFoto($foto);
//            $registro->setEndereco($row['end']);
            $listaRegistros->append($registro);
        }
        return $listaRegistros->getArrayCopy();
    }
    /**
     * @return string
     */
    function hello(){
        return 'Hello';
    }
}