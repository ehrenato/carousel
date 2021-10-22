<?php

namespace Models;

use Core\Model;

class Permissions extends Model
{
    public function list_permission()
    {
        try {
           $sql="SELECT * FROM permissoes";
           $sql=$this->db->query($sql);
           if($sql->rowCount() > 0){
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
           }
        } catch (\PDOException $error) {
            echo "ERROR LIST PERMISSION:".$error->getMessage();
            exit;
        }
    }
}