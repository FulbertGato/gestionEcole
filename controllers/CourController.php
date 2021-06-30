<?php
namespace ISM\controllers;

use DateTime;
use ISM\lib\AbstractController;
use ISM\lib\Response;
use ISM\lib\Request;
use ISM\lib\Session;
use ISM\models\ClasseModel;
use ISM\models\CourModel;
use ISM\models\ModuleModel;
use ISM\models\ProfModel;

class CourController extends AbstractController{


       private CourModel $cour_model;
       private ProfModel $prof_model;
       private ModuleModel $module_model;
       private ClasseModel $classe_model;

        public function __construct(){
            parent::__construct();
           $this->cour_model= new CourModel();
           $this->prof_model = new ProfModel();
           $this->module_model = new ModuleModel();
           $this->classe_model = new ClasseModel();

        }

        public function showAllCours(){
            $data= $this->cour_model->selectAll();
            $data_modules = $this->module_model->selectAll();
            $data_classe =  $this->classe_model->selectAll();
            $data_prof= $this->prof_model->selectAll();
            $this->render("cour/list.cour", ["cours" => $data, "modules" => $data_modules, "classes"=> $data_classe, "profs"=> $data_prof]);
        }

        public function addCours(Request $request){
            $data_cours = $this->cour_model->selectAll();

            $data_prof = $this->prof_model->selectAll();
            
            $data_classe = $this->classe_model->selectAll();
            if($request->isPost()){
                $data = $request->getBody();
                /**
                * Formatage des dates et heures recuperer dans le formulaires
                */
                $a=$data['date_cours']." ".$data['heureDebut'];
                $b=$data['date_cours']." ".$data['heurFin'];
                $hour_actuel=(new DateTime())->format('Y-m-d h:i');
                $hour_debut =(new DateTime($a))->format('Y-m-d h:i');
                $hour_fin =(new DateTime($b))->format('Y-m-d h:i');
                $expiry = (new DateTime($data['date_cours']))->format('Y-m-d');
                $today = (new DateTime())->format('Y-m-d');        
                if(strtotime($today) > strtotime($expiry)){

                    $this->validator->setErrors("date","veuillez verifier la date du cours");
                }
                
                if(strtotime($hour_actuel) > strtotime($hour_debut)){

                    
                    $this->validator->setErrors("heure_debut","veuillez verifier l'heure du cours");

                }
                if(strtotime($hour_debut) > strtotime($hour_fin)){                   
                    $this->validator->setErrors("heure_fin","veuillez verifier l'heure de fin cours");
                }
                $this->validator->estVide($data["heureDebut"], "heureDebut");
                $this->validator->estVide($data["heurFin"], "heurFin");
                $this->validator->estVide($data["date_cours"], "date_cours");
                if(!array_key_exists("prof_id", $data)){
                    $this->validator->setErrors("prof","veuillez choisir un professeur");
                }
                 if(!array_key_exists("semestre", $data)){
                    $this->validator->setErrors("semestre","veuillez choisir un semestre");
                }
                if(!isset ($data["classes"])){
                    $this->validator->setErrors("classes","veuillez choisir au moins une classe");
                }
                //dd($data);
                if($this->validator->formValide()){
                    $table_cour_id=Array();
                    $prof_modele= new ProfModel;
                    $cour_modele= new CourModel;
                    $data_prof_all = $prof_modele->selectAll();
                    

 


                    $data["classes"]=base64_encode(serialize($data["classes"]));
                    $this->cour_model->insert($data);


                    $data_cours_ = $cour_modele->selectAll();
                    //dd($data_cours_);
                    foreach ($data_cours_['data'] as $cour) {

                        if($data["prof_id"]==@$cour['professeur_id']){
                            array_push($table_cour_id , $cour["id_cour"]);
                        }  
                    }
                    $table_cour_id=base64_encode(serialize($table_cour_id));
                    foreach ($data_prof_all['data'] as $prof_){
                        if($data["prof_id"]==@$prof_['id']){
                            $this->prof_model->updateProfCourse((array)$table_cour_id,$data["prof_id"]);
                            Response::redirectUrl("cour/showAllCours");
                        }
                    }
                    
                }else{
                    Session::SetSession("array_error",$this->validator->getErrors());
                    Session::SetSession("array_post",$data);
                    Response::redirectUrl("cour/addCours"); 
                   }
            }
            if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
                Response::redirectUrl("module/showAllModule");
            }
            $id_Module=$request->getParams()[0];
            $data_module = $this->module_model->selectById($id_Module);

            //decodage de la liste module dans table prof
            $table_prof=Array();
            $table_profT=Array();
            foreach ($data_prof['data'] as  $professeur){

                if (!$professeur['module'] == null)
                {
                    @$professeur['module']=unserialize(base64_decode( $professeur['module']));
                    //ajout dans une nouvelle table 
                    array_push($table_prof,$professeur);
                }

            }

            //recuperation des prof lie au module
            foreach ($table_prof as  $professeur){
                if(@in_array($id_Module, $professeur["module"])){

                    array_push($table_profT,$professeur);
                }
            }
            
            $this->render("cour/add.cours",["modules" => $data_module, "profs" => $table_profT,"classes" => $data_classe ]);

        }


        public function list_cour_by_prof(Request $request){
            $user=Session::getSession ("user_connect");
            //dd($user);
            $module_model = New ModuleModel();
            $data_module = $module_model->selectAll ()['data'];
            if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
                Response::redirectUrl("professeur/showAllProfesseur");
            }

            $id_prof=$request->getParams()[0];
            //verification ne montrez toujours que le id du prof connecter
            if($user["role"]=="professeur"){

                $id_prof=$user['id'];
            }
            $data_prof = $this->prof_model->selectById($id_prof);
            $data_cours = $this->cour_model->selectAll();
           // dd($data_cours);
            if($data_prof['count']==0){
                Response::redirectUrl("professeur/showAllProfesseur");

            }else{

                $table_cour=Array();
                $data_prof_ = $data_prof['data'];

                @$data_prof_['liste_cours']=unserialize(base64_decode( $data_prof_['liste_cours']));

                if(!empty($data_prof_['liste_cours'])){
                    //$i=0;
                    foreach ($data_prof_['liste_cours'] as $courid) {

                        foreach ($data_cours['data'] as $cour_) {

                            if($cour_['id_cour'] == $courid){
    
                                array_push($table_cour, $cour_);
                                break;

                            }

                        }
                        
                    }

                   // dd($table_cour);
                    $this->render("cour/list.prof.cour",["cours" =>$table_cour, "prof" =>$data_prof_, "modules" => $data_module]);
                }else{
                    echo "aucun cour";
                }
            }



        }


    public function list_cour_by_classe(Request $request){

        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("security/visiteur");
        }

        $id_classe=$request->getParams()[0];

        $classe_model = new ClasseModel();
        $data_classe =$classe_model->selectById($id_classe);
        //dd($data_classe);
        $data_cours = $this->cour_model->selectAll();
       // dd($data_cours);
        if($data_classe['count']==0){
            Response::redirectUrl("classe/showAllClass");

        }else{
            $table_cour=[];

            foreach ($data_cours['data'] as $cour){

                @$cour['classe_id_list']=unserialize(base64_decode( $cour['classe_id_list']));
                if(in_array ($id_classe,$cour['classe_id_list'])){

                    array_push($table_cour, $cour);

                }
            }
            //dd($table_cour);


                // dd($table_cour);
                $this->render("cour/list.classe.cour", ["cours" =>$table_cour, "classe"=>$data_classe]);
            }


}
}