<?php


namespace Blog\Soap;

class Client{
    
    /**
     * 
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * 
     * @return string
     */
    public function OlaMundo(){
        return "Olá mundo";
    } 
    
    
    /**
     * 
     * @param int $num1
     * @param int $num2
     * @return int
     */
    public function soma($num1, $num2){
        return $num1 + $num2;
    }
    
}

