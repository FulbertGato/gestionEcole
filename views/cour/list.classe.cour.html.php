<?php
$title = "les cours de la classe";
//dd($classe);

?>

<div class="container">
    <a href="#"><button class="btn btn-warning col-12"><h1 class="text-center "> Liste des cours de la  : <?=$classe['data']['libelle']?></h1></button></a>
    <div class="row">
        <?php foreach ($cours as $cour):?>

            <div class="col-sm-4 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> <?= "Date du cours : ".$cour['date_cours'] ?></h5>


                    </div>
                </div>
            </div>
        <?php endforeach?>
    </div>
</div>
