<?php
namespace ISM\controllers;
use \ISM\lib\Request;
use \ISM\lib\Session;
use \ISM\lib\Response;
use \ISM\lib\AbstractController;
use \ISM\models\AdminModel;
use \ISM\lib\PasswordEncoder;
use \ISM\lib\Authorisation;
class AdminController extends AbstractController {
    private AdminModel $model;
    public function register(Request $request){
        if($request->isPost()){
            $this->model= new AdminModel();
            
            $data=$request->getBody();
            $this->validator->estVide($data["nom"], "nom");
            $this->validator->estVide($data["prenom"], "prenom");
            if(!$this->validator->estVide($data["email"], "email")){
                if($this->validator->estMail($data["email"], "email")){
                    
                    if($this->model->loginExiste($data["email"])){
                        $this->validator->setErrors("login","ce login existe deja dans le systeme");
                    }
                }
            }
        
            $this->validator->estVide($data["password"], "password");
           
           if($this->validator->formValide()){
               $data["nom_complet"] = $data["nom"]." ".$data["prenom"];
               unset($data["nom"]);
               unset($data["prenom"]);
       
               $data["password"]=PasswordEncoder::encode($data["password"]);
               $data["role"] = "admin";
               $this->model->insert($data);
               //dd($data);
               Response::redirectUrl("admin/login");
           }else{
            Session::SetSession("array_error",$this->validator->getErrors());
            Session::SetSession("array_post",$data);
            Response::redirectUrl("admin/register");  
           }
        }
        $this->render("admin/register.admin");
        
    }

    public function login(Request $request){

        if($request->isPost()){
            $this->model= new AdminModel();

            $data= $request->getBody();
            if(!$this->validator->estVide($data["email"], "email")){
                $this->validator->estMail($data["email"], "email");
            }
            $this->validator->estVide($data["password"], "password");

            if($this->validator->formValide()){
                // login et mot de passe bien saisie sans erreur
                $user = $this->model->selectUserByLogin($data["email"] );
                if(empty($user)){
                    $this->validator->setErrors("error_login","login ou mot de passe incorrect");
                    Session::setSession("array_error",$this->validator->getErrors());
                    Response::redirectUrl("admin/login.admin");
                 }else{
                     // login et password correct et existe
                     // set_session("user_connect",$user);
                    
                     //Session::setSession("user_connect",$user);
                    if(PasswordEncoder::decode($data["password"], $user["password"])){

                        Session::setSession("user_connect",$user);
                        //echo "Tout est correcte";
                        $this->render("admin/dashboard.admin");
                    }else{
                        $this->validator->setErrors("error_login","login ou mot de passe incorrect");
                        Session::setSession("array_error",$this->validator->getErrors());
                        Response::redirectUrl("admin/login");
                    }
                 }

            }else{
            //Erreur de validation donc redirection vers page de connexion
            
            Session::SetSession("array_error",$this->validator->getErrors());
           
            Response::redirectUrl("admin/login");
            }


        }else{
            
            $this->render("admin/login.admin");
        }
    }


}