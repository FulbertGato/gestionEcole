<?php 

use ism\lib\Session;
use ISM\lib\Authorisation;
use ISM\lib\Response;


$title = 'Page de connexion';
//verification des erreur de session
$array_error = [];
if (Session::keyExist("array_error")){
    //recupeeration des erreur de la session dans la variable local
    
    $array_error = Session::getSession("array_error");
    
    
    Session::destroyKey("array_error");
 
    
    
}

?>
  <body>
    <div class="container mt-5">
    <h3 class="text-center text-info">Connexion</h3>
    <?php if(isset($array_error["error_login"])): ?>
        <div class="alert alert-danger my-2 " role="alert">
            <strong><?= $array_error["error_login"]?></strong>
        </div>
    <?php endif ?>
    <?php if(isset($array_error["error_loginP"])): ?>
        <div class="alert alert-danger my-2 " role="alert">
            <strong><?= $array_error["error_loginP"]?></strong>
        </div>
    <?php endif ?>
    <form method="post"  action="<?php path("etudiant/login")?>">
        <div class="form-group">
            <label>Email address</label>
            <?php if(isset($array_error["email"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["email"]; ?></div>
                <?php endif; ?>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
                
           <?php if(isset($array_error["password"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["password"]; ?></div>
            <?php endif; ?>
            <label >Password</label>
            <input type="password" name="password" class="form-control" >
        </div>
    
       
        
        <button type="submit" class="btn btn-primary btn text-center" >Login</button>
        </form>
    </div>
<?php
