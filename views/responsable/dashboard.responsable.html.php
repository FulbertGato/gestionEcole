<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(!Authorisation::estResponsable()){
    Response::redirectUrl("security/visiteur");

}
$title ="Dashboard";
?>
<h1> Responsable dasboard</h1>
