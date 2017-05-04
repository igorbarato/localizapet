<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/04/2017
 * Time: 22:32
 */

namespace Localizapet\Database;

use Localizapet\Database\Database;
use Localizapet\Model\Animal;

class DaoAnimal
{
    private $connection;

    /**
     * DaoAnimal constructor.
     * @param $connection
     */
    public function __construct()
    {
        $this->connection = new Database('animais');
    }

    public function findAll()
    {
        $stmt = $this->connection->getDb()->query('SELECT * FROM animais;');
        $result = $stmt->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function find($id)
    {
        return $this->connection->find($id);
    }

    public function findBySexo($sexo)
    {
        $query = 'SELECT * FROM animais WHERE sexo = ?';
        $stmt = $this->connection->getDb()->prepare($query);
        $stmt->bind_param('s', $sexo);
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = [];
        while($row = $result->fetch_assoc()){
            array_push($rows, $row);

        }
        return $rows;
    }

    public function save(Animal $animal)
    {
//        if (isset($animal->id)) {
//            return $this->update($animal);
//        }
        $sql = '
            INSERT INTO animais
                (nome, sexo, detalhes, usuario_id, raca_id, especie_id)
            VALUES
                (?, ?, ?, ?, ?, ?)
        ';
        if($stmt = $this->connection->getDb()->prepare($sql)){
            $stmt->bind_param('sisiii',
                $animal->getNome(),
                $animal->getSexo(),
                $animal->getDetalhes(),
                $animal->getUsuarioId(),
                $animal->getRacaId(),
                $animal->getEspecieId()
            );
            $stmt->execute();

            printf("%d Row inserted.\n", $stmt->affected_rows);

            $stmt->close();
        }else{
            echo $this->connection->getDb()->error;
        }

    }

    public function update(Animal $animal)
    {
//        if (isset($animal->id)) {
//            return $this->update($animal);
//        }
        $sql = '
            UPDATE animais
            SET
                nome = ?,
                 sexo = ?,
                 detalhes = ?,
                 usuario_id = ?,
                 raca_id = ?,
                 especie_id = ?
            WHERE
                id = ?
        ';
        if($stmt = $this->connection->getDb()->prepare($sql)){
            $stmt->bind_param('sisiiii',
                $animal->getNome(),
                $animal->getSexo(),
                $animal->getDetalhes(),
                $animal->getUsuarioId(),
                $animal->getRacaId(),
                $animal->getEspecieId(),
                $animal->getAnimalId()
            );
            $stmt->execute();

            printf("%d Row updated.\n", $stmt->affected_rows);

            $stmt->close();
        }else{
            echo $this->connection->getDb()->error;
        }

    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}