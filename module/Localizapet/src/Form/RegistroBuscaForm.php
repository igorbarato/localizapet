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
            'name' => 'sexo',
            'type' => 'select',
            'options' => [
                'label'=> 'Sexo',
                'value_options' => [
                    -1 => 'Qualquer',
                    0 => 'Fêmea',
                    1 => 'Macho'
                ],
            ]
        ]);

        $client = new \Zend\Soap\Client('http://localizapet.site/server?wsdl');
        $racas = $client->call('listaRacas');

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
                    -1 => 'Qualquer',
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
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value'=> 'Go',
                'id'=>'submitbutton'
            ]
        ]);

    }

}