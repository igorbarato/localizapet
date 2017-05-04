<?php

namespace WebService\Model;

use WebService\Database\Database;
use WebService\Model\Usuario;

class Animal extends Raca
{   
    /** @var int */
    public $animal_id;
    
    /** @var string */
    public $nome;
    
    /** @var int */
    public $idade;
    
    /** @var string */
    public $sexo;
    
    /** @var string */
    public $detalhes;
    
    /** @var string */
    public $cor;

    /** @var string */
    public $foto;
    
    /** @var string */
    public $porte;
    
    /** @var int */
    public $usuario_id;
    
    /** @var int */
    public $raca_id;
    
    /** @var int */
    public $especie_id;
            
    function __construct(){
//    function __construct($animal_id, $nome, $idade, $sexo, $detalhes, $cor, 
//            $foto, $porte, $usuario, $raca, $especie) {
//        $this->animal_id = $animal_id;
//        $this->nome = $nome;
//        $this->idade = $idade;
//        $this->sexo = $sexo;
//        $this->detalhes = $detalhes;
//        $this->cor = $cor;
//        $this->foto = $foto;
//        $this->porte = $porte;
//        $this->usuario = $usuario;
//        $this->setRaca($raca);
//        $this->setEspecie($especie);
    }

    public function paginate(){

    }

    public function get($id){

    }

    public function save(Animal $entity){

    }

    public function delete(){

    }


    public function listaAnimais(){
        $db = new Database();
        return $db->query('SELECT * FROM animal;');
    }
    
    /**
     * 
     * @param string $nome
     * @param int $idade
     * @param int $sexo
     * @param string $detalhes
     * @param int $usuario_id
     * @param string $foto
     * @param int $raca_id
     * @param int $especie_id
     * @param string $cor
     * @param int $porte
     */
//    public function cadastraPet($nome, $idade, $sexo, $detalhes, $usuario, $foto,
//            $raca_id, $especie_id, $cor, $porte){
//        $db = new Database();
//        
//        $this->setNome($nome);
//        $this->setIdade($idade);
//        $this->setSexo($sexo);
//        $this->setDetalhes($detalhes);
//        $this->setCor($cor);
//        $this->setFoto($foto);
//        $this->setPorte($porte);
//        $this->setRaca_id($raca_id);
//        $this->setEspecie_id($especie_id);
//        $this->setUsuario($usuario);
//        
//        $db->insert_Animal($this);
//    }
    /**
     * 
     * @param \Blog\Model\Animal $animal
     */
    public function cadastraPet($animal){
        $db = new Database();
        
//        $this->setNome($nome);
//        $this->setIdade($idade);
//        $this->setSexo($sexo);
//        $this->setDetalhes($detalhes);
//        $this->setCor($cor);
//        $this->setFoto($foto);
//        $this->setPorte($porte);
////        $this->raca->setRaca_id($raca_id);
//        $this->setRaca_id($raca_id);
//        $this->setEspecie_id($especie_id);
//        $this->setUsuario($usuario);
        
        $db->insert_Animal($animal);
    }
    
    function getAnimal_id() {
        return $this->animal_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getDetalhes() {
        return $this->detalhes;
    }

    public function getCor() {
        return $this->cor;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getPorte() {
        return $this->porte;
    }

    public function getRaca() {
        return $this->raca;
    }

    public function setAnimal_id($animal_id) {
        $this->animal_id = $animal_id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setIdade($idade) {
        $this->idade = $idade;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setDetalhes($detalhes) {
        $this->detalhes = $detalhes;
    }

    public function setCor($cor) {
        $this->cor = $cor;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setPorte($porte) {
        $this->porte = $porte;
    }

    public function setRaca($raca) {
        $this->raca = $raca;
    }

    public function getUsuario() {
        return $this->usuario;
    }
    
    public function getUsuario_id() {
        return $this->usuario->getUsuario_id();
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    public function setUsuario_id($usuario_id) {
        $this->usuario->setUsuario_id($usuario_id);
    }


        
}

