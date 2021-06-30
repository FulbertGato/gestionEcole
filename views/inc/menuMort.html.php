<?php 
use ISM\lib\Session;
use ISM\lib\Authorisation;
if(Session::keyExist("user_connect"))
$user=Session::getSession("user_connect");

?>

<nav class="navbar navbar-expand-sm navbar-light bg-info mt-1 mb-4 ">
    <a class="navbar-brand" href="<?php path('security/visiteur') ?>">GESTION DE ISM</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        
        <?php  if(Authorisation::estAdmin()): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('responsable/showAllResponsable')?>">Gerer Responsables</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('assistant/showAllAssistant')?>"> Gerer assistant</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/showInfo/'.$user["id"])?>"> Mes information</a>
            </li>
        <?php  endif; ?> 
        
        <?php  if(Authorisation::estAssistant()): ?>    
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/showInfo/'.$user["id_assistant"])?>"> Mes information</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('etudiant/showAllEtudiant')?>"> Gerer les etudiants</a>
            </li>
        <?php  endif; ?>

        <?php  if(Authorisation::estEtudiant()): ?>    
           <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/showInfo/'.$user["id_etudiant"])?>"> Mes information</a>
            </li>
        <?php  endif; ?>
        
        <?php  if(Authorisation::estResponsable()): ?>    
           <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/showInfo/'.$user["id_responsable"])?>"> Mes information</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php  path('professeur/showAllProfesseur')?>"> Gerer les profs</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php  path('module/showAllModule')?>"> Gerer les modules</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php  path('cour/showAllCours')?>"> Gerer les cours</a>
            </li>
        <?php  endif; ?>
        <?php  if(Authorisation::estProf()): ?>    
           <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/showInfo/'.$user["id"])?>"> Mes information</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php path('cour/list_cour_by_prof/'.$user["id"])?>"> voir mes cours</a>
            </li>
        <?php  endif; ?>
        <?php  if(Authorisation::estConnect()): ?>    
           <li class="nav-item active">
                <a class="nav-link" href="<?php path('security/logout')?>"> Se deconnecter</a>
            </li>
        <?php  endif; ?>
        
        </ul>

        
        
    </div>
</nav>


