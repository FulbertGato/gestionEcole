<?php
$title="Liste filiere";








?>

<div class="container mt-5">
    <a href="<?php path("filiere/add_filiere") ?>"><button class="btn btn-warning col-12"><h1 class="text-center "> Ajouter Filieres </h1> </button></a>

    <div class=" row justify-content-center">


        <table class="table">
            <thead>
            <tr>
                <th>Libelle</th>

                <th colspan="2">Action</th>
            </tr>
            </thead>
            <?php if ( ! empty( $filieres ) ) {
                foreach ($filieres['data'] as  $filiere):?>



                    <tr>

                        <td><?= $filiere['libelle']?></td>



                        <td>
                            <a href="#" class="btn btn-info">Modifier</a>
                            <a href="#" class="btn btn-danger">Supprimer</a>

                        </td>

                    </tr>
                <?php  endforeach;
            } ?>
        </table>

    </div>
</div>
