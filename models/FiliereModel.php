<?php


namespace ISM\models;


class FiliereModel extends \ISM\lib\AbstractModel
{


    public function __construct() {
        parent::__construct();
        $this->tableName = "filiere";
        $this->primaryKey = "id";
    }
    public function insert(array $data):bool{

        extract($data);
        $sql= /** @lang text */
            "INSERT INTO filiere
        (libelle,liste_niveaux)
        VALUES 
        (?,?)";


        /** @var TYPE_NAME $name */
        /** @var TYPE_NAME $niveaux */
        $result =$this->persit($sql,[$name,$niveaux]);

        return @$result["count"]==0?false:true;

    }
    public function filiereExiste(string $value):bool{
        $sql= /** @lang text */
            "SELECT * FROM filiere WHERE libelle=:value";
        /** @var TYPE_NAME $name */
        $result =$this->selectBy($sql,[':value'=>$name],true);
        return ! ($result[ "count" ] == 0);
    }

}