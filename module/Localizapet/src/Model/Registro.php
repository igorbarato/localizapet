<?php

namespace Localizapet\Model;


class Registro {
    
    /** @var int */
    private $id;

    /** @var string */
    private $nome;

    /** @var string */
    private $sexo;

    /** @var string */
    private $detalhes;

    /** @var string */
    private $foto;

    /** @var int */
    private $raca_id;

    /** @var string */
    private $data;

    /** @var string */
    private $endereco;
    
    /** @var double */
    private $latitude;
    
    /** @var double */
    private $longitude;
    
    /** @var int */
    private $tipo_registro;
    
    /** @var int */
    private $status;
    
    /** @var int */
    private $usuario_id;

    /**
     * Registro constructor.
     * @param int $id
     * @param string $nome
     * @param string $sexo
     * @param string $detalhes
     * @param string $foto
     * @param int $raca_id
     * @param string $data
     * @param string $endereco
     * @param float $latitude
     * @param float $longitude
     * @param int $tipo_registro
     * @param int $status
     * @param int $usuario_id
     */
    public function __construct(
        $id = null,
        $nome = null,
        $sexo = null,
        $detalhes = null,
        $foto = null,
        $raca_id = null,
        $data = null,
        $endereco = null,
        $latitude = null,
        $longitude = null,
        $tipo_registro = null,
        $status = null,
        $usuario_id = null)
    {

        $this->id = $id;
        $this->nome = $nome;
        $this->sexo = $sexo;
        $this->detalhes = $detalhes;
        $this->foto = $foto;
        $this->raca_id = $raca_id;
        $this->data = $data;
        $this->endereco = $endereco;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->tipo_registro = $tipo_registro;
        $this->status = $status;
        $this->usuario_id = $usuario_id;
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
        return $this->raca_id;
    }

    /**
     * @param int $raca_id
     */
    public function setRacaId($raca_id)
    {
        $this->raca_id = $raca_id;
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
        return $this->usuario_id;
    }

    /**
     * @param int $usuario_id
     */
    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }




}
