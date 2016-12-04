<?php
namespace WebService\Model;

use WebService\Database\Database;

class Raca extends Especie
{
    /**
     *
     * @var int
     */
    public $raca_id;
    /**
     *
     * @var string 
     */
    public $nome;
    /**
     *
     * @var \Blog\Model\Especie 
     */
//    public $especie;
    
    public function __construct() {
        $this->raca_id = 0;
        $this->nome = '';
        $this->setEspecie_id(1);
    }
    
 
//    public function cadastraRaca($nome, $especie_id){
//        $db = new Database();
//        
//        $this->setNome($nome);
//        $this->setEspecie_id($especie_id);
//        
//        $db->insertRaca($this);
//    } 
    
    /**
     * 
     * @param \Blog\Model\Raca $raca
     */
    public function cadastraRaca($raca){
        $db = new Database();
//        $this->setNome($nome);
//        $this->setEspecie_id($especie_id);
        
        $db->insertRaca($raca);
    } 
                
    function getRaca_id() {
        return $this->raca_id;
    }
    
    /**
     * 
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    function getEspecie() {
        return $this->especie;
    }
    
    /**
     * 
     * @param int $raca_id
     */
    function setRaca_id($raca_id) {
        $this->raca_id = $raca_id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEspecie($especie) {
        $this->especie = $especie;
    }


}

