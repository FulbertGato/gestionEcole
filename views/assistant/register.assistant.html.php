<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(!Authorisation::estAdmin()){
    Response::redirectUrl("security/visiteur");

}
use ISM\lib\Session;
//dd($classes);
//verification des erreur de session
$title = "ajout assistant";
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
<?php if(isset($array_error["login"])):?>
    <div  class="form-text text-danger ">
        <?= $array_error["login"]; ?></div>
<?php endif; ?>
<?php if(isset($array_error["prenom"])):?>
    <div  class="form-text text-danger ">
        <?= $array_error["prenom"]; ?></div>
<?php endif; ?>
<?php if(isset($array_error["nom"])):?>
    <div  class="form-text text-danger ">
        <?= $array_error["nom"]; ?></div>
<?php endif; ?>
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">


            <div class="card">
                <button class="btn btn-warning col-12"><h1 class="text-center "> AJouter assistant </h1> </button>
                <form class="form-card" action="<?php path("assistant/addAssistant") ?>" method="post" >
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Nom<span class="text-danger"> *</span></label> <input type="text"  name="nom" placeholder="Entrer votre nom "> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Last name<span class="text-danger"> *</span></label> <input type="text"  name="prenom" placeholder="Entrer votre prenom"> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3"> Email<span class="text-danger"> *</span></label> <input type="text"  name="email" placeholder="Entrer votre mail"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Numéro téléphone<span class="text-danger"> *</span></label> <input type="text"  name="telephone" placeholder="entrez numero télephone" > </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Date naissance<span class="text-danger"> *</span></label> <input type="date" name="dateNaiss" > </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Pays origine<span class="text-danger"> *</span></label> <input type="text" name="paysOrigine" > </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">Ajouter responsable</button> </div>
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