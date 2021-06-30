<?php 
use ISM\lib\Session;
$title = "Page d'inscription";
//verification des erreur de session
$array_error = [];
if (Session::keyExist("array_error")){
    //recupeeration des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error");    
}
?>
      <div class="container mt-5">
      <h1>Inscription</h1>
      <?php if(isset($array_error["login"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["login"]; ?></div>
    <?php endif; ?>
      <form action="<?php path("admin/register") ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" value="<?php
                            echo !isset($array_error["nom"]) && isset($array_post["nom"])?trim($array_post["nom"]):'';?>
                        ">
                        <?php if(isset($array_error["nom"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["nom"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom">
                        <?php if(isset($array_error["prenom"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["prenom"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            
            </div>
            <div class="mb-3">
                <label  class="form-label">Email address</label>
                <input type="text" class="form-control" name="email">
                <?php if(isset($array_error["email"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["email"]; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label  class="form-label">Password</label>
                <input type="password" class="form-control"name="password" >
                <?php if(isset($array_error["password"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["password"]; ?></div>
                <?php endif; ?>
            </div>
            
            
            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Ajouter</button></button>
            </div>
            
        </form>

      </div>
