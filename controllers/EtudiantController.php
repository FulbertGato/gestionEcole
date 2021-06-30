<?php
namespace ISM\controllers;
use ISM\lib\AbstractController;
use ISM\lib\Authorisation;
use ISM\models\EtudiantModel;
use ISM\models\ClasseModel;
use ISM\lib\Request;
use ISM\lib\Session;
use ISM\lib\Response;

use ISM\lib\PasswordEncoder;


class EtudiantController extends AbstractController{
        private EtudiantModel $model;

        public function __construct(){
            parent::__construct();
            $this->model= new EtudiantModel();
        }



    public function addEtudiant(Request $request){

            //dd(Session::getSession ('user_connect'));
            if(!Session::getSession ('user_connect')['role'] == "assistant"){

                Response::redirectUrl("security/visiteur");

            }
        $modelClasse=new ClasseModel();
        $modelEtudiant=new EtudiantModel();
        $dataClasse=$modelClasse->selectAll();
       //dd($dataClasse);
        if($request->isPost()){
           $data=$request->getBody();
           //dd($data);
            $this->validator->estVide($data["nom"], "nom");
            $this->validator->estVide($data["prenom"], "prenom");

            if(!$this->validator->estVide($data["email"], "email")){
                if($this->validator->estMail($data["email"], "email")){
                    
                    if($modelEtudiant->loginExiste($data["email"])){
                        $this->validator->setErrors("login","ce login existe deja dans le systeme");
                    }
                }
            }
            if($this->validator->formValide()){
                $data["matricule"] = $this->generateMatricule();
                $data["role"] = "etudiant";
                $data["password"]=PasswordEncoder::encode($data["password"]);
                //dd($data);
                $this->model->insert($data);
                Response::redirectUrl("etudiant/addEtudiant");
            }else{
                Session::SetSession("array_error",$this->validator->getErrors());
                Session::SetSession("array_post",$data);
                Response::redirectUrl("etudiant/addEtudiant"); 
               }
        }
        $this->render("etudiant/addEtudiant.etudiant",["classes"=> $dataClasse]);
        
        
        
    }

    public function showAllEtudiant(){
        if(Session::getSession ('user_connect')['role'] == "etudiant"){

            Response::redirectUrl("security/visiteur");

        }
        $mod_class=new ClasseModel;
        $data= $this->model->selectAll();
        $data_classe= $mod_class->selectAll();
        $this->render("etudiant/listeEtudiant", ["etudiants" => $data, "classes" => $data_classe]);


    }

    public function showDetailEtudiant(Request $request){

        if(Authorisation::estConnect()){
            Response::redirectUrl("security/visiteur");

        }
        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("etudiant/showAllEtudiant");
        }
       $id_etudiant=$request->getParams()[0];
       $data = $this->model->selectById($id_etudiant);
    $this->render("etudiant/etudiantInfos",["etudiant"=> $data]);
    }


    public function listEtudiantByClass (Request $request){
        if(Session::getSession ('user_connect')['role'] == "etudiant"){

            Response::redirectUrl("security/visiteur");

        }

        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("classe/show_all_classe");
        }

        $id_classe=$request->getParams()[0];
        $array_etudiants = [];
        $mod_class=new ClasseModel;
        $data_classe= $mod_class->selectById ( $id_classe);

        if(empty($data_classe['data'])){
            Response::redirectUrl("classe/show_all_classe");
        }
        $data_etudiant = $this->model->selectAll ();


        foreach ($data_etudiant['data'] as $etudiant){

            if($etudiant['classe_id']== $id_classe){

                array_push ($array_etudiants, $etudiant);
            }

        }

        $this->render("etudiant/list.by.etudiant",["etudiants" => $array_etudiants, "classe" => $data_classe]);

    }



    public function login(Request $request){

        if(Authorisation::estConnect()){
            Response::redirectUrl("security/visiteur");

        }

        if($request->isPost()){
            $modelEtudiant=new EtudiantModel();

            $data= $request->getBody();
            if(!$this->validator->estVide($data["email"], "email")){
                $this->validator->estMail($data["email"], "email");
            }
            $this->validator->estVide($data["password"], "password");

            if($this->validator->formValide()){
                // login et mot de passe bien saisie sans erreur
                $user = $modelEtudiant->selectUserByLogin($data["email"] );
                if(empty($user)){
                    $this->validator->setErrors("error_login","login ou mot de passe incorrect ");
                    Session::setSession("array_error",$this->validator->getErrors());
                    Response::redirectUrl("etudiant/login");
                }else{

                    if(PasswordEncoder::decode($data["password"], $user["password"])){

                        Session::setSession("user_connect",$user);
                        $this->render("etudiant/dashboard.etudiant");

                    }else{
                        $this->validator->setErrors("error_loginP","login ou mot de passe incorrect passe");
                        Session::setSession("array_error",$this->validator->getErrors());
                        Response::redirectUrl("etudiant/login");
                    }
                }

            }else{
                //Erreur de validation donc redirection vers page de connexion

                Session::SetSession("array_error",$this->validator->getErrors());

                Response::redirectUrl("etudiant/login");

            }
        }

        $this->render("etudiant/login.etudiant");

    }


    public  function  update(Request $request){

        if(!Authorisation::estConnect()){
            Response::redirectUrl("security/visiteur");

        }


        $etudiant_model = new EtudiantModel();

        if($request->isPost()){
            $data = $request->getBody();
           // dd($data);
            $etudiant = $etudiant_model->selectById ($data['id']);
            if(!$this->validator->estVide($data["email"], "email")){
                if($this->validator->estMail($data["email"], "email")){

                    if(! $data["email"] == $etudiant['data']['email']){

                        if($etudiant_model->loginExiste($data["email"])){
                            $this->validator->setErrors("login","ce login existe deja dans le systeme");
                        }

                    }


                }



            }

            if($data['newPassword'] != ""){

                if(!$this->validator->estVide($data["oldPassword"], "oldPassword")){


                    if(!PasswordEncoder::decode($data["oldPassword"], $etudiant['data']["password"])){

                        $this->validator->setErrors("error_password","ancien mot de passe incorrete");
                    }

                }
            }

            if($this->validator->formValide()){

                if($data['newPassword'] != ""){

                    //Mise à jour de mot du password
                    $data['newPassword']=PasswordEncoder::encode($data['newPassword']);
                    $etudiant_model->updateE ($data,true);
                }else{
                    $etudiant_model->updateE ($data);
                }
            }
            Response::redirectUrl ("security/logout");
        }


        $this->render("etudiant/info.etudiant");


    }




    public function generateMatricule(){

        $NombreId = $this->model->selectNombreId();
        $mat= $NombreId+1;
        $matrice= "ET".$mat."-MA-2021";
        return $matrice;
    }





    }


