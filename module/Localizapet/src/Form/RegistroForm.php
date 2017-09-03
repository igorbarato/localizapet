<?php


namespace Localizapet\Form;


use Localizapet\Database\DaoRacas;
use Zend\Form\Form;

class RegistroForm extends Form
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
            'required' => false,
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
            'type' => 'file',
            'options' => [
                'label'=> 'Foto'
            ]
        ]);

        $client = new \Zend\Soap\Client('http://localizapet.site/server?wsdl');
        $racas = $client->call('listaRacas');
//        \Zend\Debug\Debug::dump($racas);

        foreach($racas as $raca){
            if($raca->especie == 0) $selectRacasCachorro[$raca->id]= $raca->raca;
            else $selectRacasGato[$raca->id]= $raca->raca;
        }

        $this->add([
            'name' => 'raca',
            'type' => 'select',
            'required' => true,
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
            'required' => true,
            'options' => [
                'label'=> 'Data',
                'format'=> 'd/m/Y'
            ],
        ]);

        $this->add([
            'name' => 'endereco',
            'type' => 'text',
            'required' => true,
            'options' => [
                'label'=> 'Endereço'
            ],
        ]);
        
        $this->add([
            'name' => 'latitude',
            'type' => 'text',
            'required' => true,
            'options' => [
                'label'=> 'Latitude'
            ],
        ]);
        
        $this->add([
            'name' => 'longitude',
            'type' => 'text',
            'required' => true,
            'options' => [
                'label'=> 'Longitude'
            ],
        ]);
        
        $this->add([
            'name' => 'tipo_registro',
            'type' => 'select',
            'required' => true,
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
            'required' => true,
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