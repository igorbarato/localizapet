<?php

namespace WebService\Soap;

use WebService\Database\Database;


    
    /**
     * @param string $login
     * @param string $senha
     * @return array
     */
     function login($login, $senha){
        $db = new Database();
        $db->start();
        
        $query = 'SELECT * FROM usuario WHERE login = \'' . $login . '\' '
            .'AND senha = \''.$senha.'\';';
        
        $result = mysqli_query($db->conexao, $query);
        
        $row = mysqli_fetch_array($result);
        $db->close();
            return $row['usuario_id'];
    }
    
    /**
     * 
     * @return array
     */
    public function lista_animais(){
        $db = new Dao();
        return $db->query('SELECT * FROM animal;');
    }
    
    /**
     * 
     * @return array
     */
    public function lista_registros(){
        $db = new Dao();
        return $db->query('SELECT * FROM registro;');
    }

        /** @param WebService\Model\Animal $animal */
    public function cadastrar_animal($animal){
        $db = new Dao();
        $db->start();
        
        $stm = $db->conexao->prepare("INSERT INTO animal(nome, idade, sexo, detalhes, usuario_id, foto, raca_id, especie_id, cor, porte) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stm->bind_param('siisibiisi', $nome, $idade, $sexo, $detalhes, $usuario_id,
                $foto, $raca_id, $especie_id, $cor, $porte);
        $nome = $animal->nome; 
        $idade = $animal->idade;
        $sexo = $animal->sexo;
        $detalhes = $animal->detalhes;
        $usuario_id = $animal->usuario_id;
        $foto = '/9j/4AAQSkZJRgABAQAAAQABAADQ==';
//        $foto = $animal->foto;
        $raca_id = $animal->raca_id;
        $especie_id = $animal->especie_id;
        $cor = $animal->cor;
        $porte = $animal->porte;

        $stm->execute();        
        $stm->close();
        $db->close();
    }

    /** @param WebService\Model\Raca $raca */
    public function cadastrar_raca($raca){
        $db = new Database();
        $db->start();
        
        $stm = $db->conexao->prepare("INSERT INTO raca (nome, especie_id) VALUES (?, ?)");
        $stm->bind_param('si', $nome, $especie_id);
        $nome = $raca->nome;
        $especie_id = $raca->especie_id;
        
        $stm->execute();
        $stm->close();
        $db->close();
    }
    /** @param WebService\Model\Registro $registro */
    public function inserir_registro($registro){
        $db = new Database();
        $db->start();
        
        $stm = $db->conexao->prepare("INSERT INTO registro "
                . "(data, latitude, longitude, tipo_registro, status, animal_id, usuario_id) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stm->bind_param(
                'iddiiii',
                $data, $latitude, $longitude, $tipo_registro, $status, $animal_id, $usuario_id);
        $data = $registro->data;
        $latitude = $registro->latitude;
        $longitude = $registro->longitude;
        $tipo_registro = $registro->tipo_registro;
        $status = $registro->status;
        $animal_id = $registro->animal_id;
        $usuario_id = $registro->usuario_id;
        $stm->execute();
        $stm->close();
        $db->close();
    }
    
    /**
     * 
     * @return string
     */
    public function olaMundo(){
        return 'Olá mundo';
    }

