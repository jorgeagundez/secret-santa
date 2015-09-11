<?php 
session_start();


if ( !isset($_SESSION['form_token_step1'])){

  header('Location:/secret_santa/controller/logout.php');

}

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
                        <p class="top_bar"><span class="red">Paso 2 <span class="gray">|</span></span> Datos del Juego</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="form_step_wrapper yellow steps">
        <div class="step_wrap">
            <div class="figure ginger"></div>
            <div class="container">
                <form role="form" class="stepTwo" id="stepTwo" method="post" action="controller/stepTwo.php">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <?php if (isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);}?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="title">Asunto</label>
                                <input type="text" name="title" class="form-control" id="title" required="true" placeholder="Ej: Título del Juego"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="description">Mensaje para tus amigos</label>
                                <textarea type="text" name="description" class="form-control" id="description" required="true" placeholder="Ej: Aquí puedes proponer algunas reglas para el juego, posible precio mínimo de los regalos, lugar si habéis hablado de alguno, posible fecha y todo lo que quieras!"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <br>
                                <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                                <button type="submit" class="btn btn-blue">Comenzar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


            <?php 
            include "includes/footer.php";
            ?>