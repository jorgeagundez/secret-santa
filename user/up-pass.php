<?php 
session_start();

if(!isset($_SESSION['user_id'])) {
  $_SESSION['error'] = 'You must be logged in to visit this page';
  header('Location:/index.php');
}else if($_SESSION['id_session'] != session_id()) {
  $_SESSION['error'] = 'There was a mistake in the session, please, login again';
  header('Location:/index.php');;
}

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;


include "../includes/header.php";
?>

<body>

    <header class="dash_header">
        <div class="fullwidth_wraper">
            <div class="container">
                <div class="row">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default col-xs-12">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <p class="top_bar text-capitalize"><span class="red"><?php echo $_SESSION['user_name'] ?><span class="gray">|</span></span> Ajustes</p>
                                    <a class="btn settings" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="icon_set glyphicon glyphicon-menu-hamburger blue" aria-hidden="true"></span>
                                    </a>
                                </h4>
                            </div>
                            <nav id="collapseOne" class="panel-collapse collapse mobile_nav" role="tabpanel" aria-labelledby="headingOne">
                                <ul class="list-group">
                                    <li><span class="glyphicon glyphicon-off red" aria-hidden="true"></span><a href="dashboard.php"> Panel de Control</a></li>
                                    <li><span class="glyphicon glyphicon-off red" aria-hidden="true"></span><a href="/controller/logout.php"> Salir de la sesión</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="blue ribbon title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="white"><span class="glyphicon glyphicon-user"></span> Cambio de Contraseña</p>
                </div>
            </div>
        </div>
    </section>

    <?php if (isset($_SESSION['error'])){ ?>
        <section class=" ribbon">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p class="red">
                            <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php if (isset($_SESSION['info'])){ ?>
        <section class="ligthgray ribbon">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p class="green">
                            <?php 
                                echo $_SESSION['info'];
                                unset($_SESSION['info']);
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <section class="add-friend">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 d col-sm-6 col-md-4 col-md-offset-0 add-friend-wrap" id="add-friend-wrap">
                    <div class="friend-wrap">
                        <form role="form" id="update_form" method="post" action="../controller/upd.php">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Escriba su nueva contraseña" required="true"/>
                            <input type="password" name="rPassword" class="form-control" id="rPassword" placeholder="Repita la contraseña" required="true"/>
                            <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                            <button type="submit" class="btn-sm btn btn-white"><i class="fa fa-refresh sky"></i> Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-xs-block"></div>
        </div>
    </section>

    <section class="red ribbon">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="white">
                        <span class="glyphicon glyphicon-erase" aria-hidden="true"></span>
                        Borrar Cuenta
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="add-friend">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 d col-sm-6 col-md-4 col-md-offset-0 add-friend-wrap" id="add-friend-wrap">
                    <div class="friend-wrap">
                        <p class="text-center">Para borrar su cuenta de forma permanente, por favor, pulse el siguiente enlace.</p>
                        <a class="btn delete_account" href="/controller/delete-user.php"><span class="glyphicon glyphicon-erase red" aria-hidden="true"></span> Borrar cuenta</a>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-xs-block"></div>
        </div>
    </section>







   


<?php 
include "../includes/footer.php";
?>