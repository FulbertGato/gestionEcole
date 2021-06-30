<?php
namespace ISM\models;
use \ISM\lib\AbstractModel;
class ModuleModel extends AbstractModel{


    public function __construct() {
        parent::__construct();
        $this->tableName = "module";
        $this->primaryKey = "id_module";
    }
    

    public function moduleExiste(string $libelle):bool{
        $sql= "SELECT * FROM module WHERE libelle=:libelle";
        $result=$this->selectBy($sql,[':libelle'=>$libelle],true);
        return $result["count"]==0?false:true;
    }

    public function selectModuleByLibelle(string $libelle):array{
        $sql= "SELECT * FROM module 
        WHERE libelle=?";
        $result=$this->selectBy($sql,[$libelle],true);
        return $result["count"]==0?[]:$result["data"];
    }
    public function insert(array $module):bool{

        extract($module);
        $sql= "INSERT INTO module
        (libelle)
        VALUES 
        (?)";
    
        $result=$this->persit($sql,[$libelle]);
        
        return $result["count"]==0?false:true;
    }

    public function libelleExiste(string $libelle):bool{
        $sql= "SELECT * FROM module WHERE libelle=:libelle";
        $result=$this->selectBy($sql,[':libelle'=>$libelle],true);
        return $result["count"]==0?false:true;
    }


}