<?php
namespace ISM\models;
use \ISM\lib\AbstractModel;
class ClasseModel extends AbstractModel{



    public function __construct() {
        parent::__construct();
        $this->tableName = "classe";
        $this->primaryKey = "id_classe";
    }

    public function insert(array $user):bool{
        extract($user);
        $sql= "-- noinspection SqlDialectInspection

INSERT INTO classe
        (libelle,filiere_libelle,nombre_etudiant)
        VALUES 
        (?,?,?)";

        /** @var TYPE_NAME $libelle */
        /** @var TYPE_NAME $filiere */
        /** @var TYPE_NAME $nombre_etudiant */
        $result=$this->persit($sql,[$libelle,$filiere,$nombre_etudiant]);

        return !(@$result["count"] == 0);
    }


}