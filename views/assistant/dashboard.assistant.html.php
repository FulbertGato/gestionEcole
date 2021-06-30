<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(!Authorisation::estAssistant()){
    Response::redirectUrl("security/visiteur");

}

$title ="DASBOARD"
?>
<h1> Assistant dasboard</h1>

