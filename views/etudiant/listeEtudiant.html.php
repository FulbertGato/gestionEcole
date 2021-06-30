<?php
use ISM\lib\Authorisation;
use ISM\lib\Response;
$title="liste etudiants";
if(!Authorisation::estAssistant()){
    Response::redirectUrl("security/visiteur");

}
//dd($etudiants);
?>
<div class="content">
    <div class="container">
    <a href="<?php path("etudiant/addEtudiant") ?>"><button class="btn btn-warning col-12"><h1 class="text-center "> Ajouter etudiant </h1> </button></a>

        <div class="row mt-3">
        <?php foreach ($etudiants['data'] as  $etudiant):?>
            <div class="col-lg-4">
                <div class="text-center card-box">
                    <div class="member-card pt-2 pb-2">
                        <div class="thumb-lg member-thumb mx-auto"><img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="rounded-circle img-thumbnail" alt="profile-image"></div>
                        <div class="">
                            <h4><?=$etudiant['nom']." ".$etudiant['prenom'] ?></h4>
                            <?php foreach ($classes['data'] as  $c):?>
                                <?php if($etudiant['classe_id']== $c['id_classe']):?>
                                 <p class="text-muted"><?=$etudiant['email'] ?><span> | <?=$c['libelle'] ?>  </span></p>
                                <?php endif;?>
                            <?php  endforeach;?>
                        </div>
                        <ul class="social-links list-inline">
                            <li class="list-inline-item"><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                        </ul>
                        <a href="#"><button type="button" class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light">voirs ses absence</button></a>
                      
                        
                    </div>
                </div>
            </div>
            <!-- end col -->
        <?php  endforeach;?> 
          

          
        </div>
        <!-- end row -->
        
    <!-- container -->
</div>














































<style>

body{
    background:#DCDCDC;
    margin-top:20px;
}
.card-box {
    padding: 20px;
    border-radius: 3px;
    margin-bottom: 30px;
    background-color: #fff;
}

.social-links li a {
    border-radius: 50%;
    color: rgba(121, 121, 121, .8);
    display: inline-block;
    height: 30px;
    line-height: 27px;
    border: 2px solid rgba(121, 121, 121, .5);
    text-align: center;
    width: 30px
}

.social-links li a:hover {
    color: #797979;
    border: 2px solid #797979
}
.thumb-lg {
    height: 88px;
    width: 88px;
}
.img-thumbnail {
    padding: .25rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: .25rem;
    max-width: 100%;
    height: auto;
}
.text-pink {
    color: #ff679b!important;
}
.btn-rounded {
    border-radius: 2em;
}
.text-muted {
    color: #98a6ad!important;
}
h4 {
    line-height: 22px;
    font-size: 18px;
}
</style>