<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(!Authorisation::estProf()){
    Response::redirectUrl("security/visiteur");

}
?>
<h1> professeur dasboard</h1>
