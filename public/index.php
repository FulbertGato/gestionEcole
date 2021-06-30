<?php
require_once(dirname(__DIR__).DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."constante.php");
require_once(dirname(__DIR__).DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."helper.php");
require_once(dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php");
use \ISM\lib\Router;


$router = new Router();

            
?>



  <!--views -->
  <?php $router-> resolve(); ?>
<!-- views  -->


</div>
</body>