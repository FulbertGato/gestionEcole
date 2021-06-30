<?php
namespace ISM\controllers;
use \ISM\lib\AbstractController;

class ErrorController extends AbstractController {

    public function pageNotFound(){
        http_response_code(404);
        $this->render("error/404");

    }
    public function pageForbidden(){
        http_response_code(403);
        $this->render("error/403");
    }



    
}