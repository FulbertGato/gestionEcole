<?php


namespace ISM\models;



class AbsenceModel extends \ISM\lib\AbstractModel
{
    public function __construct() {
        parent::__construct();
        $this->tableName = "absence";
        $this->primaryKey = "id_bansence";
    }



    public function insert(array $data):bool{
        extract($data);
        $sql= "INSERT INTO absence
    (date_absence,cour_id,list_etudiant_id)
    VALUES 
    (?,?,?)";
        $result =$this->persit($sql,[$date_absence,$id_cour,$id_etu]);
        return $result["count"]==0?false:true;
    }

}