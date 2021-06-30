<?php
namespace ISM\models;
use \ISM\lib\AbstractModel;
use ISM\lib\DataBase;

class EtudiantModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "etudiant";
        $this->primaryKey = "id";
    }

  /*  public function selectById(int $id):array{

        $sql="SELECT * FROM etudiant e,	classe c WHERE e.etudiant_id=c.id_classe  AND e.etudiant_id=?";
        $result=$this->selectBy($sql,[$id],true);
        return $result["data"];
    }
 */
   public function selectNombreId(){
       $sql = "SELECT * FROM etudiant ORDER BY ID DESC LIMIT 1";
        $result=$this->selectAll($sql);
       return $result["count"];
   }
   public function loginExiste(string $email):bool{
    $sql= "SELECT * FROM etudiant WHERE email=:email";
    $result=$this->selectBy($sql,[':email'=>$email],true);
    return $result["count"]==0?false:true;
}

public function insert(array $user):bool{
    extract($user);
    $sql= "INSERT INTO etudiant 
    (matricule,email,password,nom,prenom,dateNaiss,sexe,classe_id,level_classe,role,competence,parcours)
    VALUES 
    (?,?,?,?,?,?,?,?,?,?,?,?)";

    /** @var TYPE_NAME $matricule */
    /** @var TYPE_NAME $email */
    /** @var TYPE_NAME $password */
    /** @var TYPE_NAME $nom */
    /** @var TYPE_NAME $prenom */
    /** @var TYPE_NAME $dateNaiss */
    /** @var TYPE_NAME $sexe */
    /** @var TYPE_NAME $classe_id */
    /** @var TYPE_NAME $level_classe */
    /** @var TYPE_NAME $role */
    /** @var TYPE_NAME $competence */
    /** @var TYPE_NAME $parcours */
    $result =$this->persit($sql,[$matricule,$email,$password,$nom,$prenom,$dateNaiss,$sexe,$classe_id,$level_classe,$role,$competence,$parcours]);
    return $result["count"]==0?false:true;
}
public function set_absence_hour(int $id, int $value){

       $sql=" UPDATE etudiant SET nombre_absence = ? WHERE id = ?";
       $result=$this->persit($sql,[$value,$id]);
       //  $dat  = new DataBase();
      //  $result = $dat->executeUpdate ($sql,[$value,$id]);
       return $result["count"]==0?false:true;

}

    public function selectUserByLogin ( string $email ) : array
    {
        $sql    = "SELECT * FROM etudiant 
        WHERE email=?";
        $result = $this -> selectBy ( $sql , [ $email ] , true );
        return $result[ "count" ] == 0 ? []: $result[ "data" ];
    }


    public  function  updateE ( array $data , $pass = false) : int
    {
        extract ($data);

        if($pass){
            $sql = "UPDATE etudiant SET  password = ? WHERE id = ? ";
            /** @var TYPE_NAME $newPassword */
            /** @var TYPE_NAME $id */
            $result_pass = $this -> persit ( $sql ,[ $newPassword , $id] );
        }
        $sql = "UPDATE etudiant SET  email = ? ,competence=? , parcours=? WHERE id = ? ";

        /** @var TYPE_NAME $email */

        $result = $this -> persit ( $sql , [$email,$competence,$parcours,$id] );
        return ! (@$result[ "count" ] == 0);

    }


}
