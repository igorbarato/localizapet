<?php
namespace WebService\Dao;

use WebService\Model\Raca;
use WebService\Model\Animal;

class Dao
{
//    private $servername = 'mysql.hostinger.com.br';
//    private $username = 'u368622186_root';
//    private $password = 'o0iDe+KyC^$`fB[ZLh';
//    private $database = 'u368622186_pet';
    
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'localizapet_zend';
    
    private $charset = 'utf8';
    public $conexao;
    
    public $table;
    public $where;
    public $order;
    
    public function __construct(){
//        $this->conexao = $conexao;
    }
    
    public function start(){
        //Parametrização da conexão
        $this->conexao = new \mysqli(
            $this->servername, 
            $this->username, 
            $this->password,
            $this->database
        );
        //Setando UTF8 para que não haja problemas com acentuações
        $this->conexao->set_charset($this->charset);
        //Inicia conexão com DAO
        if ($this->conexao->connect_error) {
            die("Connection failed: " . $this->conexao->connect_error);
        }
        return "Connected successfully";
    }
    
    /**
     * 
     * @param \Blog\Model\Raca $raca
     */
    public function insertRaca($raca){
        $this->start();
        
        $stm = $this->conexao->prepare("INSERT INTO raca (nome, especie_id) VALUES (?, ?)");
        $stm->bind_param('si', $nome, $especie_id);
        $nome = $raca->nome;
        $especie_id = $raca->especie_id;
        
        $stm->execute();
        $stm->close();
        $this->close();
    }

    public function insert_Animal(Animal $animal){
        $this->start();
        
        $stm = $this->conexao->prepare("INSERT INTO animal(nome, idade, sexo, detalhes, usuario_id, foto, raca_id, especie_id, cor, porte) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stm->bind_param('siisibiisi', $nome, $idade, $sexo, $detalhes, $usuario_id,
                $foto, $raca_id, $especie_id, $cor, $porte);
        $nome = $animal->getNome(); 
        $idade = $animal->getIdade();
        $sexo = $animal->getSexo();
        $detalhes = $animal->getDetalhes();
        $usuario_id = $animal->usuario->getUsuario_id();

        $raca_id = $animal->getRaca_id();
        $especie_id = $animal->getEspecie_id();
        $cor = $animal->getCor();
        $porte = $animal->getPorte();
        var_dump($animal);

        $stm->execute();
        
        printf("%d Row inserted.\n", $stm->affected_rows);
        
        $stm->close();
        $this->close();

    }

        public function close(){
        $this->conexao->close();
    }
    
    public function query($query){
        $this->start();
//         $this->where = (!empty($where)) ? $where: null;
//         $this->order = (!empty($order)) ? $order: null;
//        $stm = $this->conexao->prepare($query);
//        $stm->bind_param();
        $result = mysqli_query($this->conexao, $query);
        
        $rows = [];
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        
        $this->close();
//        \Zend\Debug\Debug::dump($rows);
        return $rows;
    }
    
    public function login($login, $senha){
        $this->start();
        
        $query = 'SELECT * FROM usuario WHERE login = \'' . $login . '\' '
            .'AND senha = \''.$senha.'\';';
        
        $result = mysqli_query($this->conexao, $query);
        
        $row = mysqli_fetch_array($result);
//        var_dump($row);
        $this->close();
        //Se achou o login retorna true
//        if($row != null) 
            return $row['usuario_id'];
        //Senão false
//        return false;
    }
    
    function getConexao() {
        return $this->conexao;
    }

    function setConexao($conexao) {
        $this->conexao = $conexao;
    }


}

