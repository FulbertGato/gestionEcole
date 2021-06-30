<?php

namespace ISM\models;

use \ISM\lib\AbstractModel;

class AssistantModel extends AbstractModel
{

    public function __construct ()
    {
        parent ::__construct ();
        $this -> tableName = "assistant";
        $this -> primaryKey = "id_assistant";
    }

    public function selectNombreId ()
    {
        $sql = /** @lang text */
            "SELECT * FROM assistant  ORDER BY ID DESC LIMIT 1";
        $result = $this -> selectAll ( $sql );
        return $result[ "count" ];
    }

    public function loginExiste ( string $email ) : bool
    {
        $sql = /** @lang text */
            "SELECT * FROM assistant WHERE email=:email";
        $result = $this -> selectBy ( $sql , [ ':email' => $email ] , true );
        return $result[ "count" ] == 0 ? false : true;
    }

    public function selectUserByLogin ( string $email ) : array
    {
        $sql = /** @lang text */
            "SELECT * FROM assistant 
        WHERE email=?";
        $result = $this -> selectBy ( $sql , [ $email ] , true );
        return $result[ "count" ] == 0 ? [] : $result[ "data" ];
    }

    public function insert ( array $user ) : bool
    {
        extract ( $user );
        $sql = /** @lang text */
            "INSERT INTO assistant 
        (matricule_assistant,email,password,nom,prenom,paysOrigine,numeroTelephone,role)
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
        $result = $this -> persit ( $sql , [ $matricule , $email , $password , $nom , $prenom , $paysOrigine , $telephone , $role ] );

        return $result[ "count" ] == 0 ? false : true;
    }

    public function update ( array $data ) : int
    {

        extract ($data);

        $sql="UPDATE `assistant` SET `email` = ?, `nom` = ?, `prenom` = ?, `paysOrigine` = ? , `numeroTelephone` = ? ,`avatar` = ? WHERE id_assistant = ?";
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
        $sql = "DELETE FROM assistant WHERE id_assistant = ? ";
        $result = $this -> persit ( $sql , [$id]);
        return ! (@$result[ "count" ] == 0);

    }


}