<?php
namespace ISM\controllers;
use DateTime;
use ISM\lib\AbstractController;
use ISM\lib\Authorisation;
use ISM\lib\PasswordEncoder;
use iSM\lib\Request;
use ISM\lib\Response;
use ISM\lib\Session;
use ISM\models\ClasseModel;
use ISM\models\ProfModel;
use ISM\models\ModuleModel;

class ProfesseurController extends AbstractController {


    private ProfModel $model;

        public function __construct(){
            parent::__construct();
           $this->model= new ProfModel();
        }

        public function showAllProfesseur(){
            $modelClass = new ClasseModel();
            $modelModule= new ModuleModel();
            $dataModule = $modelModule->selectAll();
            $dataClasse=$modelClass->selectAll();
            $dataProfesseurs= $this->model->selectAll();
            $this->render("professeur/list.professeur",["professeurs"=> $dataProfesseurs,"classes"=> $dataClasse, "modules" => $dataModule]);
        }


        public function addProfesseur(Request $request){

            if(!Session::getSession ('user_connect')['role'] == "responsable"){

                Response::redirectUrl("security/visiteur");

            }
            $modelProf=new ProfModel();
            $modelModule= new ModuleModel();
            $dataModule = $modelModule->selectAll();

            if($request->isPost()){
               $data=$request->getBody();
               //dd($data["classe"]);
                $this->validator->estVide($data["nom"], "nom");
                $expiry = (new DateTime($data['date_cours']))->format('Y-m-d');
                $today = (new DateTime())->format('Y-m-d'); //use format whatever you are using         
                if(strtotime($today) > strtotime($expiry)){

                    $this->validator->setErrors("date","veuillez verifier la date du cours");
                }
                if(!isset($data["module"])){
                    $this->validator->setErrors("module","choix obligatoire");
                }
                $this->validator->estVide($data["prenom"], "prenom");
                $this->validator->estVide($data["telephone"], "telephone");
                if(!$this->validator->estVide($data["email"], "email")){
                    if($this->validator->estMail($data["email"], "email")){
                        if($modelProf->loginExiste($data["email"])){
                            $this->validator->setErrors("login","ce login existe deja dans le systeme");
                        }
                    }
                }
                if($this->validator->formValide()){
                    $data["matricule"] =$this->generateMatricule();
                    $data["role"] = "professeur";
                    $data["password"]=PasswordEncoder::encode(passwordGen("1234@"));
                   // dd($data);
                   // $data["classe"]=base64_encode(serialize($data["classe"]));
                    $data["module"]=base64_encode(serialize($data["module"]));
                    $this->model->insert($data);
                    Response::redirectUrl("professeur/showAllProfesseur");
                }else{
                   
                    Session::SetSession("array_error",$this->validator->getErrors());
                    Session::SetSession("array_post",$data);
                    Response::redirectUrl("professeur/addProfesseur"); 
                   }
            }
            $this->render("professeur/register.professeur",["modules" => $dataModule]);
        }

        public function generateMatricule(){

            $NombreId = $this->model->selectNombreId();
            $mat= 8000+$NombreId+1;
            $matrice= "PR".$mat."-MA-2021";
            return $matrice;
        }

        public function login(Request $request){

            if(Authorisation::estConnect()){
                Response::redirectUrl("security/visiteur");

            }

            if($request->isPost()){
                $modelProf=new ProfModel();
    
                $data= $request->getBody();
                if(!$this->validator->estVide($data["email"], "email")){
                    $this->validator->estMail($data["email"], "email");
                }
                $this->validator->estVide($data["password"], "password");
    
                if($this->validator->formValide()){
                    // login et mot de passe bien saisie sans erreur
                    $user = $modelProf->selectUserByLogin($data["email"] );
                    if(empty($user)){
                        $this->validator->setErrors("error_login","login ou mot de passe incorrect pas trouver");
                        Session::setSession("array_error",$this->validator->getErrors());
                        Response::redirectUrl("professeur/login");
                     }else{
                         
                        if(PasswordEncoder::decode($data["password"], $user["password"])){
    
                            Session::setSession("user_connect",$user);
                            $this->render("professeur/dashboard.professeur");

                        }else{
                            $this->validator->setErrors("error_loginP","login ou mot de passe incorrect passe");
                            Session::setSession("array_error",$this->validator->getErrors());
                            Response::redirectUrl("professeur/login");
                        }
                     }
    
                }else{
                //Erreur de validation donc redirection vers page de connexion
                
                 Session::SetSession("array_error",$this->validator->getErrors());
               
                 Response::redirectUrl("professeur/login");

                }
            } 

            $this->render("professeur/login.professeur");
            
        }


        public  function  update(Request $request){

            if(!Authorisation::estConnect()){
                Response::redirectUrl("security/visiteur");

            }


            $prof_model = new ProfModel();


            if($request->isPost()){
                $data = $request->getBody();

                $data_prof = $prof_model->selectById ($data['id']);
                if(!$this->validator->estVide($data["email"], "email")){
                    if($this->validator->estMail($data["email"], "email")){

                        if(! $data["email"] == $data_prof['data']['email']){

                            if($prof_model->loginExiste($data["email"])){
                                $this->validator->setErrors("login","ce login existe deja dans le systeme");
                            }

                        }


                    }



                }
                $this->validator->estVide($data["numero"], "numero");

                if($data['newPassword'] != ""){

                    if(!$this->validator->estVide($data["oldPassword"], "oldPassword")){


                        if(!PasswordEncoder::decode($data["oldPassword"], $data_prof['data']["password"])){

                            $this->validator->setErrors("error_password","ancien mot de passe incorrete");
                        }

                    }
                }

                if($this->validator->formValide()){

                    if($data['newPassword'] != ""){

                        //Mise à jour de mot du password
                        $data['newPassword']=PasswordEncoder::encode($data['newPassword']);
                        $prof_model->updateP ($data,true);
                    }else{
                        $prof_model->updateP ($data);
                    }
                }






            }


            $this->render("professeur/info.prof");


        }

       

}