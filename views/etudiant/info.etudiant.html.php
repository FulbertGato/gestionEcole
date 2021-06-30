<?php
$title = "Mes infos";

?>


<div class="container">
    <form  action="<?php path ('etudiant/update') ?>" method="post" enctype="multipart/form-data">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?=strtoupper($etudiant['nom'])." ".strtoupper($etudiant['prenom']) ?></h4>
                                    <button class="btn btn-primary"><?=strtoupper($etudiant['matricule']) ?></button>
                                    <button class="btn btn-warning"><?=strtoupper($classe['filiere_libelle']) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <p class="text-secondary mb-1 "><h3 class="text-center"> MA CLASSE </h3></p>

                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg><?=$classe['libelle']." ".$etudiant['level_classe']?></h6>
                                        </li>

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
                                    <input type="text" class="form-control" name="nom" value="<?= $etudiant["nom"]?>" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Prénom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="prenom" value="<?= $etudiant["prenom"]?>" readonly>
                                </div>
                            </div>

                            <hr>


                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="email" value="<?= $etudiant["email"]?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Compétence</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control" name="competence" >
                                        <option value="Maquettage et Prototypage">Maquettage et Prototypage</option>
                                        <option value="Intégration web">Intégration web</option>
                                        <option value="Réaliser des composants Dynamique avec PHP">Réaliser des composants Dynamique avec PHP</option>
                                        <option value="Réaliser des composants d'acces Base de données ">Réaliser des composants d'acces Base de données </option>
                                        <option value="Déployer une application">Déployer une application</option>
                                        <option value="Gestion de projet Agiles">Gestion de projet Agiles</option>
                                        <option value="Versionning">Versionning</option>
                                    </select>
                                    <input type="text" class="form-control" name="id" value="<?= $etudiant["id"]?>" hidden>
                                </div>
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Parcours</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea class="form-control " name="parcours"> </textarea>

                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Avatar</h6>
                                </div>
                                <div class="col-sm-9 text-secondary ">
                                    <input type="file" class="form-control-file" name="avatar">

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