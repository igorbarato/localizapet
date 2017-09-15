<?php

namespace Localizapet\Model;


class Registro {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $nome;

    /** @var string */
    public $sexo;

    /** @var string */
    public $detalhes;

    /** @var string */
    public $foto;

    /** @var \Localizapet\Model\Raca */
    public $raca;

    /** @var string */
    public $data;

    /** @var string */
    public $endereco;
    
    /** @var double */
    public $latitude;
    
    /** @var double */
    public $longitude;
    
    /** @var int */
    public $tipo_registro;
    
    /** @var int */
    public $status;
    
    /** @var \Localizapet\Model\UsuarioModel */
    public $usuario;


    public function __construct(
        $id = null,
        $nome = null,
        $sexo = null,
        $detalhes = null,
        $foto = null,
        $raca = null,
        $data = null,
        $endereco = null,
        $latitude = null,
        $longitude = null,
        $tipo_registro = null,
        $status = null,
        $usuario = null)
    {

        $this->id = $id;
        $this->nome = $nome;
        $this->sexo = $sexo;
        $this->detalhes = $detalhes;
        $this->foto = $foto;
        $this->raca = $raca;
        $this->data = $data;
        $this->endereco = $endereco;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->tipo_registro = $tipo_registro;
        $this->status = $status;
        $this->usuario = $usuario;
    }

    public function convertArrayObject($array){
        $this->id = $array['id'];
        $this->nome = $array['nome'];
        $this->sexo = $array['sexo'];
        $this->detalhes = $array['detalhes'];
        $this->foto = base64_encode($array['foto']);
        $this->raca->especie = $array['especie'];
        $this->raca->raca = $array['raca'];
        $this->data = $array['data'];
        $this->endereco = $array['endereco'];
        $this->latitude = $array['latitude'];
        $this->longitude = $array['longitude'];
        $this->tipo_registro = $array['tipo_registro'];
        $this->status = $array['status'];
        $this->usuario->login = $array['login'];
        $this->usuario->telefone = $array['telefone'];
    }

    function __destruct()
    {
        unset($this->data);
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return string
     */
    public function getDetalhes()
    {
        return $this->detalhes;
    }

    /**
     * @param string $detalhes
     */
    public function setDetalhes($detalhes)
    {
        $this->detalhes = $detalhes;
    }

    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return int
     */
    public function getRacaId()
    {
        return $this->raca;
    }

    /**
     * @param int $raca
     */
    public function setRacaId($raca)
    {
        $this->raca = $raca;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param string $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return int
     */
    public function getTipoRegistro()
    {
        return $this->tipo_registro;
    }

    /**
     * @param int $tipo_registro
     */
    public function setTipoRegistro($tipo_registro)
    {
        $this->tipo_registro = $tipo_registro;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getUsuarioId()
    {
        return $this->usuario;
    }

    /**
     * @param int $usuario
     */
    public function setUsuarioId($usuario)
    {
        $this->usuario = $usuario;
    }




}
