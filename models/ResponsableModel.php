<?php
namespace ISM\models;
use \ISM\lib\AbstractModel;
class ResponsableModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "responsable";
        $this->primaryKey = "id_responsable";
    }
    public function selectNombreId(){
        $sql = "SELECT * FROM responsable ORDER BY ID DESC LIMIT 1";
         $result=$this->selectAll($sql);
        return $result["count"];
    }
    public function loginExiste(string $email):bool{
        $sql= /** @lang text */
            "SELECT * FROM responsable WHERE email=:email";
        $result=$this->selectBy($sql,[':email'=>$email],true);
        return $result["count"]==0?false:true;
    }

    public function selectUserByLogin(string $email):array{
        $sql= /** @lang text */
            "SELECT * FROM responsable 
        WHERE email=?";
        $result=$this->selectBy($sql,[$email],true);
        return $result["count"]==0?[]:$result["data"];
    }

    public function insert(array $user):bool{
        extract($user);
        $sql=
            /** @lang text */
            "INSERT INTO responsable 
        (matricule_responsable,email,password,nom,prenom,paysOrigine,numeroTelephone,role)
        VALUES 
        (?,?,?,?,?,?,?,?)";

        /** @var TYPE_NAME $matricule */
        /** @var TYPE_NAME $password */
        /** @var TYPE_NAME $email */
        /** @var TYPE_NAME $nom */
        /** @var TYPE_NAME $prenom */
        /** @var TYPE_NAME $paysOrigine */
        /** @var TYPE_NAME $telephone */
        /** @var TYPE_NAME $role */
        $result=$this->persit($sql, [$matricule,
            $email,
            $password,
            $nom,
            $prenom,
            $paysOrigine,
            $telephone,
            $role]);
        
        return ! ($result[ "count" ] == 0);
    }

    public function update ( array $data ) : int
    {

        extract ($data);

        $sql="UPDATE `responsable` SET `email` = ?, `nom` = ?, `prenom` = ?, `paysOrigine` = ? , `numeroTelephone` = ? ,`avatar` = ? WHERE id_responsable = ?";
        /** @var TYPE_NAME $email */
        /** @var TYPE_NAME $nom */
        /** @var TYPE_NAME $prenom */
        /** @var TYPE_NAME $paysOrigine */
        /** @var TYPE_NAME $numeroTelephone */
        /** @var TYPE_NAME $id */
        /** @var TYPE_NAME $avatar */
        @$result = $this -> persit ( $sql , [$email,$nom,$prenom,$paysOrigine,$numeroTelephone,$avatar,$id]);
        return ! (@$result[ "count" ] == 0);

    }

    public function  remove ( int $id ) : int
    {
        $sql = "DELETE FROM responsable WHERE id_responsable = ? ";
        $result = $this -> persit ( $sql , [$id]);
        return ! (@$result[ "count" ] == 0);

    }
}