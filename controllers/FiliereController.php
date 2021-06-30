<?php


namespace ISM\controllers;


use iSM\lib\Request;
use ISM\lib\Response;
use ISM\lib\Session;
use ISM\models\ClasseModel;
use ISM\models\FiliereModel;

class FiliereController extends \ISM\lib\AbstractController
{

    private FiliereModel  $model;
    private ClasseModel $class_model;
    public function __construct(){
        parent::__construct();
        $this->model= new FiliereModel;
        $this->class_model = new ClasseModel();
    }

    public  function  add_Filiere(Request $request){

        if($request->isPost ()){

           $data= $request->getBody ();
           if(!key_exists ("niveaux", $data)){
               $this->validator->setErrors ("niveaux", "choisir au moins une filiere");
           }
            $this->validator->estVide ($data['name'],"name");

            if($this->validator->formValide ()){

                   // dd($data);
                $data["niveaux"]=base64_encode(serialize($data["niveaux"]));
                $this->model->insert ($data);

            }else{
                Session::SetSession("array_error",$this->validator->getErrors());

                Response::redirectUrl("filiere/add_filiere");
            }
        }

        $this->render ("filiere/add.filiere");
    }
    public function show_all_filiere(){

        $data_filiere =$this->model->selectAll ();
        if(isset($data_filiere['data'])){

            $this->render ("filiere/list.filiere",["filieres" => $data_filiere]);
        }
        $this->render ("filiere/add.filiere");
    }
}