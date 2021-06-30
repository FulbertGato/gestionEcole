<?php
$title ="marquer absence";

//dd($etudiants);


?>

<div class="container">

    <h1 class="text-center text-danger"> MARQUER LES ABSENCES  </h1><br>



<form action="<?php path("absence/listes_etudiant_cours") ?>" method="post">

    <div class="form-group" >
        <label> cochez les absents</label>
        <div class="form-check">
            <?php  foreach ($etudiants as $etudiant):?>
                <input type="checkbox" class="form-check-input" name="id_etu[ ]"  value="<?=$etudiant['id']?>">
                <label class="form-check-label" ><?= $etudiant['nom']." ".$etudiant['prenom']?></label><br>

            <?php  endforeach;?>
        </div>
        <input type="text"  name="id_cour"  value="<?= $id_cour ?>" hidden>
    </div>
    <button type="submit" class="btn btn-primary">valider</button>
</form>
</div>