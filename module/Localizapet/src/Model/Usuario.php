<?php
namespace WebService\Model;

class Usuario
{
    /**
     *
     * @var int 
     */
    public $usuario_id;
    
    /**
     *
     * @var string 
     */
    public $login;
    
    /**
     *
     * @var string
     */
    public $senha;
    
//    public function __construct($usuario_id, $login, $senha){
    public function __construct(){
        $this->usuario_id = null;
        $this->login = null;
        $this->senha = null;
    }
            
    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }


}

