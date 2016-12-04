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
            'name' => 'idade',
            'type' => 'select',
            'options' => [
                'label'=> 'Idade',
                'value_options' => [
                    0 => 'Filhote',
                    1 => 'Adulto'
                ],
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
            'name' => 'cor',
            'type' => 'text',
            'options' => [
                'label'=> 'Cor'
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
            'name' => 'porte',
            'type' => 'select',
            'options' => [
                'label'=> 'Porte',
                'value_options' => [
                    0 => 'Pequeno',
                    1 => 'Médio',
                    2 => 'Grande'
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'raca',
            'type' => 'select',
            'options' => [
                'label'=> 'Raça',
                'value_options' => [
                    0 => 'Labrador',
                    1 => 'Poodle',
                    2 => 'Vira-lata'
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'especie',
            'type' => 'select',
            'options' => [
                'label'=> 'Espécie',
                'value_options' => [
                    0 => 'Cachorro',
                    1 => 'Gato'
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