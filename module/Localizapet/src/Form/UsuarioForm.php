<?php


namespace Localizapet\Form;


use Zend\Form\Form;

class UsuarioForm extends Form
{

    public function __construct($name=null)
    {
        parent::__construct('usuario');

        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'login',
            'type' => 'text',
            'required' => true,
            'options' => [
                'label' => 'Usuário'
            ],
            'validator' => ['noempty']
        ]);
        
        $this->add([
            'name' => 'senha',
            'type' => 'password',
            'required' => true,
            'options' => [
                'label' => 'Senha'
            ],
            'validator' => ['noempty']
        ]);

        $this->add([
            'name' => 'telefone',
            'type' => 'text',
            'required' => true,
            'options' => [
                'label' => 'Telefone'
            ],
            'validator' => ['noempty']
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