<?php

namespace App\Infra\Principio;

use DB\DataBase;
use Exception;

class Geral
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function  setTable($table)
    {
        $this->db->setTable($table);
    }

    public function insertPadrao(array $array) : int
    {
        $idUrl = ($this->db)->insert($array);

        return $idUrl;
    }

    public function selectQueryCompleta(string $query, array $values)
    {
        return $this->db->selectQueryCompleta($query, $values);
    }

}