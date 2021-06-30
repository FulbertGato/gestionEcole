<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
use ISM\lib\Session;

$title ="Liste module";
$error = null;
$array_error = [];
if (Session ::keyExist("prof")){
    
    $error = Session::getSession("prof");
   //dd($error);
    Session::destroyKey("prof");    
}
?>
<div class="container mt-5">
<a href="<?php path("module/addModule") ?>"><button class="btn btn-warning col-12"><h1 class="text-center "> Ajouter Module </h1> </button></a>
<?php if($error != null):?>
        <div  class="form-text text-danger ">
        <?= $error ?></div>
    <?php endif; ?>
<div class=" row justify-content-center">


    <table class="table">
    <thead>
        <tr>
            <th>Libelle</th>
            <th>Heure total</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
        <?php /** @var TYPE_NAME $modules */
    foreach ($modules['data'] as $module):?>
        
      
      
        <tr>

            <td><?= $module['libelle']?></td>
            <td><?= $module['nombre_heure']?></td>

            <td>
                <a href="#" class="btn btn-info">Modifier</a>
                <a href="#" class="btn btn-danger">Supprimer</a>
                <a href="<?= path("cour/addCours/".$module['id_module']) ?>" class="btn btn-success">Planifier cours</a>
            </td>
  
        </tr>
        <?php  endforeach;?>
    </table>

</div>
</div>