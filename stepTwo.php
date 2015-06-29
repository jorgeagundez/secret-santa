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
                        <p class="top_bar"><span class="red">Paso 2 <span class="gray">|</span></span> Reglas del Juego</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="form_step_wrapper red steps">
        <div class="step_wrap">
            <div class="figure trineo"></div>
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
                                <label for="title">Game Title</label>
                                <input type="text" name="title" class="form-control" id="title" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="description">Description</label>
                                <textarea type="text" name="description" class="form-control" id="description" required="true"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="price">Price</label>
                                <input type="text" name="price" class="form-control" id="price" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="gameplace">Place of the game</label>
                                <input type="text" name="gameplace" class="form-control" id="gameplace" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input_wrapper">
                                <label for="gamedate">Date</label>
                                <input type="date" name="gamedate" class="form-control" id="gamedate" required="true"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <br>
                                <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                                <button type="submit" class="btn btn-default">Next Step</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

           <!--  <div class="go_back">
                <a href="/secret_santa/controller/logout.php" class="" ><span class="gray">Reset</span></a></p>
            </div> -->

            <?php 
            include "includes/footer.php";
            ?>