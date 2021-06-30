<?php
$title = "les cours du prof";
//dd($modules);
?>

<div class="container">
    <a href="#"><button class="btn btn-warning col-12"><h1 class="text-center "> Liste des cours de : <?=$prof['nom'].' '.$prof['prenom'] ?></h1></button></a>
<div class="row">
    <?php foreach ($cours as $cour):?>
       <?php @$cour['classe_id_list']=unserialize(base64_decode( $cour['classe_id_list']));?>
    <div class="col-sm-4 mt-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <?= "Date du cours : ".$cour['date_cours'] ?></h5>
                <?php foreach ($modules as $m):?>
                    <?php if($m['id_module'] == $cour['module_id']):?>
                    <p class="card-text">NOM MODULE : <?= $m['libelle'] ?></p>
                <?php endif; ?>
                <?php endforeach?>
                <p class="card-text">NOMBRE DE CLASSE: <?= sizeof ($cour['classe_id_list']) ?></p>
                <?php if($cour['absence_marquer'] == 0):?>
                 <a href="<?php path ('absence/listes_etudiant_cours/'.$cour['id_cour']);?>" class="btn btn-primary text-center">Marquer absence</a>
                <?php else: ?>
                    <p class="card-text">NOMBRE ABSENCE: <?= $cour['nombre_absent'] ?></p>
                    <a href="#" class="btn btn-primary text-center">Absence déja marquer</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach?>
</div>
</div>

