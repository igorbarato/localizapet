<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 27/04/2017
 * Time: 02:04
 */

namespace Localizapet\Model;


class Teste
{
    public $id;
    public $image;

    /**
     * Teste constructor.
     * @param $id
     * @param $image
     */
    public function __construct()
    {
    }


    /**
     * @return array|string
     */
    public function listar(){
//        $servername = 'localhost';
//         $username = 'root';
//         $password = '';
//         $database = 'localizapet_zend';
         $charset = 'utf8';

        $servername = 'mysql.hostinger.com.br';
        $username = 'u368622186_root';
        $password = 'o0iDe+KyC^$`fB[ZLh';
        $database = 'u368622186_pet';

        $conexao = new \mysqli(
            $servername,
            $username,
            $password,
            $database
        );
        //Setando UTF8 para que não haja problemas com acentuações
        $conexao->set_charset($charset);
        //Inicia conexão com DAO
        if ($conexao->connect_error) {
//            die("Connection failed: " . $conexao->connect_error);
        }
//        return "Connected successfully";

        $query = 'SELECT * FROM temp;';

        $result = mysqli_query($conexao, $query);

        $rows = [];
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($rows, $row);
        }

        $conexao->close();
        return $rows;
    }
}