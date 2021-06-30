<?php
namespace ISM\models;
use \ISM\lib\AbstractModel;
class AdminModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "admin";
        $this->primaryKey = "id";
    }
    public function selectUserByLogin(string $email):array{
        $sql= "SELECT * FROM admin 
        WHERE email=?";
        $result=$this->selectBy($sql,[$email],true);
        return $result["count"]==0?[]:$result["data"];
    }
    public function loginExiste(string $email):bool{
        $sql= "SELECT * FROM admin WHERE email=:email";
        $result=$this->selectBy($sql,[':email'=>$email],true);
        return $result["count"]==0?false:true;
    }

    public function insert(array $user):bool{
        extract($user);
        $sql= "INSERT INTO admin 
        (email,password,nom,role)
        VALUES 
        (?,?,?,?)";
    
        $result=$this->persit($sql,[$email,$password,$nom_complet,$role]);
        
        return $result["count"]==0?false:true;
    }

    public function selectById(int $id):array{
    
        $sql= "SELECT * FROM admin WHERE id=?";
        $result=$this->selectBy($sql,[$id],true);
        return $result["data"];
    }



}