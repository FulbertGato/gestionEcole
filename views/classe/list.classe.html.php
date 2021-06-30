<?php

use ISM\lib\Authorisation;

$title = 'all classes';

//dd($classes);

?>

<div class="content">
    <div class="container">

        <?php if( Authorisation::estResponsable ()):?>
        <a href="<?php path("etudiant/addClass") ?>"><button class="btn btn-warning col-12"><h1 class="text-center "> Ajouter une classe </h1> </button></a>
        <?php endif;?>
        <div class="row mt-3">
            <?php if ( isset( $classes ) ) {
                foreach ($classes['data'] as  $classe):?>
                    <div class="col-lg-4">
                        <div class="text-center card-box">
                            <div class="member-card pt-2 pb-2">
                                <div class="">
                                    <h4><?=$classe['libelle'] ?></h4>
                                            <p class="text-muted"><?="nombre etudiant: ".$classe['nombre_etudiant'] ?></p>
                                </div>

                                <a href="<?php path("etudiant/listEtudiantByClass/".$classe['id_classe']) ?>"><button type="button" class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light">voirs la liste etudiants</button></a>
                                <a href="<?php path("cour/list_cour_by_classe/".$classe['id_classe']) ?>"><button type="button" class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light">voirs cours de la classes</button></a>


                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                <?php  endforeach;
            } ?>



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
