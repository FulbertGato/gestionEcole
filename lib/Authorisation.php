<?php
namespace ISM\lib;

class Authorisation{
    public static function estConnect():bool{
        return isset($_SESSION["user_connect"]);
    }
    public static function estAdmin():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "admin";
    }
    public static function estProf():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "professeur";
    }
    public static function estEtudiant():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "etudiant";
    }

    public static function estAssistant():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "assistant";
    }
    public static function estResponsable():bool{
        return self::estConnect() && $_SESSION["user_connect"]["role"] == "responsable";
    }
}