<?php 
use ISM\lib\Session;
use ISM\lib\Authorisation;
if(Session::keyExist("user_connect"))
$user=Session::getSession("user_connect");

?>
<?php  if(Authorisation::estConnect()): ?>

    <!--  Toggle button -->
      <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small>
    </button>
<!-- Vertical navbar -->
<div class="vertical-nav bg-white" id="sidebar">
  <div class="py-4 px-3 mb-4 bg-light">
    <div class="media d-flex align-items-center"><img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
      <div class="media-body">
        <h4 class="m-0"><?= $user['nom']?></h4>
        
      </div>
    </div>
  </div>
  <?php  if(Authorisation::estAdmin()): ?>
  <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Administrateur</p>

  <ul class="nav flex-column bg-white mb-0">
     <!-- DEbut Menu administrateur-->
        
            <li class="nav-item">
                <a href="<?php path('security/showInfo/'.$user["id"])?>" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Mes informations
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php path('responsable/showAllResponsable')?>" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Gerer les  Responsables
                    </a>
            </li>
            <li class="nav-item">
                <a href="<?php path('assistant/showAllAssistant')?>" class="nav-link text-dark font-italic bg-light">
                        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                        Gerer les assistant
                    </a>
            </li>
  </ul>
  <?php  endif; ?> 
   <!-- Fin Menu administrateur-->

   <!-- Debut Menu Assistant-->
   <?php  if(Authorisation::estAssistant()): ?>   
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Assistant</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
        <a href="<?php path('security/showInfo/'.$user["id_assistant"])?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                    Mes informations
                </a>
        </li>
        <li class="nav-item">
        <a href="<?php path('etudiant/showAllEtudiant')?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                    Gerer les etudians
                </a>
        </li>

        <li class="nav-item">
            <a href="<?php  path('classe/show_all_classe')?>" class="nav-link text-dark font-italic">
                <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                voirs les classes
            </a>
        </li>
    </ul>
<?php  endif; ?> 
 <!-- Fin Menu Assistant-->

 <!-- Debut Menu Responsable-->
<?php  if(Authorisation::estResponsable()): ?> 

    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Responsable</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
        <a href="<?php path('security/showInfo/'.$user["id_responsable"])?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                    Mes informations
                </a>
        </li>
        <li class="nav-item">
        <a href="<?php  path('professeur/showAllProfesseur')?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                    Gerer les professeurs
                </a>
        </li>

        <li class="nav-item">
        <a href="<?php  path('module/showAllModule')?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                    Gerer les modules
                </a>
        </li>

        <li class="nav-item">
        <a href="<?php  path('cour/showAllCours')?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                    Gerer les cours
                </a>
        </li>

        <li class="nav-item">
            <a href="<?php  path('filiere/show_all_filiere')?>" class="nav-link text-dark font-italic">
                <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                Gerer les filiere
            </a>
        </li>


        <li class="nav-item">
            <a href="<?php  path('classe/show_all_classe')?>" class="nav-link text-dark font-italic">
                <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                Gerer les classes
            </a>
        </li>
    </ul>


<?php  endif; ?> 
<!-- End menu responsable -->

  <!-- Debut Menu etudiant-->
  <?php  if(Authorisation::estEtudiant()): ?>   
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Etudiant</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
             <a href="<?php path('security/showInfo/'.$user["id"])?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                    Mes informations
             </a>
        </li>


        <li class="nav-item">
            <a href="<?php path('cour/list_cour_by_classe/'.$user['classe_id'])?>" class="nav-link text-dark font-italic">
                <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                Mes cours
            </a>
        </li>


        <li class="nav-item">
            <a href="<?= path ("absence/mes_absences"); ?>" class="nav-link text-dark font-italic">
                <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                Mes Absences
            </a>
        </li>
        
    </ul>
<?php  endif; ?> 
 <!-- Fin Menu Etudiant-->


 <!-- Debut Menu professeur-->
 <?php  if(Authorisation::estProf()): ?>
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">professeur</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
             <a href="<?php path('security/showInfo/'.$user["id"])?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                    Mes informations
                </a>
        </li>

        <li class="nav-item">
               <a href="<?php path('cour/list_cour_by_prof/'.$user["id"])?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                    Mes cours
                </a>
        </li>
        <li class="nav-item">
               <a href="<?php path('classe/show_all_classe')?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                    Voirs les classes
                </a>
        </li>




    </ul>
<?php  endif; ?> 
 <!-- Fin Menu profeseur -->

 <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
             <a href="<?php path('security/logout')?>" class="nav-link text-dark font-italic">
                    <i class="fa fa-area-chart mr-3 text-primary fa-logout"></i>
                    Se deconnecter
                </a>
        </li>

       
        
    </ul>
</div>
<!-- End vertical navbar -->
<?php  endif; ?>

<!-- Page content holder -->
<script>
$(function() {
  // Sidebar toggle behavior
  $('#sidebarCollapse').on('click', function() {
    $('#sidebar, #content').toggleClass('active');
  });
});
</script>
