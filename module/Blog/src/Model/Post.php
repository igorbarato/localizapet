<?php


namespace Blog\Model;

class Post {
    public $id;
    public $title;
    public $content;
    
    //Array -> Objeto
    public function exchangeArray(array $data){
        
        //"!empty($data['id'])) ? $data['id']" = Se o id não for nulo $data recebe o id
        //":null" senão data->id = null
        $this->id = (!empty($data['id'])) ? $data['id']: null;
        $this->title = (!empty($data['title'])) ? $data['title']: null;
        $this->content = (!empty($data['content'])) ? $data['content']: null;
    }
    
    //Objeto -> Array
    public function  getArrayCopy(){
        return[
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content
        ];
    }    
    
}

