<?php 
session_start();

if(!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You must be logged in to visit this page';
    header('Location:/controller/logout.php');
}

$_SESSION['id_session'] = session_id();


include "../includes/header.php";
?>

<body>
    <header>
        <div class="fullwidth_wraper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="top_bar"><span class="red">Paso 3 <span class="gray">|</span></span> Invita a tus amigos</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="yellow step-three">
        <div class="step_wrap">
            <div class="figure ginger"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="flashback">
                        <p class="bold">Introduce el nombre y correo electronico de tus amigos</p>
                    </div>
                </div>
            </div>
        </div>  
    </section>

     <section class="add-friend yellow">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 d col-sm-6 col-md-4 col-md-offset-0 add-friend-wrap" id="add-friend-wrap">
                    <div class="friend-wrap">
                        <form role="form" class="addFriend" id="addFriend" method="post" action=""> 
                            <input type="text" name="friendname" class="form-control friendname" id="friendname" placeholder="Nombre" required="true"/>
                            <input type="email" name="friendemail" class="form-control friendemail" id="friendemail" placeholder="Correo Electrónico" required="true"/>
                            <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                            <button type="submit" id="addfriend-btn" class="btn-sm btn btn-white" aria-label="Left Align" href=""><span class="glyphicon glyphicon-plus yellow" aria-hidden="true"></span> Añadir</a>
                        </form> 
                    </div>
                </div>
            </div>
            <div class="clearfix visible-xs-block"></div>
        </div>
    </section>
<!-- 
    <div class="go_back">
        <a href="/controller/logout.php" class="" ><span class="gray">Reset</span></a></p>
    </div> -->
    <?php 
    include "../includes/footer.php";
    ?>



