<?php

namespace ISM\controllers;

use ISM\lib\AbstractController;
use iSM\lib\Request;
use ISM\lib\Response;
use ISM\lib\Session;
use ISM\models\ClasseModel;
use ISM\models\FiliereModel;

class ClasseController extends AbstractController{

    private ClasseModel $model;
    private FiliereModel  $filiere_model;

    public function __construct(){
        parent::__construct();
        $this->model= new ClasseModel();
        $this->filiere_model = new FiliereModel();
    }

    public function  show_all_classe(){
        $data_classe = $this->model->selectAll();
        $data_filiere=$this->filiere_model->selectAll ();


        $this->render("classe/list.classe",["classes"=> $data_classe, "filieres" =>$data_filiere]);
    }

    public function  addClasse(Request $request){
        if($request->isPost()){

            $data = $request->getBody();
            if (isset($data)) {
              // dd($data);
                $this->validator->estVide($data["libelle"], "libelle");
                $this->validator->estVide($data["nombre_etudiant"], "nombre_etudiant");

                    if($data['filiere']=="0"){
                        $this->validator->setErrors("filiere","vous devez choisir filiere");
                    }
                    if($this->validator->formValide()){

                        //dd($data);
                        $this->model->insert($data);
                        Response::redirectUrl("classe/show_all_classe");
                    }else{
                        Session::SetSession("array_error",$this->validator->getErrors());
                        //Session::SetSession("array_post",$data);

                        Response::redirectUrl("classe/addClasse");
                    }


            }


        }
        $data_filiere=$this->filiere_model->selectAll ();

        $this->render("classe/add.classe",[ "filieres" =>$data_filiere]);



    }
    
}