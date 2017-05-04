<?php
namespace Localizapet\Database;

use mysqli;
use Zend\Stdlib\ArrayUtils;

class Database
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

    public $db;

    public $table;

    /**
     * @return mysqli
     */
    public function getDb()
    {
        return $this->db;
    }
    /**
     * @param mysqli $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }
    
    public function __construct($table){
        //Parametrização da conexão
        $this->db = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->database
        );
        //Setando UTF8 para que não haja problemas com acentuações
        $this->db->set_charset($this->charset);

        $this->table = $table;

        //Inicia conexão com Database
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
    
    public function query($query){
        
        $result = $this->db->query($query);
        
        $rows = [];
        while($row = $result->fetch_assoc()){
            array_push($rows, $row);

        }
        $this->db->close();
        return $rows;
    }

    public function find($id)
    {

        $sql = "SELECT * FROM $this->table WHERE id = ?";
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param('s', $id);
            $stmt->execute();

            $result = $stmt->get_result();
            $rows = [];
            while($row = $result->fetch_assoc()){
                array_push($rows, $row);

            }
            return $rows;

        }else {
            echo $this->db->error;
        }

    }


}

