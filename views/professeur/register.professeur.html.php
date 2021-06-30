<?php 
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(!Authorisation::estResponsable()){
    Response::redirectUrl("security/visiteur");

}
use ISM\lib\Session;
$title = "ajout professeur";
$array_error = [];
if (Session::keyExist("array_error")){

    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error");    
}
?>



<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">

            <?php if(isset($array_error["login"])):?>
                <div  class="form-text text-danger ">
                    <?= $array_error["login"]; ?></div>
            <?php endif; ?>
            <div class="card">
                <button class="btn btn-warning col-12"><h1 class="text-center "> Ajouter Professeur </h1> </button>
                <form action="<?php path("professeur/addProfesseur") ?>" method="post">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Nom<span class="text-danger"> *</span></label> <input type="text"  name="nom" placeholder="Entrer le nom du professeur "> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Prenom<span class="text-danger"> *</span></label> <input type="text"  name="prenom" placeholder="Entrer le prenom du professeur"> </div>
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
                            <label >son grade</label>
                            <select class="form-control" name="grade" >
                                <option value="Ingénieur">Ingénieur</option>
                                <option value="Docteur">Docteur</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Numéro téléphone<span class="text-danger"> *</span></label> <input type="text" name="telephone" > </div>
                        <div class="form-group col-sm-6 flex-column d-flex px-3">
                            <label >Pays Origine</label>
                            <select class="form-control" name="paysOrigine" >
                                <option value="Sénégal">Sénégal</option>
                                <option value="Mali">Mali</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Togo">Togo</option>
                                <option value="Benin">Bénin</option>
                                <option value="cote ivoir">Cote d'ivoir</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Autre">Autres</option>
                            </select>
                        </div>
                    </div>


                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3" >Mot de passe par défaut<span class="text-danger"> *</span></label> <input type="text" value="1234@" name="password" readonly> </div>
                        <div class="form-group col-sm-6 flex-column d-flex px-3">
                            <label ><h5>Cochez modules du prof</h5></label>
                            <div class="form-check">
                                <?php if ( isset( $modules ) ) {
                                    foreach ($modules["data"] as  $module):?>
                                        <input type="checkbox" class="form-check-input" name="module[ ]"  value="<?=$module['id_module'] ?>">
                                        <label class="form-check-label" ><?=$module['libelle'] ?></label><br>
                                    <?php  endforeach;
                                } ?>
                            </div>
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

 