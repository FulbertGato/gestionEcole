<?php

use ISM\lib\Session;

$title = 'add classe';
$array_error = [];
if (Session::keyExist("array_error")){

    $array_error = Session::getSession("array_error");
    Session::destroyKey("array_error");

   // dd($array_error);

}
?>

<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            
            
            <div class="card">
                <h5 class="text-center mb-4">Ajouter une classe </h5>
                <form class="form-card" action="<?php path("classe/addClasse") ?>" method="post">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">LIBELLE DE LA CLASSE <span class="text-danger"> *</span></label> 
                            <input type="text"  name="libelle" placeholder="Entrer libelle "> 
                        </div>
                         <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Choissizez filière<span class="text-danger"> *</span></label> 
                            <select class="form-control mt-2" name="filiere">
                                <option value ="0">Sélectionner une filiere</option>
                                <?php  foreach ($filieres['data'] as $filiere):?>
                                   <option value="<?= $filiere['libelle']?>"><?= $filiere['libelle']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Nombre etudiants autorisé<span class="text-danger"> *</span></label> <input type="number" id="email" name="nombre_etudiant" placeholder="" onblur="validate(3)"> </div>
                        
                    </div>
                    
                    
                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6 tex-center"> <button type="submit" class="btn-block btn-primary ">Ajouter classe</button> </div>
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