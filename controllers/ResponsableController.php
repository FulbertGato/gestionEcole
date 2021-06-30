<?php
namespace ISM\controllers;
use ISM\lib\AbstractController;
use ISM\models\ResponsableModel;
use ISM\lib\Request;
use ISM\lib\Session;
use ISM\lib\Response;
use ISM\lib\PasswordEncoder;
class ResponsableController extends AbstractController {

       private ResponsableModel $model;

        public function __construct(){
            parent::__construct();
           $this->model= new ResponsableModel();
        }

        public function showAllResponsable(){
            $dataResponsable= $this->model->selectAll();
            $this->render("responsable/list.responsable",["responsables"=> $dataResponsable]);
        }

        public function addResponsable(Request $request){
            $modelResponsable=new ResponsableModel();
            //$dataResponsable=$modelResponsable->selectAll();
           //dd($dataResponsable);
            if($request->isPost()){
               $data=$request->getBody();
               //dd($data);
                $this->validator->estVide($data["nom"], "nom");
                $this->validator->estVide($data["prenom"], "prenom");
                $this->validator->estVide($data["telephone"], "telephone");
                $this->validator->estVide($data["paysOrigine"], "paysOrigine");
                if(!$this->validator->estVide($data["email"], "email")){
                    if($this->validator->estMail($data["email"], "email")){
                        if($modelResponsable->loginExiste($data["email"])){
                            $this->validator->setErrors("login","ce login existe deja dans le systeme");
                        }
                    }
                }
                if($this->validator->formValide()){
                    $data["matricule"] = $this->generateMatricule();
                    $data["role"] = "responsable";
                    $data["password"]=PasswordEncoder::encode(passwordGen(10));
                    //dd($data);
                    $this->model->insert($data);
                    Response::redirectUrl("responsable/showAllResponsable");
                }else{
                    Session::SetSession("array_error",$this->validator->getErrors());
                    Session::SetSession("array_post",$data);
                    Response::redirectUrl("responsable/addResponsable"); 
                   }
            }
            $this->render("responsable/register.responsable");
        }


        public function login(Request $request){

            if($request->isPost()){
                $modelResponsable=new ResponsableModel();
    
                $data= $request->getBody();
                if(!$this->validator->estVide($data["email"], "email")){
                    $this->validator->estMail($data["email"], "email");
                }
                $this->validator->estVide($data["password"], "password");
    
                if($this->validator->formValide()){
                    // login et mot de passe bien saisie sans erreur
                    $user = $modelResponsable->selectUserByLogin($data["email"] );
                    if(empty($user)){
                        $this->validator->setErrors("error_login","login ou mot de passe incorrect");
                        Session::setSession("array_error",$this->validator->getErrors());
                        Response::redirectUrl("responsable/login");
                     }else{
                         // login et password correct et existe
                         // set_session("user_connect",$user);
                        
                         //Session::setSession("user_connect",$user);
                        if(PasswordEncoder::decode($data["password"], $user["password"])){
    
                            Session::setSession("user_connect",$user);
                            //echo "Tout est correcte responsable";
                            $this->render("responsable/dashboard.responsable");
                        }else{
                            $this->validator->setErrors("error_login","login ou mot de passe incorrect");
                            Session::setSession("array_error",$this->validator->getErrors());
                            Response::redirectUrl("responsable/login");
                        }
                     }
    
                }else{
                //Erreur de validation donc redirection vers page de connexion
                
                 Session::SetSession("array_error",$this->validator->getErrors());
               
                 Response::redirectUrl("responsable/login");

                }
            } 

            $this->render("responsable/login.responsable");
            
        }
        public  function remove (Request $request){
            if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
                Response::redirectUrl("security/showInfo");
            }
            $id_responsable=$request->getParams()[0];
            $responsable_data=$this->model->selectById ($id_responsable);
            if($responsable_data['count'] == "0" ){

                Response::redirectUrl("responsable/showAllResponsable");
            }else{
                $this->model->remove ($id_responsable);
                Response::redirectUrl("responsable/showAllResponsable");
            }


        }

        public  function update (Request $request){
            $user=Session::getSession("user_connect");
            if($request->isPost()){


                $modelResponsable=new ResponsableModel();
                $data= $request->getBody();
                $responsable_data=$modelResponsable->selectById ($data['id']);
                $this->validator->estVide($data["nom"], "nom");
                $this->validator->estVide($data["prenom"], "prenom");
                $this->validator->estVide($data["numeroTelephone"], "numeroTelephone");
                if(!$this->validator->estVide($data["email"], "email")){
                   if ($this->validator->estMail($data["email"], "email")){



                       //dd($responsable_data['data']['email'] );
                       if($responsable_data['data']['email'] != $data['email']){

                           if($modelResponsable->loginExiste($data["email"])){
                               //dd($responsable_data);
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

                         $chemin = ROOT_MEDIA."responsable".DIRECTORY_SEPARATOR.$data['id'].".".$extension_upload;
                         $result = move_uploaded_file ($_FILES['avatar']['tmp_name'],$chemin);
                         if($result){
                             $data['avatar']=$data['id'].".".$extension_upload;

                         }else{
                             $this->validator->setErrors("error_inconnu","ressaye je sais pas ce qui s'est passé");
                         }

                      }else{
                          $this->validator->setErrors("file_type","extension non autorisé");
                      }

                  }else{
                      $this->validator->setErrors("file_size","vous avez depassez la taille autorisé");


                  }
                }


                if($this->validator->formValide()){
                    //dd ($data);
                    $modelResponsable->update($data);
                    if($user['role']=="responsable"){

                        $this->render("responsable/info.responsable");

                    }
                   Response::redirectUrl("responsable/update/".$data["id"]);


                }else{
                    Session::SetSession("array_error",$this->validator->getErrors());
                    Response::redirectUrl("responsable/update/".$data["id"]);
                }
            }

            if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
                Response::redirectUrl("security/showInfo");
            }

            $id_responsable=$request->getParams()[0];

            if($user['role']=="responsable"){
                $id_responsable=intval ($user['id_responsable']);
            }

            $responsable_data=$this->model->selectById($id_responsable);
            if($responsable_data['count'] == "0" ){
                Response::redirectUrl("responsable/showAllResponsable");
            }
            $this->render("responsable/update.responsable",["responsable"=>$responsable_data['data']]);
        }


        public function generateMatricule(){

            $NombreId = $this->model->selectNombreId();
            $mat= 5000+$NombreId+1;
            $matrice= "RP".$mat;
            return $matrice;
        }

}