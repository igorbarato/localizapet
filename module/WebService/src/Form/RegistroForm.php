<?php


namespace WebService\Form;


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
            'name' => 'data',
            'type' => 'datetime',
//            'required' => true,
            'options' => [
                'label'=> 'Data',
                'format'=> 'm/d/Y H:i'
            ],
//            'attributes' => [
//             'min' => '2010-01-01T00:00:00Z',
//             'max' => '2020-01-01T00:00:00Z',
//             'step' => '1', // minutes; default step interval is 1 min
//            ]
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
//            'required' => true,
            'options' => [
                'label'=> 'Tipo de Registro',
                'value_options' => [
                    0 => 'Encontrado',
                    1 => 'Desaparecido'
                ],
            ]
        ]);
        
        $this->add([
            'name' => 'status',
            'type' => 'select',
//            'required' => true,
            'options' => [
                'label'=> 'Status',
                'value_options' => [
                    0 => 'Pendente',
                    1 => 'Concluído'
                ],
            ]
        ]);

        $this->add([
            'name' => 'animal_id',
            'type' => 'number',
            'options' => [
                'label'=> 'Animal ID'
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