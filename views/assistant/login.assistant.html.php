<?php

use ism\lib\Session;
use ISM\lib\Authorisation;
use ISM\lib\Response;
if(Authorisation::estConnect()){
    Response::redirectUrl("security/visiteur");

}
$title = 'Page de connexion';
//verification des erreur de session
$array_error = [];
if (Session::keyExist("array_error")){
    //recupeeration des erreur de la session dans la variable local

    $array_error = Session::getSession("array_error");

    //dd($array_error);
    //suppression des erreur dans la session
    Session::destroyKey("array_error");
   // Session::destroyKey("role");


}

?>

<body class="my-login-page">




    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">

                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Login</h4>
                            <?php if(isset($array_error["error_login"])): ?>
    <div class="alert alert-danger my-2 " role="alert">
        <strong><?= $array_error["error_login"]?></strong>
    </div>
    <?php endif ?>
    <form method="post"  action="<?php path("assistant/login")?>">
        <div class="form-group">
            <label for="email">E-Mail Address</label>
            <?php if(isset($array_error["email"])): ?>
                <div class="alert alert-danger my-2 " role="alert">
                    <strong><?= $array_error["email"]?></strong>
                </div>
            <?php endif ?>
            <input id="email" type="text" class="form-control" name="email" value="">

        </div>

        <div class="form-group">
            <?php if(isset($array_error["password"])): ?>
                <div class="alert alert-danger my-2 " role="alert">
                    <strong><?= $array_error["password"]?></strong>
                </div>
            <?php endif ?>

            <input id="password" type="password" class="form-control" name="password" >

        </div>

        <div class="form-group">
            <div class="custom-checkbox custom-control">
                <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                <label for="remember" class="custom-control-label">Remember Me</label>
            </div>
        </div>

        <div class="form-group m-0">
            <button type="submit" class="btn btn-primary btn-block">
                Login
            </button>
        </div>

    </form>
    </div>
    </div>
    <div class="footer">
        Copyright &copy; 2021 &mdash; GROUPE ISM
    </div>
    </div>
    </div>
    </div>
    </section>


  </body>

<style>

    html,body {
        height: 100%;
    }

    body.my-login-page {
        background-color: #f7f9fb;
        font-size: 14px;
    }

    .my-login-page .brand {
        width: 90px;
        height: 90px;
        overflow: hidden;
        border-radius: 50%;
        margin: 40px auto;
        box-shadow: 0 4px 8px rgba(0,0,0,.05);
        position: relative;
        z-index: 1;
    }

    .my-login-page .brand img {
        width: 100%;
    }

    .my-login-page .card-wrapper {
        width: 400px;
    }

    .my-login-page .card {
        border-color: transparent;
        box-shadow: 0 4px 8px rgba(0,0,0,.05);
    }

    .my-login-page .card.fat {
        padding: 10px;
    }

    .my-login-page .card .card-title {
        margin-bottom: 30px;
    }

    .my-login-page .form-control {
        border-width: 2.3px;
    }

    .my-login-page .form-group label {
        width: 100%;
    }

    .my-login-page .btn.btn-block {
        padding: 12px 10px;
    }

    .my-login-page .footer {
        margin: 40px 0;
        color: #888;
        text-align: center;
    }

    @media screen and (max-width: 425px) {
        .my-login-page .card-wrapper {
            width: 90%;
            margin: 0 auto;
        }
    }

    @media screen and (max-width: 320px) {
        .my-login-page .card.fat {
            padding: 0;
        }

        .my-login-page .card.fat .card-body {
            padding: 15px;
        }
    }
</style>
