<?php
namespace ISM\models;
use \ISM\lib\AbstractModel;
class CourModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "cours";
        $this->primaryKey = "id_cour";
    }
    public function insert(array $user):bool{
        extract($user);
        $sql= /** @lang text */
            "INSERT INTO cours 
        (date_cours,classe_id_list,professeur_id,module_id,nombre_heure_module,heure_debut,heure_fin,semestre)
        VALUES 
        (?,?,?,?,?,?,?,?)";

        /** @var TYPE_NAME $date_cours */
        /** @var TYPE_NAME $classes */
        /** @var TYPE_NAME $prof_id */
        /** @var TYPE_NAME $id_module */
        /** @var TYPE_NAME $nombre_heure_module */
        /** @var TYPE_NAME $heureDebut */
        /** @var TYPE_NAME $heurFin */
        /** @var TYPE_NAME $semestre */
        $result=$this->persit($sql,[$date_cours,$classes,$prof_id,$id_module,$nombre_heure_module,$heureDebut,$heurFin,$semestre]);
        
        return @$result["count"]==0?false:true;
    }

    public function  setAbsenStatuts(array $data){
        extract ($data);
        $sql="UPDATE cours SET  absence_marquer = 1 , nombre_absent = ? WHERE id_cour = ? ";
        /** @var TYPE_NAME $id_cour */
        /** @var TYPE_NAME $nombre_absent */
        $result =$this->persit ($sql,[$nombre_absent,$id_cour],true);
        return @$result["count"]==0?false:true;
    }

    


}