<?php
namespace ISM\controllers;
use \ISM\lib\AbstractController;
use \ISM\lib\Session;
use \ISM\lib\Response;
use \ISM\lib\Request;
use \ISM\lib\Authorisation;
use \ISM\models\AdminModel;
use \ISM\lib\AbstractModel;
use ISM\models\ClasseModel;
use ISM\models\EtudiantModel;

class SecurityController extends AbstractController{

    public function visiteur(){
       if(Authorisation::estAdmin()){
        
        $this->render("admin/dashboard.admin");
      }

       if(Authorisation::estAssistant())
          $this->render("assistant/dashboard.assistant");
       if(Authorisation::estEtudiant())
       $this->render("etudiant/dashboard.etudiant");
       if(Authorisation::estResponsable())
       $this->render("responsable/dashboard.responsable");
       if(Authorisation::estProf())
       $this->render("professeur/dashboard.professeur");
       
       $this->render("security/visiteur");
       
    }

    public function showInfo(){
      if(Authorisation::estAdmin()){
        $request = new Request;
              if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
                Response::redirectUrl("security/visiteur");
            }

        $this->render("admin/info.admin");

      }
      if(Authorisation::estAssistant())
      $this->render("assistant/info.assistant");

      if(Authorisation::estEtudiant()){

          $model_etudiant = new EtudiantModel();
          $etudiant = $model_etudiant->selectById (Session::getSession ("user_connect")['id']);
          $model_classe = new ClasseModel();
          $classe = $model_classe->selectById ($etudiant['data']['classe_id']);

          $this->render("etudiant/info.etudiant",["etudiant"=>$etudiant['data'],"classe"=>$classe['data']]);
      }

      if(Authorisation::estResponsable())
      $this->render("responsable/info.responsable");
      if(Authorisation::estProf())
      $this->render("professeur/info.prof");
      

      
   }

    public function logout(){
      Session::destroySession();
      Response::redirectUrl("security/visiteur");
  }
}
?>