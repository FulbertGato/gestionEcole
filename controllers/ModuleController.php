<?php
namespace ISM\controllers;
use ISM\lib\AbstractController;
use ISM\lib\Request;
use ISM\lib\Response;
use ISM\lib\Session;
use ISM\models\ModuleModel;
class ModuleController extends AbstractController {

    private ModuleModel $model;

    public function __construct(){
        parent::__construct();
        $this->model= new ModuleModel();
    }

    public function showAllModule(){
        $modelModule= new ModuleModel();
        $dataModule = $modelModule->selectAll();
        $this->render("module/list.module",["modules" => $dataModule]);
    }

 
 public function addModule(Request $request){
    
    $modelModule= new ModuleModel();
    
    if($request->isPost()){
       $data=$request->getBody();
        $this->validator->estVide($data["libelle"], "libelle");

                if($modelModule->libelleExiste($data["libelle"])){
                    $this->validator->setErrors("libelle","ce module existe deja dans le systeme");
                }
            
        

        if($this->validator->formValide()){
            $this->model->insert($data);
            Response::redirectUrl("module/showAllModule");
        }else{
           
            Session::SetSession("array_error",$this->validator->getErrors());
            Session::SetSession("array_post",$data);
            Response::redirectUrl("module/addModule"); 
           }
    }
    $this->render("module/add.module");
}

}