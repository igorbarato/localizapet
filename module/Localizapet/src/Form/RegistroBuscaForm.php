<?php


namespace Localizapet\Form;


use Localizapet\Database\DaoRacas;
use Zend\Form\Form;

class RegistroBuscaForm extends Form
{

    public function __construct($name=null)
    {
        parent::__construct('registro');

        $this->add([
           'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'nome',
            'type' => 'text',
            'options' => [
                'label'=> 'Nome'
            ]
        ]);

        $this->add([
            'name' => 'sexo',
            'type' => 'select',
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

        $clientRaca = new DaoRacas();
        $racas = $clientRaca->findAll();
        foreach($racas as $raca){
            if($raca['especie'] == 0) $selectRacasCachorro[$raca['id']]= $raca['raca'];
            else $selectRacasGato[$raca['id']]= $raca['raca'];
        }

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
            'name' => 'raca',
            'type' => 'select',
            'options' => [
                'label'=> 'Especie',
                'value_options' => [
                    'Cachorro' => [
                        'label' => 'Cachorro',
                        'options' => $selectRacasCachorro
                    ],
                    'Gato' => [
                        'label' => 'Gato',
                        'options' => $selectRacasGato
                    ]
                ]
            ]
        ]);


        $this->add([
            'name' => 'data',
            'type' => 'datetime',
            'options' => [
                'label'=> 'Data',
                'format'=> 'd/m/Y H:i'
            ],
//            'attributes' => [
//             'min' => '2010-01-01T00:00:00Z',
//             'max' => '2020-01-01T00:00:00Z',
//             'step' => '1', // minutes; default step interval is 1 min
//            ]
        ]);

        $this->add([
            'name' => 'endereco',
            'type' => 'text',
            'options' => [
                'label'=> 'Endereço'
            ],
        ]);
        
        $this->add([
            'name' => 'latitude',
            'type' => 'text',
            'options' => [
                'label'=> 'Latitude'
            ],
        ]);
        
        $this->add([
            'name' => 'longitude',
            'type' => 'text',
            'options' => [
                'label'=> 'Longitude'
            ],
        ]);
        
        $this->add([
            'name' => 'tipo_registro',
            'type' => 'select',
            'options' => [
                'label'=> 'O que aconteceu?',
                'value_options' => [
                    0 => 'Eu perdi meu animal',
                    1 => 'Eu encontrei um animal perdido'
                ],
            ]
        ]);
        
        $this->add([
            'name' => 'status',
            'type' => 'select',
            'options' => [
                'label'=> 'Status',
                'value_options' => [
                    0 => 'Pendente',
                    1 => 'Concluído'
                ],
            ]
        ]);
        
        $this->add([
            'name' => 'usuario_id',
            'type' => 'number',
            'options' => [
                'label'=> 'Usuário ID'
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