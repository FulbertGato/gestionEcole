<?php

namespace ISM\controllers;

use ISM\lib\AbstractController;
use ISM\models\AssistantModel;
use ISM\lib\Request;
use ISM\lib\Session;
use ISM\lib\Response;
use ISM\lib\Validator;
use ISM\lib\PasswordEncoder;


class AssistantController extends AbstractController
{

    private AssistantModel $model;

    public
    function __construct ()
    {
        parent ::__construct ();
        $this -> model = new AssistantModel();
    }

    public
    function showAllAssistant ()
    {
        $dataAssistant = $this -> model -> selectAll ();
        $this -> render ( "assistant/list.assistant" , [ "assistants" => $dataAssistant ] );
    }

    public
    function addAssistant (
        Request $request
    )
    {
        $modelAssistant = new AssistantModel();

        if ($request -> isPost ()) {
            $data = $request -> getBody ();
            $this -> validator -> estVide ( $data[ "paysOrigine" ] , "paysOrigine" );
            $this -> validator -> estVide ( $data[ "nom" ] , "nom" );
            $this -> validator -> estVide ( $data[ "prenom" ] , "prenom" );
            $this -> validator -> estVide ( $data[ "telephone" ] , "telephone" );
            // $this->validator->estVide($data["date"], "date");
            if (!$this -> validator -> estVide ( $data[ "email" ] , "email" )) {
                if ($this -> validator -> estMail ( $data[ "email" ] , "email" )) {
                    if ($modelAssistant -> loginExiste ( $data[ "email" ] )) {
                        $this -> validator -> setErrors ( "login" , "ce login existe deja dans le systeme" );
                    }
                }
            }
            if ($this -> validator -> formValide ()) {
                $data[ "matricule" ] = $this -> generateMatricule ();
                $data[ "role" ]      = "assistant";
                $data[ "password" ]  = PasswordEncoder ::encode ( passwordGen ( 10 ) );
                //dd($data);
                $this -> model -> insert ( $data );
                Response ::redirectUrl ( "assistant/showAllAssistant" );
            }
            else {
                Session ::SetSession ( "array_error" , $this -> validator -> getErrors () );
                Session ::SetSession ( "array_post" , $data );
                Response ::redirectUrl ( "assistant/addAssistant" );
            }
        }
        $this -> render ( "assistant/register.assistant" );
    }

    public
    function login (
        Request $request
    )
    {

        if ($request -> isPost ()) {
            $modelAssistant = new AssistantModel();

            $data = $request -> getBody ();
            if (!$this -> validator -> estVide ( $data[ "email" ] , "email" )) {
                $this -> validator -> estMail ( $data[ "email" ] , "email" );
            }

            $this -> validator -> estVide ( $data[ "password" ] , "password" );

            if ($this -> validator -> formValide ()) {
                // login et mot de passe bien saisie sans erreur
                $user = $modelAssistant -> selectUserByLogin ( $data[ "email" ] );
                if (empty( $user )) {
                    $this -> validator -> setErrors ( "error_login" , "login ou mot de passe incorrect" );
                    Session ::setSession ( "array_error" , $this -> validator -> getErrors () );
                    Response ::redirectUrl ( "assistant/login" );
                }
                else {
                    // login et password correct et existe
                    // set_session("user_connect",$user);

                    //Session::setSession("user_connect",$user);
                    if (PasswordEncoder ::decode ( $data[ "password" ] , $user[ "password" ] )) {

                        Session ::setSession ( "user_connect" , $user );
                        //echo "Tout est correcte responsable";
                        $this -> render ( "assistant/dashboard.assistant" );
                    }
                    else {
                        $this -> validator -> setErrors ( "error_login" , "login ou mot de passe incorrect" );
                        Session ::setSession ( "array_error" , $this -> validator -> getErrors () );
                        Response ::redirectUrl ( "assistant/login" );
                    }
                }

            }
            else {
                //Erreur de validation donc redirection vers page de connexion

                Session ::SetSession ( "array_error" , $this -> validator -> getErrors () );

                Response ::redirectUrl ( "assistant/login" );

            }
        }

        $this -> render ( "assistant/login.assistant" );

    }

    public  function remove (Request $request){
        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("security/showInfo");
        }
        $id_assistant=$request->getParams()[0];
        $assistant_data=$this->model->selectById ($id_assistant);
        if($assistant_data['count'] == "0" ){

            Response::redirectUrl("responsable/showAllResponsable");
        }else{
            $this->model->remove ($id_assistant);
            Response::redirectUrl("assistant/showAllAssistant");
        }


    }


    public  function update (Request $request){
        $user=Session::getSession("user_connect");


        if($request->isPost()){

            $modelAssistant=new AssistantModel();
            $data= $request->getBody();
            //dd($_FILES);
            $assistant_data=$modelAssistant->selectById($data['id']);
            $this->validator->estVide($data["nom"], "nom");
            $this->validator->estVide($data["prenom"], "prenom");
            $this->validator->estVide($data["numeroTelephone"], "numeroTelephone");
            if(!$this->validator->estVide($data["email"], "email")){
                if ($this->validator->estMail($data["email"], "email")){

                    if($assistant_data['data']['email'] != $data['email']){

                        if($modelAssistant->loginExiste($data["email"])){

                            $this->validator->setErrors("login","ce login existe deja dans le systeme");
                        }
                    }
                }


            }
            if(isset($_FILES['avatar']) AND  !empty($_FILES['avatar']['name'])){

                $taille_autorise = 2097152;
                $extension_valide = array('jpg','jpeg','png');
                if($_FILES['avatar']['size'] <= $taille_autorise ){

                    $extension_upload= strtolower (substr (strrchr ($_FILES['avatar']['name'],'.'),1));
                    if(in_array ($extension_upload,$extension_valide)){

                        $chemin = ROOT_MEDIA."assistant".DIRECTORY_SEPARATOR.$data['id'].".".$extension_upload;
                        $result = move_uploaded_file ($_FILES['avatar']['tmp_name'],$chemin);
                        if($result){
                            $data['avatar']=$data['id'].".".$extension_upload;
                            // die("bien");
                        }else{
                            $this->validator->setErrors("error_iconnu","je ne sais pas ce qui s'est passe ressaye");
                        }

                    }else{
                        $this->validator->setErrors("file_type","extension non autorisé");
                    }

                }else{
                    $this->validator->setErrors("file_size","vous avez depassez la taille autorisé");
                }
            }


            if($this->validator->formValide()){

                $this->model->update($data);
                if($user['role']=="assistant"){

                    $this->render("assistant/info.assistant");

                }
                Response::redirectUrl("assistant/update/".$data["id"]);



            }else{
                Session::SetSession("array_error",$this->validator->getErrors());
                Response::redirectUrl("assistant/update/".$data["id"]);
            }
        }

        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("security/showInfo");
        }
        $id_assistant=$request->getParams()[0];

        if($user['role']=="assistant"){
            $id_assistant=intval ($user['id_assistant']);
        }
        $assistant_data=$this->model->selectById ($id_assistant);

        if($assistant_data['count'] == "0" ){

            Response::redirectUrl("assistant/showAllAssistant");
        }

        $this->render("assistant/update.assistant",["assistant"=>$assistant_data['data']]);


    }


    public
    function generateMatricule ()
    {

        $NombreId = $this -> model -> selectNombreId ();
        $mat      = 9000 + $NombreId + 1;
        $matrice  = "AC" . $mat;
        return $matrice;
    }

}