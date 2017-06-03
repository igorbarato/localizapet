<?php
namespace Localizapet\Model;

class Raca
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $especie;

    /**
     * @var string
     */
    public $raca;

    public function __construct() {
    }

    /**
     * @return mixed
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
     * @param string $raca
     */
    public function setRaca($raca)
    {
        $this->raca = $raca;
    }


    /**
     * @return string
     */
    public function getRaca()
    {
        return $this->raca;
    }

    /**
     * @return string
     */
    public function getEspecie()
    {
        return $this->especie;
    }

    /**
     * @param string $especie
     */
    public function setEspecie($especie)
    {
        $this->especie = $especie;
    }
    


}

