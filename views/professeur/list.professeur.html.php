<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(!Authorisation::estResponsable()){
    Response::redirectUrl("security/visiteur");

}
$title ="Liste des professeurs";
?>



    <div class="container py-5">
        <header class="text-center text-white">
            <h1 class="display-4">Liste des professeurs</h1>

            <p class="font-italic">

            </p>
        </header>
        <div class="row py-5">
            <div class="col-lg-10 mx-auto">
                <div class="card rounded shadow border-0">
                    <div class="card-body p-5 bg-white rounded">
                        <a href="<?php path("professeur/addProfesseur") ?>"><button class="btn btn-warning col-12"><h1 class="text-center "> Ajouter professeur </h1> </button></a>
                        <div class="table-responsive mt-3">
                            <table id="example" style="width:100%" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Email</th>
                                    <th>Grade</th>
                                    <th>Nombre de cours</th>
                                    <th>Numéro</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ( isset( $professeurs ) ) {
                                foreach ($professeurs['data'] as  $professeur):?>

                                <?php @$professeur['liste_cours']=unserialize(base64_decode( $professeur['liste_cours']));

                                    //dd($professeur['liste_cours']);
                                    ?>
                                <tr>
                                    <td><?=strtoupper($professeur['nom'])." ".strtoupper($professeur['prenom']) ?></td>
                                    <td><?=$professeur['email'] ?></td>
                                    <td><?=strtoupper($professeur['grade']) ?></td>

                                    <?php if(empty($professeur['liste_cours'])):?>
                                    <td>0</td>
                                        <?php else: ?>
                                        <td><?=sizeof($professeur['liste_cours']) ?></td>
                                    <?php endif;?>
                                    <td><?=$professeur['numero'] ?></td>
                                    <td>


                                        <a href="<?php path ('cour/list_cour_by_prof/'.$professeur['id'] );?>" class="btn btn-success">voir cours</a>
                                    </td>
                                </tr>
                                <?php  endforeach;
                                } ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    body {
        min-height: 100vh;

        background-color: #FFE53B;
        background-image: linear-gradient(147deg, #FFE53B 0%, #FF2525 100%);
    }
</style>

