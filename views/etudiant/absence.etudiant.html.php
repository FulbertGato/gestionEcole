<?php
$title = "ABSENCE ETUDIANT" ;
?>

<div class="container mt-5">
    <a href="<#"><button class="btn btn-warning col-12"><h1 class="text-center "> Nombre absence <?= \ISM\lib\Session::getSession ("user_connect")['nombre_absence']?></h1> </button></a>
    <div class=" row justify-content-center">


        <table class="table">
            <thead>
            <tr>
                <th>Date absence</th>
                <th>Module</th>
                <th>Semestre</th>
            </tr>
            </thead>
            <?php /** @var TYPE_NAME $modules */
            foreach ($cours as $c):?>



                <tr>

                    <td><?= $c['date_cours']?></td>

                   <?php foreach ($modules as $module):?>
                    <?php if($module['id_module'] == $c['module_id']): ?>
                        <td><?= $module['libelle']?></td>
                           <?php endif?>
                   <?php  endforeach;?>

                    <td>
                        <?= "Semestre ".$c['semestre']?>
                    </td>

                </tr>
            <?php  endforeach;?>
        </table>

    </div>
</div>
