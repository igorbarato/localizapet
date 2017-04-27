<?php

namespace WebService\Model;

use WebService\Model\Animal;
use WebService\Model\Usuario;

class Registro {
    
    /** @var int */
    public $regitro_id;
    
    /** @var string */
    public $data;
    
    /** @var double */
    public $latitude;
    
    /** @var double */
    public $longitude;
    
    /** @var int */
    public $tipo_registro;
    
    /** @var int */
    public $status;
    
    /** @var int */
    public $animal_id;
    
    /** @var int */
    public $usuario_id;
    
    function __construct($regitro_id, $data, $latitude, $longitude, 
            $tipo_registro, $status, $animal_id, $usuario_id) {
        $this->regitro_id = $regitro_id;
        $this->data = $data;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->tipo_registro = $tipo_registro;
        $this->status = $status;
        $this->animal_id = $animal_id;
        $this->usuario_id = $usuario_id;
    }
    
    function getRegitro_id() {
        return $this->regitro_id;
    }

    function getData() {
        return $this->data;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function getTipo_registro() {
        return $this->tipo_registro;
    }

    function getStatus() {
        return $this->status;
    }

    function getAnimal() {
        return $this->animal;
    }

    function setRegitro_id($regitro_id) {
        $this->regitro_id = $regitro_id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    function setTipo_registro($tipo_registro) {
        $this->tipo_registro = $tipo_registro;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setAnimal($animal) {
        $this->animal = $animal;
    }
    
    
}
