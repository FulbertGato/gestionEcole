<?php
$title = 'Home Visiteur';
?>

<div class="container mt-5">
    <h1 class="text-center text-success"> Bienvenue! Veuillez choissir  votre role</h1>
    <div class="row">
        <div class="col-sm-6 text-center">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> Se connecter en tant que Etudiant</h5>
                    <p class="card-text">Vous serrez automatiquement rediriger vers la page de connexion d'Etudiant.</p>

                    <input type="text" readonly class="form-control text-center"  value="Etudiants">
                    <a href="<?php path("etudiant/login")?>"><button type="submit" class="btn btn-primary btn mt-2">Se connecter</button></a>

                </div>
            </div>
        </div>
        <div class="col-sm-6 text-center">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Se connecter en tant que Professeurs</h5>
                    <p class="card-text">Vous serrez automatiquement rediriger vers la page de connexion des professeurs.</p>
                    <input type="text" readonly class="form-control text-center"  value="Professeur">
                    <a href="<?php path("professeur/login")?>"><button type="submit" class="btn btn-primary btn mt-2">Se connecter</button></a>
                </div>
            </div>
        </div>


        <div class="col-sm-6 text-center mt-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> Se connecter en tant que Assistant de classe</h5>
                    <p class="card-text">Vous serrez automatiquement rediriger vers la page de connexion des Responsable de classe</p>
                    <input type="text" readonly class="form-control text-center" value="Assistant Classe">
                    <a href="<?php path("assistant/login")?>"><button type="submit" class="btn btn-primary btn mt-2">Se connecter</button></a>
                   

                </div>
            </div>
        </div>
        <div class="col-sm-6 text-center mt-5 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Se connecter en tant que Responsable pedagogique</h5>
                    <p class="card-text">Vous serrez automatiquement rediriger vers la page de connexion des Responsable pedagogique</p>
                    
                        <input type="text" readonly class="form-control text-center" name="role" value="Responsable pedagogique">
                        <a href="<?php path("responsable/login")?>"><button type="submit" class="btn btn-primary btn mt-2">Se connecter</button></a>
                </div>
            </div>
        </div>
       
    </div>
    <div class="col-sm-12 mt-3 text-center">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Je suis un administrateur</h5>
                    <p class="card-text">Vous serrez automatiquement rediriger vers la page de connexion </p>
                   
                    <input type="text" readonly class="form-control text-center" name="role" value="Administrateur">    
                    <a href="<?php path("admin/login")?>"><button type="submit" class="btn btn-primary btn mt-2">Se connecter</button></a>
                    
                </div>
            </div>
        </div>
</div>
