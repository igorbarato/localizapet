<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/04/2017
 * Time: 22:32
 */

namespace WebService\Dao;


class DaoAnimal
{

    public function paginate()
    {
        $dao = new Dao();
        $temp =  $dao->query('SELECT * FROM animais');
//        \Zend\Debug\Debug::dump($temp);
        return $temp;
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function save($entity)
    {
        // TODO: Implement save() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}