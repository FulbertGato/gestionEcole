<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(!Authorisation::estEtudiant()){
    Response::redirectUrl("security/visiteur");

}
?>
<h1> Etudiant dasboard</h1>
