<?php 
session_start();

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;


include "includes/header.php";
?>

<body>
    <header>
        <div class="fullwidth_wraper white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="top_bar"><span class="red">Paso 1 <span class="gray">|</span></span> Rellena tus Datos</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="form_step_wrapper blue steps">
        <div class="step_wrap">
            <div class="step ciervo"></div>
            <div class="container">
                <form role="form" id="stepOne" method="post" action="controller/stepOne.php">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);}?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="username">Usuario</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Elige un nombre de usuario" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Escribe tu email" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="rEmail">Repite Email</label>
                                <input type="email" name="rEmail" class="form-control" id="rEmail" placeholder="Repite tu email" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="rPassword">Repite Password</label>
                                <input type="password" name="rPassword" class="form-control" id="rPassword" placeholder="Password" required="true"/>
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
                <p>Haz login <a href="/secret_santa/index.php" class="" ><span class="gray">Aquí</span></a></p>
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