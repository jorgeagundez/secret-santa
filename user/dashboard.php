<?php 

session_start();

if(!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You must be logged in to visit this page';
    header('Location:/secret_santa/controller/logout.php');
}

$_SESSION['id_session'] = session_id();

include "../controller/dashboard.php";
include "../includes/header.php";
?>
<!-- htmlspecialchars($_SESSION['error']) -->
<body>
    

    <header class="dash_header">
        <div class="fullwidth_wraper">
            <div class="container">
                <div class="row">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default col-xs-12">
                            <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                    <p class="top_bar text-capitalize"><span class="red"><?php echo $_SESSION['user_name'] ?><span class="gray">|</span></span> Panel de Control</p>
                                    <a class="btn settings" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="icon_set glyphicon glyphicon-menu-hamburger blue" aria-hidden="true"></span>
                                    </a>
                                </h4>
                            </div>
                            <nav id="collapseOne" class="panel-collapse collapse mobile_nav" role="tabpanel" aria-labelledby="headingOne">
                                <ul class="list-group">
                                    <li><i class="red fa fa-key"></i><a class="update_account" href="up-pass.php"> Ajustes</a></li>
                                    <li><span class="glyphicon glyphicon-off red" aria-hidden="true"></span><a href="/secret_santa/controller/logout.php"> Salir de la sesión</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if( ($_SESSION['total_confirmed'] == $_SESSION['numberfriends']) && ($_SESSION['numberfriends'] != 0)  && (!$game->getEnded()) ) { ?>
        <section class="group-confirmed">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p>Todos los miembros del grupo han confirmado.</p> 
                        <p><span class="bold green">¿Listo para realizar el sorteo?</span></p>
                        <p><a class="btn make-draw" href="/secret_santa/controller/drawnames.php"><span class="fa fa-magic" aria-hidden="true"></span> Realizar Sorteo</a></p><br/>
                        <p><span class="bold yellow">¿O quizás has olvidado a alguien?</span></p>
                        <p><a class="btn continue" href="#add-friend"><span class="fa fa-plus" aria-hidden="true"></span> Añadir Amigo</a></p>

                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php if( ($game->getEnded()) ) { ?>
        <section class="group-confirmed">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p><span class="bold green">El sorteo ha sido realizado con éxito.<br /> Por favor, consulta tu correo electrónico para averiguar quien te ha tocado!</span></p>
                        <p><span class="bold yellow">Gracias por jugar. Nos vemos a la próxima!</span></p>
                        <a class="btn delete_account" href="/secret_santa/controller/delete-user.php"><span class="glyphicon glyphicon-erase red" aria-hidden="true"></span><span class="red"> Borrar cuenta</span></a>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php if (isset($_SESSION['error'])){ ?>
        <section class="blue ribbon">
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


    <section class="blue ribbon title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="white"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Listado de Amigos</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- MOBILE VERSION -->
    <section id="friends" class="friends">
        <div class="container wrapper">
            <div class="row">
                <?php if (count($allFriends) == 0) { ?>
                    <div class="col-xs-12 d col-sm-6 col-md-4 friend-wrap no-friend" id="">
                        <div class="content-wrapper" >
                            <div class="content-top ligthgray">
                                <i class="icon_status yellow no-move fa fa-exclamation-triangle"></i>        
                                <p class="name bold text-capitalize black" id="">Sin invitaciones enviadas</p> 
                            </div>
                        </div>
                    </div>
                <?php }else{ ?>
                    <?php foreach( $allFriends as $friend ) { ?>
                        <div class="col-xs-12 d col-sm-6 col-md-4 friend-wrap " id="<?php echo $friend->getIdfriend(); ?>">
                            <div class="content-wrapper" >

                                <?php if ($friend->getInvitation() && $friend->getConfirmation()){  ?>
                                    <div class="content-top green02">  
                                <?php }else{ ?>
                                    <div class="content-top ligthgray">  
                                <?php } ?>
                                             
                                    <p class="name bold text-capitalize " id="<?php echo $friend->getFriendname(); ?>"><?php echo $friend->getFriendname(); ?></p> 

                                    <?php 
                                        if ( strlen( $friend->getFriendname() . $friend->getFriendemail()) > 35) {
                                            $rest = substr($friend->getFriendemail(), 0, 23);
                                            $rest = $rest . '...';
                                            echo '<small class="email text-lowercase" id="' . $friend->getFriendemail() . '">(' . $rest . ')</small>';
                                        }else{
                                            echo '<small class="email text-lowercase" id="' . $friend->getFriendemail() . '">(' . $friend->getFriendemail() . ')</small>';
                                        }
                                    ?>
                                    
                                    <?php if (!$friend->getInvitation() && !$friend->getConfirmation()){ ?>
                                        <i class="icon_status yellow fa fa-exclamation-triangle"></i>
                                    <?php }elseif ($friend->getInvitation() && $friend->getConfirmation()){  ?>
                                        <span class="icon_status glyphicon no-move green glyphicon-thumbs-up" aria-hidden="true"></span>
                                    <?php }else{ ?>
                                        <i class="icon_status sky fa fa-clock-o"></i>
                                    <?php } ?>

                                </div>
                                <div class="content-behind">
                                 
                                    <?php if($friend->getInvitation() && !$friend->getConfirmation()) { ?>
                                        <a class="remaind-btn behind-btn" aria-label="Left Align" href="">Recordar</a>
                                        <a class="delete-btn behind-btn" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash white" aria-hidden="true"></span></a> 
                                    <?php }elseif (!$friend->getInvitation() && !$friend->getConfirmation()){ ?>  
                                        <a class="invite-btn behind-btn" aria-label="Left Align" href=""> Invitar</a>
                                        <a class="delete-btn behind-btn" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash white" aria-hidden="true"></span></a>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    <?php } ?><!--  End for -->
                <?php }?><!--  End if -->
 
            </div>
        </div>
    </section>
    
    <?php if( (!$game->getEnded()) ) { ?>
        <a name="add-friend"></a>
        <section class="blue ribbon">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p class="white"><i class="fa fa-arrow-down"></i> Añadir Amigo</p>
                    </div>
                </div>
            </div>
        </section>    
        <section class="add-friend">
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
    <?php } ?>
   

    <section class="blue ribbon">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="white"><span class="glyphicon glyphicon glyphicon-gift" aria-hidden="true"></span> Datos del Juego</p>
                </div>
            </div>
        </div>
    </section>

    <section class="info_area sky">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <h3 class="bold"><em><?php echo $game->getTitle() ?></em></h3>
                        <div class="quotes">
                            <p class="bold"><?php echo $game->getDescription() ?></p>
                        </div>
                        <div class="datas">       
                           <p class="bold white"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Amigos Confirmados: <span class="blue bold total-confirmed"><?php echo $_SESSION['total_confirmed'] ?></span></p>
                           <p class="bold white"><i class="fa fa-clock-o"></i></span> Por Confirmar: <span class="blue bold total-no-confirmed"><?php echo $_SESSION['numberfriends'] - $_SESSION['total_confirmed']; ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php 
    include "../includes/footer.php";
    ?>


   
