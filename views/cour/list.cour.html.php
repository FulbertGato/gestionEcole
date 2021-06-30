<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(!Authorisation::estResponsable()){
    Response::redirectUrl("security/visiteur");

}
$title ="Liste des cours";

$j=0;
$table_classe=Array();



?>

<div class="main-body">
<div class="container">
<a href="<?php path("module/showAllModule") ?>"><button class="btn btn-warning col-12"><h1 class="text-center "> Programmer un cours </h1> </button></a>



      <div class="row gutters-sm mt-2">
          <?php /** @var TYPE_NAME $cours */
      foreach ($cours['data'] as $cour):?>

         <?php $cour['classe_id_list']=unserialize(base64_decode( $cour['classe_id_list']))?>
        <!-- Recuperation liste claaase -->
        <?php if (isset($classes)) {
              foreach ($classes['data'] as  $classe):?>
                      <?php  if($classe['id_classe']==@$cour['classe_id_list'][$j]):?>
                         <?php  array_push($table_classe,$classe['libelle']) ?>
                         <?php $j++;?>
                      <?php  endif;?>

              <?php  endforeach;
          } ?>
    <!-- Fin -->

        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card border border-success">
            <div class="card-header border-bottom flex-column align-items-start p-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package text-success h3 stroke-width-1 mb-2"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
              <h4 class="text-success font-weight-light mb-2">



              <?php if (isset($modules)) {
                  foreach ($modules['data'] as  $module):?>
                    <?php  if($cour['module_id']==@$module['id_module']):?>
                      <td><?=$module['libelle'] ?></td>
                    <?php  endif;?>
                <?php  endforeach;
              } ?>


            </h4>
              <?php if (!empty($profs)) {
                  foreach ($profs['data'] as  $prof):?>
                    <?php  if($prof['id'] == @$cour['professeur_id']):?>
                        <p class="font-size-sm mb-0"><?= "NOM PROF: ".$prof['nom']." ".$prof['prenom'] ?></p>
                    <?php  endif;?>
                  <?php  endforeach;
              } ?>
            </div>
            <div class="card-header border-bottom justify-content-center py-4">
              <h1 class="pricing-price">
              <?=$cour['date_cours'] ?>
            </div>
            <div class="card-body">
              <ul class="list-unstyled font-size-sm mb-0">
              <?php foreach ($table_classe as  $c):?>
                <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check text-success mr-2"><polyline points="20 6 9 17 4 12"></polyline></svg><strong><?= $c ?></strong></li>
            <?php  endforeach;?>
              </ul>
            </div>
            <div class="card-footer justify-content-center p-3">
                <a href="<?php path ('absence/listes_etudiant_cours/'.$cour['id_cour']);?>"><button class="btn btn-outline-success">Marquer absence</button></a>
            </div>
          </div>
        </div>
        <?php  endforeach;?>

      </div>

    </div>
</div>