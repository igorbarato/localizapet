<?php


namespace WebService\Form;


use Zend\Form\Form;

class AnimalForm extends Form
{

    public function __construct($name=null)
    {
        parent::__construct('animal');

        $this->add([
           'name' => 'id',
            'type' => 'hidden'
        ]);
        
        $this->add([
            'name' => 'nome',
            'type' => 'text',
            'required' => true,
            'options' => [
                'label'=> 'Nome'
            ]
        ]);
        
        $this->add([
            'name' => 'sexo',
            'type' => 'select',
            'required' => true,
            'options' => [
                'label'=> 'Sexo',
                'value_options' => [
                    0 => 'Fêmea',
                    1 => 'Macho'
                ],
            ]
        ]);

        $this->add([
            'name' => 'detalhes',
            'type' => 'textarea',
            'options' => [
                'label'=> 'Detalhes'
            ]
        ]);

        $this->add([
            'name' => 'foto',
            'type' => 'text',
            'options' => [
                'label'=> 'Foto'
            ]
        ]);

        
        $this->add([
            'name' => 'raca',
            'type' => 'select',
            'options' => [
                'label'=> 'Raça',
                'value_options' => [
                    1 => 'Vira-lata'
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'especie',
            'type' => 'select',
            'options' => [
                'label'=> 'Espécie',
                'value_options' => [
                    1 => 'Gato',
                    2 => 'Cachorro'
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value'=> 'Go',
                'id'=>'submitbutton'
            ]
        ]);

    }

}