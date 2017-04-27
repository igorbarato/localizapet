<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/04/2017
 * Time: 22:29
 */

namespace WebService\Dao;


interface Entity
{
    public function paginate();

    public function get($id);

    public function save($entity);

    public function delete($id);
}