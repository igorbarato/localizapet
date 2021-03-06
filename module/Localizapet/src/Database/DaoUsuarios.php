<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/04/2017
 * Time: 22:32
 */

namespace Localizapet\Database;

use Localizapet\Database\Database;
use Localizapet\Model\UsuarioModel;

class DaoUsuarios
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

    function login($login, $senha){
        $this->connection = new Database('usuarios');

        $stmt = $this->connection->db->query('SELECT * FROM usuarios WHERE login = \'' . $login . '\' '
            .'AND senha = \''.$senha.'\';');

        $this->result = $stmt->fetch_array(MYSQLI_ASSOC);
        $this->connection->db->close();
        return $this->result['id'];
    }

    public function findAll()
    {
        $this->connection = new Database('usuarios');
        $stmt = $this->connection->db->query('SELECT * FROM `usuarios`');
        $this->result = $stmt->fetch_all(MYSQLI_ASSOC);
        $this->connection->db->close();
        return $this->result;
    }

    public function find($id)
    {
        $this->connection = new Database('usuarios');
        $this->result = $this->connection->find($id);
        $this->connection->db->close();
        return $this->result;
    }

    public function findPerParameter($buscas)
    {
        $this->connection = new Database('registros');
        $sql = "SELECT r.id, r.data, r.endereco, r.latitude, r.longitude, r.tipo_registro,
            r.status, r.nome, r.sexo, r.detalhes, r.foto,  racas.especie, racas.raca, usuarios.login
            FROM registros AS r, racas, usuarios
            WHERE r.raca_id = racas.id
            AND r.usuario_id = usuarios.id ";
        foreach($buscas as $key => $busca){
            $sql = $sql . "AND ".  $busca['operando'] . $busca['operador'] . $busca['valor'];
        }
        \Zend\Debug\Debug::dump($sql);
        $stmt = $this->connection->db->query($sql);
        $this->result = $stmt->fetch_all(MYSQLI_ASSOC);
        $this->connection->db->close();
        return $this->result;
    }

    public function save(UsuarioModel $usuario)
    {
//        if (!empty($usuario->getUsuario_id())) {
//            return $this->update($usuario);
//        }
        $this->connection = new Database('usuarios');
        $sql = "INSERT INTO `usuarios` (`login`, `senha`, `telefone`)
          VALUES
          ( ?, ?, ?)";
        if($stmt = $this->connection->db->prepare($sql)){
            $stmt->bind_param('sss',
                $usuario->getLogin(),
                $usuario->getSenha(),
                $usuario->getTelefone()
            );
            $stmt->execute();

            if($stmt->affected_rows != -1 ) $this->result = true;
            else $this->result = false;

            $stmt->close();

        }else{
            echo $this->connection->getDb()->error;
        }
        $this->connection->db->close();
        return $this->result;
    }

    public function update(Registro $registro)
    {
//        if (isset($animal->id)) {
//            return $this->update($animal);
//        }
        $this->connection = new Database('registros');
        $sql = "
            UPDATE registros
            SET
                `data` = FROM_UNIXTIME(?),
                `endereco` = ?,
                `latitude` = ?,
                `longitude` = ?,
                `tipo_registro` = ?,
                `status` = ?,
                `nome` = ?,
                `sexo` = ?,
                `detalhes` = ?,
                `foto` = ?,
                `raca_id` = ?,
                `usuario_id` = ?
            WHERE
                id = ?
        ";
//        $valida_data = "null";
        if($stmt = $this->connection->db->prepare($sql)){
            $stmt->bind_param('ssddiisisbiii',
                $registro->getData(),
                $registro->getEndereco(),
                $registro->getLatitude(),
                $registro->getLongitude(),
                $registro->getTipoRegistro(),
                $registro->getStatus(),
                $registro->getNome(),
                $registro->getSexo(),
                $registro->getDetalhes(),
                $registro->getFoto(),
                $registro->getRacaId(),
                $registro->getUsuarioId(),
                $registro->getId()
            );
            $stmt->execute();

            printf("%d Row updated.\n", $stmt->affected_rows);

            $stmt->close();
        }else{
            echo $this->connection->db->error;
        }
        $this->connection->db->close();
        return $this->result;

    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}