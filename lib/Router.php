<?php
namespace ISM\lib;
use \ISM\controllers\ErrorController;
class Router{

    private Request $request;
    private ErrorController $ctlrError;

    public function  __construct(){
        $this-> request = new Request();
        $this-> ctlrError = new ErrorController();

    }

    Public  function resolve(){

        $array_uri = $this->request->getUri();
        if(empty($array_uri[0]) || !isset($array_uri[1]))Response::redirectUrl("security/visiteur");
        $action=$array_uri[1];
        if(strpos($action,"."))Response::redirectUrl("security/visiteur");
        $controller=ucfirst($array_uri[0])."Controller";
        if(file_exists(ROOT.DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR.$controller.".php")){
            $controllerClass= "ISM\\controllers\\".$controller;
            $objectController = new $controllerClass();
            if(method_exists($objectController,$action)){
                call_user_func([$objectController,$action],$this->request);
            }else{
                $this->ctlrError->pageNotFound();
              // echo(" method existe pas");
            }
        }else{
            $this->ctlrError->pageNotFound();
           // echo(" not found files");
        }
    
}
}