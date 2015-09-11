<?php 
session_start();

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;

include "includes/header.php";
?>

<body>
    <header>
        <div class="fullwidth_wraper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="top_bar"><span class="red">Paso 1 <span class="gray">|</span></span> Datos de Acceso</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="form_step_wrapper blue steps">
        <div class="step_wrap">
            <div class="figure ciervo"></div>
            <div class="container">
                <form role="form" class="stepOne" id="stepOne" method="post" action="controller/stepOne.php">
                    <div class="col-xs-12">
                        <?php if (isset($_SESSION['error'])){ ?>
                            <div class="row error-wrap">
                                <div class="col-md-12">
                                    <p><i class="fa fa-exclamation-triangle"></i><p>
                                    <p><?php echo  $_SESSION['error']?></p>
                                </div>
                            </div>
                        <?php unset($_SESSION['error']);}?>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="username">Usuario</label>
                                <input type="text" name="username" class="form-control" id="username"  required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="useremail">Email</label>
                                <input type="email" name="useremail" class="form-control" id="useremail" required="true"/>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <br>
                                <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                                <button type="submit" class="btn btn-red">Siguiente Paso</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="go_back">
                <p>*Tienes una cuenta?</p>
                <p>Haz login <a href="/secret_santa/controller/logout.php" class="" ><span class="gray">Aquí</span></a></p>
            </div>
            
        </div>
    </section>

    <section class="container">
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </section>

<?php 
include "includes/footer.php";
?>