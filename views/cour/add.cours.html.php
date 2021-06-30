<?php
use ISM\lib\Response;
use ISM\lib\Session;
$title = 'Planification cours';

$module=$modules['data'];
$array_error = [];
if (Session::keyExist("array_error")){
    //recupeeration des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
   // dd($array_error);
    Session::destroyKey("array_error"); 
   
}else{

   if(empty($modules['data'])){
  
      Response::redirectUrl("module/showAllModule"); 
   }
   if(empty($profs)){
      
      Session::setSession("prof", "aucun prof n existe pour ce module");
      Response::redirectUrl("module/showAllModule"); 
   }
}

$classes=$classes['data'];

?>

<div class="container mt-5" >
   <button class="btn btn-warning col-12"><h1 class="text-center "> Planifier un cours </h1> </button>
   
   <form action="<?php path("cour/addCours") ?>" method="post">

      <div class="form-row">
           <div class="form-group col-md-6">
               <label >Module heure </label>
               <input class="form-control" type="text" name="nombre_heure_module"  value="<?=$module['nombre_heure']?>" readonly>    
            </div>
            <div class="form-group col-md-6">
               <label >Module</label>
               <input class="form-control" type="text"  value="<?=$module['libelle']?>" readonly>
               <input type="hidden" name="id_module" value="<?=$module['id_module']?>"> 
            </div>
      </div>

      <div class="form-row">
            <div class="form-group col-md-3">
            <?php if(isset($array_error["heureDebut"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["heureDebut"]; ?></div>
             <?php endif; ?>
             <?php if(isset($array_error["heure_debut"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["heure_debut"]; ?></div>
             <?php endif; ?>
               <label >Heure debut</label>
               <input type="time" class="form-control" name="heureDebut" >
            </div>
            
            <div class="form-group col-md-3">
            <?php if(isset($array_error["heurFin"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["heurFin"]; ?></div>
             <?php endif; ?>
             <?php if(isset($array_error["heure_fin"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["heure_fin"]; ?></div>
             <?php endif; ?>
               <label >Heure Fin</label>
               <input type="time" class="form-control" name="heurFin" >
            </div>
            <div class="form-group col-md-6">
            <?php if(isset($array_error["date"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["date"]; ?></div>
             <?php endif; ?>
               <label >Date cours</label>
               <input type="date" class="form-control" name="date_cours"  >
            </div>
      </div>


      <div class="form-row">
      <div class="form-group col-md-6">
      <?php if(isset($array_error["prof"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["prof"]; ?></div>
             <?php endif; ?>
         <label>Professeurs</label>
         
         <select class="form-control" name="prof_id"> 
         <option value ="0" selected disabled>Sélectionner un professeur</option>
            <?php foreach ($profs  as $prof):?>
               <option value="<?= $prof['id'] ?>"><?= $prof['nom'] ?></option>
            <?php endforeach?>
            
         </select>
         
      </div>
            <div class="form-group col-md-6">
            <?php if(isset($array_error["semestre"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["semestre"]; ?></div>
             <?php endif; ?>
               <label >Semestre</label>
               <select class="form-control" name="semestre" >
               <option value ="0" selected disabled>Sélectionner un semestre</option>  
                  <option value="1">Semestre 1</option>
                  <option value="2">Semestre 2</option>
                  <option value="3">Semestre 3</option>
                  <option value="4">Semestre 4</option>
                  <option value="5">Semestre 5</option>
                  <option value="6">Semestre 6</option>
               </select>
            </div>
      </div>


      <div class="form-row">
         <div class="form-group col-md-6" >
         <?php if(isset($array_error["classes"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["classes"]; ?></div>
             <?php endif; ?>
            <label> cochez les classe</label>
               <div class="form-check ">
               <?php foreach ($classes as  $classe):?>
                     <input type="checkbox" class="form-check-input" name="classes[ ]"  value="<?=$classe['id_classe'] ?>">
                     <label class="form-check-label" ><?=$classe['libelle'] ?></label><br>
               <?php  endforeach;?>   
               </div>
         </div>

         
      </div>

      <button type="submit" class="btn btn-success col-12"><h1 class="text-center "> Planifier </h1> </button>
 

   </form>

</div>


