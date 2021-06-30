<?php

use ISM\lib\Session;

$title = "ajout module";
$array_error = [];
if (Session ::keyExist("array_error")){
    
    $array_error = Session::getSession("array_error");
   
    Session::destroyKey("array_error");    
}

?>

<div class="container">
<?php if(isset($array_error["libelle"])):?>
    <div  class="form-text text-danger ">
    <?= $array_error["libelle"]; ?></div>
<?php endif; ?>
<button class="btn btn-warning col-12"><h1 class="text-center "> Ajouter Module </h1> </button>
<form action="<?php path("module/addModule") ?>" method="post">
<div class="form-row">
    <div class="form-group col-md-6">
    <label ><h3>Libelle</h3></label>
        <input type="text" class="form-control" id="formGroupExampleInput"  name="libelle">
     </div>
    
    <div class="form-group col-md-6">
    <label ><h3>Nombre heures</h3></label>
      <input type="number" class="form-control" id="formGroupExampleInput"  name="nombreHeure">
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

</div>
