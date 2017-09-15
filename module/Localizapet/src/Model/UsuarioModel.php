<?php
namespace Localizapet\Model;

/**
 * UsuarioModel
 */
class UsuarioModel
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

    /**
     *
     * @var string
     */
    public $telefone;
    
    public function __construct($usuario=null, $login=null, $senha=null, $telefone=null){
        $this->usuario_id = $usuario;
        $this->login = $login;
        $this->senha = $senha;
        $this->telefone = $telefone;
    }
            
    function getUsuario_id() {
        return $this->usuario_id;
    }

    public function getLogin() {
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

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

}

