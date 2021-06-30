<?php

namespace ISM\models;

use \ISM\lib\AbstractModel;

class ProfModel extends AbstractModel
{


    public
    function __construct ()
    {
        parent ::__construct ();
        $this -> tableName  = "professeur";
        $this -> primaryKey = "id";
    }

    public
    function selectNombreId ()
    {
        $sql    = "SELECT * FROM professeur ORDER BY ID DESC LIMIT 1";
        $result = $this -> selectAll ( $sql );
        return $result[ "count" ];
    }

    public
    function loginExiste (
        string $email
    ) : bool
    {
        $sql    = "SELECT * FROM professeur WHERE email=:email";
        $result = $this -> selectBy ( $sql , [ ':email' => $email ] , true );
        return ! ($result[ "count" ] == 0);
    }

    public
    function selectUserByLogin (
        string $email
    ) : array
    {
        $sql    = "SELECT * FROM professeur 
        WHERE email=?";
        $result = $this -> selectBy ( $sql , [ $email ] , true );
        return $result[ "count" ] == 0 ? []: $result[ "data" ];
    }

    public
    function insert (
        array $user
    ) : bool
    {
        extract ( $user );
        $sql = /** @lang text */
            "INSERT INTO professeur 
        (matricule_professeur,nom,prenom,email,numero,password,grade,sexe,dateNaiss,module,role)
        VALUES 
        (?,?,?,?,?,?,?,?,?,?,?)";

        /** @var TYPE_NAME $matricule */
        /** @var TYPE_NAME $nom */
        /** @var TYPE_NAME $prenom */
        /** @var TYPE_NAME $email */
        /** @var TYPE_NAME $telephone */
        /** @var TYPE_NAME $password */
        /** @var TYPE_NAME $grade */
        /** @var TYPE_NAME $sexe */
        /** @var TYPE_NAME $dateNaiss */
        /** @var TYPE_NAME $module */
        /** @var TYPE_NAME $role */
        $result = $this -> persit ( $sql , [ $matricule ,
            $nom ,
            $prenom ,
            $email ,
            $telephone ,
            $password ,
            $grade ,
            $sexe ,
            $dateNaiss ,
            $module ,
            $role ] );

        return ! ($result[ "count" ] == 0);
    }

    public
    function updateProfCourse (
        array $data , int $id
    ) : int
    {

        //extract($data);
        $sql    = "UPDATE professeur SET liste_cours = ? WHERE id = $id";
        $result = $this -> persit ( $sql , $data );
        return ! (@$result[ "count" ] == 0);
    }

    public  function  updateP ( array $data , $pass = false) : int
    {
        extract ($data);

        if($pass){
            $sql = "UPDATE professeur SET  password = ? WHERE id = ? ";
            /** @var TYPE_NAME $newPassword */
            /** @var TYPE_NAME $id */
            $result_pass = $this -> persit ( $sql ,[ $newPassword , $id] );
        }
        $sql = "UPDATE professeur SET  email = ? , numero = ? WHERE id = ? ";

        /** @var TYPE_NAME $email */
        /** @var TYPE_NAME $numero */
        $result = $this -> persit ( $sql , [$email,$numero,$id] );
        return ! (@$result[ "count" ] == 0);

    }


}