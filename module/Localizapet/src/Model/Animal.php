<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/04/2017
 * Time: 22:19
 */

namespace WebService\Model;


class Animal
{
    private $animal_id;

    private $nome;

    private $sexo;

    private $detalhes;

    private $foto;

    private $usuario_id;

    private $raca_id;

    private $especie_id;

    function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getAnimalId()
    {
        return $this->animal_id;
    }

    /**
     * @param mixed $animal_id
     */
    public function setAnimalId($animal_id)
    {
        $this->animal_id = $animal_id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getDetalhes()
    {
        return $this->detalhes;
    }

    /**
     * @param mixed $detalhes
     */
    public function setDetalhes($detalhes)
    {
        $this->detalhes = $detalhes;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * @param mixed $usuario_id
     */
    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return mixed
     */
    public function getRacaId()
    {
        return $this->raca_id;
    }

    /**
     * @param mixed $raca_id
     */
    public function setRacaId($raca_id)
    {
        $this->raca_id = $raca_id;
    }

    /**
     * @return mixed
     */
    public function getEspecieId()
    {
        return $this->especie_id;
    }

    /**
     * @param mixed $especie_id
     */
    public function setEspecieId($especie_id)
    {
        $this->especie_id = $especie_id;
    }

}