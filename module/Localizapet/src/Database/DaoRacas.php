<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/04/2017
 * Time: 22:32
 */

namespace Localizapet\Database;

use Localizapet\Database\Database;
use Localizapet\Model\Raca;

class DaoRacas
{
    private $connection;

    private $result;

    /**
     * DaoRegistros constructor.
     * @param $connection
     */
    public function __construct()
    {
    }

    public function findAll()
    {
        $this->connection = new Database('racas');
        $stmt = $this->connection->db->query('SELECT * FROM racas;');
        $this->result = $stmt->fetch_all(MYSQLI_ASSOC);
        $this->connection->db->close();
        return $this->result;
    }

    public function find($id)
    {
        $this->connection = new Database('racas');
        $this->result = $this->connection->find($id);
        $this->connection->db->close();
        return $this->result;
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}