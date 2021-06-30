<?php

use ISM\lib\Authorisation;
use ISM\lib\Response;
use ISM\lib\Session;
$array_error = [];
$title= "modifier infos";
if(!Authorisation::estAdmin()  ){
    Response::redirectUrl("security/visiteur");
}

if ( Session ::keyExist ( "array_error" ) ) {

    $array_error = Session ::getSession ( "array_error" );
    Session ::destroyKey ( "array_error" );
}

?>

<div class="container">
    <form  action="<?php path ("responsable/update");?>" method="post" enctype="multipart/form-data">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4><?= /** @var TYPE_NAME $responsable */
                                    $responsable["nom"]?> <?= $responsable["prenom"]?></h4>
                                <p class="text-secondary mb-1"><?= $responsable["email"]?></p>
                                <p class="text-muted font-size-sm"><?= "Matricule: ".$responsable["matricule_responsable"]?></p>
                                <button class="btn btn-primary"><?= $responsable["role"]?></button>

                            </div>
                        </div>
                        <hr class="my-4">

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">nom</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="nom" value="<?= $responsable["nom"]?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">prenom</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="prenom" value="<?= $responsable["prenom"]?>">
                            </div>
                        </div>

                        <?php if ( isset( $array_error[ "login" ] ) ): ?>
                            <div class="form-text text-danger ">
                                <?= $array_error[ "login" ]; ?></div>
                        <?php endif; ?>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control"  name="email" value="<?= $responsable["email"]?>"">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="numeroTelephone" value="<?= $responsable["numeroTelephone"]?>">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">avatar</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="file" class="form-control-file" name="avatar" >
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Pays origine</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="paysOrigine" value="<?= $responsable["paysOrigine"]?>">
                                <input type="hidden" id="id_responsable" name="id" value="<?= $responsable["id_responsable"]?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <button type="submit" class="btn btn-primary px-4"  > modifier </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </form>
</div>

