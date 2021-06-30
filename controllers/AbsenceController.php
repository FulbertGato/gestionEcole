<?php
namespace ISM\controllers;

use DateTime;
use iSM\lib\Request;
use ISM\lib\Response;
use ISM\lib\Session;
use ISM\models\AbsenceModel;
use ISM\models\CourModel;
use ISM\models\EtudiantModel;
use ISM\models\ModuleModel;

class AbsenceController extends \ISM\lib\AbstractController
{
    private AbsenceModel  $model;
    public
    function __construct ()
    {
        parent ::__construct ();
        $this->model = new AbsenceModel();
    }

    public function heureAbsenceSet(string $id, int $upABS ){

        $model_etudiant = new EtudiantModel();
        $model_etudiant->set_absence_hour(intval($id),$upABS);

    }

    public function  listes_etudiant_cours(Request $request){

        if($request->isPost ()){


            $array_id=$request->getBody ();

            if(sizeof ($array_id)>1){
               // dd($array_id);
                $model_etudiant = new EtudiantModel();
                $model_cour = new CourModel();

                $all_et=$model_etudiant->selectAll ();
               foreach ($array_id['id_etu'] as $i){

                    foreach ($all_et['data'] as $etu){

                        if($etu['id'] == $i){

                            $upABS=$etu['nombre_absence']+1;
                            $this->heureAbsenceSet ($i,$upABS);
                        }

                    }

                }

                $array_id['nombre_absent'] = sizeof($array_id['id_etu']);
                $array_id['id_etu']=base64_encode(serialize($array_id['id_etu']));
                //dd($array_id);
                $array_id['date_absence']=(new DateTime())->format('Y-m-d');
                $this->model->insert($array_id);

               // dd($array_id);
              // echo $array_id['nombre_absent'];

              $model_cour->setAbsenStatuts($array_id);


            }else{
                $model_cour = new CourModel();
                $model_cour->setAbsenStatuts($array_id);

            }

        }


        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("cour/showAllCours");
        }
        $cour_id=$request->getParams()[0];
        $model_cour = new CourModel();
        $data_cour = $model_cour->selectById($cour_id);
        $id_class_array = [];
        $array_etudiants=[];
        //dd($data_cour['data']);
        $data_cour['data']['classe_id_list']=unserialize(base64_decode( $data_cour['data']['classe_id_list']));

        foreach ($data_cour['data']['classe_id_list'] as $i){


            array_push ($id_class_array,$i);
        }
        //selection de l'ensemble des etudiant de la classe
        $model_etudiant = new EtudiantModel();
        $data_etudiant = $model_etudiant->selectAll();

        foreach ($data_etudiant['data'] as $etudiant){

            if( in_array($etudiant['classe_id'],$id_class_array)){

                array_push ($array_etudiants,$etudiant);
            }
        }

       // dd($array_etudiants);

        $this->render ("etudiant/list_for_cours", ["etudiants"=>$array_etudiants, "id_cour"=>$cour_id]);
    }


    public function  mes_absences(Request $request){

       /* if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("security/showInfo");
        }
        $cour_id=$request->getParams()[0];*/
        $user = Session::getSession ("user_connect");
        $absence_model = new AbsenceModel();
        $data_absence = $absence_model->selectAll ();
        $cours_id=[];
        $cours =[];
        foreach ($data_absence['data'] as $absence){

            $absence['list_etudiant_id']=unserialize(base64_decode( $absence['list_etudiant_id']));
           // dd($absence['list_etudiant_id']);
            foreach ($absence['list_etudiant_id'] as $id){


                if($user['id']==$id){
                    array_push ($cours_id,$absence['cour_id']);
                }
            }

        }
        //dd($cours_id);
        $cour_model = new CourModel();

        foreach ($cours_id as $id){
            $data_cour=$cour_model->selectById ($id);
            array_push ($cours,$data_cour['data']);
        }
        $modul_model = new ModuleModel();

            $module = $modul_model->selectAll ();
        $this->render ("etudiant/absence.etudiant", ["cours"=>$cours,"modules"=>$module['data']]);

    }
}