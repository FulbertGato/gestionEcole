<?php 
use ISM\lib\Session;
//dd($classes);
//verification des erreur de session
$title = "ajout etudiant";
$array_error = [];
if (Session::keyExist("array_error")){
    //recupeeration des erreur de la session dans la variable local
    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error");    
}
?>


    <?php if(isset($array_error["email"])):?>
        <div  class="form-text text-danger ">
        <?= $array_error["email"]; ?></div>
    <?php endif; ?>
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">

            <?php if(isset($array_error["login"])):?>
                <div  class="form-text text-danger ">
                    <?= $array_error["login"]; ?></div>
            <?php endif; ?>
            <div class="card">
                <button class="btn btn-warning col-12"><h1 class="text-center "> Ajouter Un etudiant </h1> </button>
                <form action="<?php path("etudiant/addEtudiant") ?>" method="post">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Nom<span class="text-danger"> *</span></label> <input type="text"  name="nom" placeholder="Entrer le nom de l'etudiant "> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Prenom<span class="text-danger"> *</span></label> <input type="text"  name="prenom" placeholder="Entrer le prenom de l'etudiant"> </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Date naissance<span class="text-danger"> *</span></label> <input type="date"  name="dateNaiss"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex px-3">
                            <label >Sexe</label>
                            <select class="form-control " name="sexe" >
                                <option value="m">Masculin</option>
                                <option value="f">Feminin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3"> Email<span class="text-danger"> *</span></label> <input type="text"  name="email" placeholder="Entrer votre mail"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex px-3">
                            <label >Compétence</label>
                            <select class="form-control" name="competence" >
                                <option value="Maquettage et Prototypage">Maquettage et Prototypage</option>
                                <option value="Intégration web">Intégration web</option>
                                <option value="Réaliser des composants Dynamique avec PHP">Réaliser des composants Dynamique avec PHP</option>
                                <option value="Réaliser des composants d'acces Base de données ">Réaliser des composants d'acces Base de données </option>
                                <option value="Déployer une application">Déployer une application</option>
                                <option value="Gestion de projet Agiles">Gestion de projet Agiles</option>
                                <option value="Versionning">Versionning</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label >Parcours</label>
                            <textarea class="form-control " name="parcours"> </textarea>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex px-3">
                            <label >Classe</label>
                            <select class="form-control" name="classe_id" >
                                <?php if ( isset( $classes ) ) {
                                    foreach ($classes["data"] as  $classe):?>
                                        <option value="<?=$classe['id_classe']?>"> <?=$classe['libelle'] ?>  </option>
                                    <?php  endforeach;
                                } ?>
                            </select>
                        </div>
                    </div>


                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3" >Mot de passe par défaut<span class="text-danger"> *</span></label> <input type="text" value="1234@" name="password" readonly> </div>
                        <div class="form-group col-sm-6 flex-column d-flex px-3">
                            <label >Niveaux</label>
                            <select class="form-control" name="level_classe" >

                                <option value="L1"> Licence 1</option>
                                <option value="L2"> Licence 2 </option>
                                <option value="L3"> Licence 3</option>

                            </select>
                        </div>
                    </div>


                    <div class="row justify-content-end">


                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">Ajouter professeur</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>

    body {
        color: #000;
        overflow-x: hidden;
        height: 100%;
        background-image: url("https://i.imgur.com/GMmCQHC.png");
        background-repeat: no-repeat;
        background-size: 100% 100%
    }

    .card {
        padding: 30px 40px;
        margin-top: 60px;
        margin-bottom: 60px;
        border: none !important;
        box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
    }

    .blue-text {
        color: #00BCD4
    }

    .form-control-label {
        margin-bottom: 0
    }

    input,
    textarea,
    button {
        padding: 8px 15px;
        border-radius: 5px !important;
        margin: 5px 0px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        font-size: 18px !important;
        font-weight: 300
    }

    input:focus,
    textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #00BCD4;
        outline-width: 0;
        font-weight: 400
    }

    .btn-block {
        text-transform: uppercase;
        font-size: 15px !important;
        font-weight: 400;
        height: 43px;
        cursor: pointer
    }

    .btn-block:hover {
        color: #fff !important
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

</style>