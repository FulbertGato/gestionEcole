<?php
$title = "Mes infos";
$professeur= \ISM\lib\Session::getSession ("user_connect");

$module_model = new \ISM\models\ModuleModel();
$cours_model = new \ISM\models\CourModel();
@$professeur['liste_cours']=unserialize(base64_decode( $professeur['liste_cours']));
@$professeur['module']=unserialize(base64_decode( $professeur['module']));
//dd($professeur['module']);
$data_cours = $cours_model->selectAll ();
$data_module = $module_model->selectAll ();
?>


<div class="container">
    <form  action="<?= path ('professeur/update') ?>" method="post" enctype="multipart/form-data">
    <div class="main-body">
    

    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?=strtoupper($professeur['nom'])." ".strtoupper($professeur['prenom']) ?></h4>
                      <button class="btn btn-primary"><?=strtoupper($professeur['grade']) ?></button>
                        <?php if(empty($professeur['liste_cours'])):?>
                            <td>0</td>
                        <?php else: ?>
                        <a href="<?= path('cour/list_cour_by_prof/'.$professeur['id']);?>"   class="btn btn-outline-primary"> cours : <?=sizeof($professeur['liste_cours']) ?></a>
                        <?php endif;?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                    <p class="text-secondary mb-1 "><h3 class="text-center"> LISTE MODULES</h3></p>
                    <?php foreach ($professeur['module'] as $module):?>

                    <?php foreach ($data_module ['data'] as $m):?>
                        <?php  if($m['id_module'] == $module):?>
                          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg><?=$m['libelle']?></h6>
                          </li>
                        <?php endif;?>

                    <?php endforeach;?>

                    <?php endforeach;?>
                </ul>
              </div>
            </div>
              <div class="col-lg-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nom</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" name="nom" value="<?= $professeur["nom"]?>" readonly>
                    </div>
                  </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Prénom</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="prenom" value="<?= $professeur["prenom"]?>" readonly>
                        </div>
                    </div>

                  <hr>


                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" name="email" value="<?= $professeur["email"]?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Numéro</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" name="numero" value="<?= $professeur["numero"]?>">
                        <input type="text" class="form-control" name="id" value="<?= $professeur["id"]?>" hidden>
                    </div>
                  </div>
                  <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Mot de passe actuel</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="oldPassword">
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nouveaux mot de passe </h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="newPassword" >
                        </div>
                    </div>
                    <hr>

                  <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary px-4"  > modifier </button>
                    </div>
                  </div>
                </div>
              </div>


          </div>

        </div>
    </form>
    </div>