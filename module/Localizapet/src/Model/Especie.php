<?php
namespace WebService\Model;

class Especie
{
    /**
     *
     * @var int 
     */
    public $especie_id;
    
    /**
     *
     * @var string
     */
    public $nome;
    
    public function __construct($nome){
        $this->especie_id = 0;
        $this->nome = $nome;
    }
    
    function getEspecie_id() {
        return $this->especie_id;
    }

    function getNome() {
        return $this->nome;
    }

    function setEspecie_id($especie_id) {
        $this->especie_id = $especie_id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }


    
}

