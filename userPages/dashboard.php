<?php 

session_start();

if(!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You must be logged in to visit this page';
    header('Location:/secret_santa/index.php');
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
                                    <li><span class="glyphicon glyphicon-off red" aria-hidden="true"></span><a href="/secret_santa/controller/logout.php"> Salir</a></li>
                                    <li><span class="glyphicon glyphicon-erase red" aria-hidden="true"></span><a class="delete_account" href="/secret_santa/controller/delete-user.php"> Borrar cuenta</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php //$_SESSION['groupConfirmed'] = 1 ;?>

    <section class="info_area blue title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="figure_small engranajecol"></div>
                    <h3 class="white"><span class="bold text-capitalize">Juego de <?php echo $_SESSION['user_name']?></span></h3>
                     <?php if(!$_SESSION['groupConfirmed']) { ?>
                            <!-- <p class="white">Total Amigos: <span class="sky bold"><?php echo $_SESSION['numberfriends'] ?></span><br/> -->
                            <p class="white">Amigos confirmados: <span class="green bold"><?php echo $_SESSION['total_confirmed'] ?></span><br/>
                            Por confirmar: <span class="sky bold"><?php echo $_SESSION['numberfriends'] - $_SESSION['total_confirmed']  ?></span></p>
                    <?php }else{ ?>
                            <p class="white">Este grupo <span class="bold yellow">ha sido confirmado</span> por todos sus miembros. El <span class="bold green">sorteo</span> de nombres se ha <span class="bold green">realizado con éxito</span>, no olvides consultar tu correo electrónico para ver el resultado.</p>
                            <a class="red btn delete_account" href=""><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Borrar cuenta</a>
                    <?php } ?>
                   
                </div>
            </div>
        </div>
    </section>

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

    <!-- MOBILE VERSION -->
    <section class="white friends_section">
        <div class="container wrapper">
            <div class="row ">
                <?php if(isset($_SESSION['friendname1'])){ for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) { ?>
                <?php  
                    // $_SESSION['friendinvitation' . $i] = false ;
                    // $_SESSION['friendconfirmation' . $i] = false;
                ?>
                    <div class="col-xs-12 d col-sm-6 col-md-4 col-md-offset-0 panel-group" id="<?php echo $_SESSION['idfriend' . $i] ?>"  role="tablist" aria-multiselectable="true">
                        <div class="friend-wrap ligthgray panel-default" id="<?php echo $_SESSION['idfriend' . $i] ?>">
                            <div class="row">
                                <div class="name" id="<?php echo $_SESSION['friendname' . $i] ?>">
                                    <?php if (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                    <div class="col-xs-12 yellow05 panel-heading" role="tab" id="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                    <?php }elseif($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){ ?>
                                    <div class="col-xs-12 green05 panel-heading" role="tab" id="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                    <?php }else{ ?>
                                    <div class="col-xs-12 ligthgray05 panel-heading" role="tab" id="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                    <?php } ?>
                                        <a class="btn panel-title" role="button" data-toggle="collapse" data-parent="#<?php echo $_SESSION['idfriend' . $i] ?>" href="#body_<?php echo $_SESSION['friendname' . $i] ?>" aria-expanded="true" aria-controls="body_<?php echo $_SESSION['friendname' . $i] ?>">
                                            <span class=" bold text-capitalize"><?php echo $_SESSION['friendname' . $i] ?></span> - 
                                            <small class="text-lowercase"><?php echo $_SESSION['friendemail' . $i] ?></small>
                                            <?php if (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                                <i class="icon_status yellow fa fa-exclamation-triangle"></i>
                                            <?php }elseif ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>
                                                <span class="icon_status glyphicon green glyphicon-thumbs-up" aria-hidden="true"></span>
                                            <?php }else{ ?>
                                                <i class="icon_status sky fa fa-question-circle"></i>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="email" id="<?php echo $_SESSION['friendemail' . $i] ?>">
                                    <div class="col-xs-12 panel-collapse collapse" id="body_<?php echo $_SESSION['friendname' . $i] ?>" role="tabpanel" aria-labelledby="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                        <div class="panel-body">
                                         
                                            <?php if($_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]) { ?>

                                            <a id="" class="remaind" aria-label="Left Align" href=""><span class="glyphicon glyphicon-time yellow" aria-hidden="true"></span> Recordar</a>
                                            <a id="" class="delete" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash red" aria-hidden="true"></span> Borrar</a>
                                            
                                            <?php }elseif (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                               
                                            <a id="" class="invite" aria-label="Left Align" href=""><span class="glyphicon glyphicon-send yellow" aria-hidden="true"></span> Invitar</a>
                                           
                                            <?php }elseif ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>
                                                
                                            <p class="bold green ready">&iexcl;<?php echo $_SESSION['friendname' . $i] ?> ha confirmado!</p>
                                            
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } }?>
            </div>
        </div>
    </section>


    <!-- DESKTOP VERSION -->
    <!-- <section class="white friends_section">
        <div class="container wrapper">
            <div class="row ">
                <?php if(isset($_SESSION['friendname1'])){ for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) { ?>
                <?php  
                    // $_SESSION['friendinvitation' . $i] = false ;
                    // $_SESSION['friendconfirmation' . $i] = false;
                ?>
                    <div class="col-xs-12 d col-sm-6 col-md-4 col-md-offset-0 panel-group" id="<?php echo $_SESSION['idfriend' . $i] ?>"  role="tablist" aria-multiselectable="true">
                        <div class="friend-wrap ligthgray panel-default" id="<?php echo $_SESSION['idfriend' . $i] ?>">
                            <div class="row">
                                <div class="name" id="<?php echo $_SESSION['friendname' . $i] ?>">
                                    <?php if (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                    <div class="col-xs-12 yellow05 panel-heading" role="tab" id="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                    <?php }elseif($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){ ?>
                                    <div class="col-xs-12 green05 panel-heading" role="tab" id="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                    <?php }else{ ?>
                                    <div class="col-xs-12 ligthgray05 panel-heading" role="tab" id="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                    <?php } ?>
                                        <a class="btn panel-title" role="button" data-toggle="collapse" data-parent="#<?php echo $_SESSION['idfriend' . $i] ?>" href="#body_<?php echo $_SESSION['friendname' . $i] ?>" aria-expanded="true" aria-controls="body_<?php echo $_SESSION['friendname' . $i] ?>">
                                            <span class=" bold text-capitalize"><?php echo $_SESSION['friendname' . $i] ?></span> - 
                                            <small class="text-lowercase"><?php echo $_SESSION['friendemail' . $i] ?></small>
                                            <?php if (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                                <i class="icon_status yellow fa fa-exclamation-triangle"></i>
                                            <?php }elseif ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>
                                                <span class="icon_status glyphicon green glyphicon-thumbs-up" aria-hidden="true"></span>
                                            <?php }else{ ?>
                                                <i class="icon_status sky fa fa-question-circle"></i>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="email" id="<?php echo $_SESSION['friendemail' . $i] ?>">
                                    <div class="col-xs-12 panel-collapse collapse" id="body_<?php echo $_SESSION['friendname' . $i] ?>" role="tabpanel" aria-labelledby="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                        <div class="panel-body">
                                         
                                            <?php if($_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]) { ?>

                                            <a id="" class="remaind" aria-label="Left Align" href=""><span class="glyphicon glyphicon-time yellow" aria-hidden="true"></span> Recordar</a>
                                            <a id="" class="delete" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash red" aria-hidden="true"></span> Borrar</a>
                                            
                                            <?php }elseif (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                               
                                            <a id="" class="invite" aria-label="Left Align" href=""><span class="glyphicon glyphicon-send yellow" aria-hidden="true"></span> Invitar</a>
                                           
                                            <?php }elseif ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>
                                                
                                            <p class="bold green ready">&iexcl;<?php echo $_SESSION['friendname' . $i] ?> ha confirmado!</p>
                                            
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } }?>
            </div>
        </div>
    </section> -->

    <section class="add-friend white">
        <div class="col-xs-12 d col-sm-6 col-md-4 col-md-offset-0 panel-group add-friend-wrap" id="add-friend-wrap"  role="tablist" aria-multiselectable="true">
            <div class="friend-wrap ligthgray panel-default" id="">
                <div class="row">
                    <div class="col-xs-12 ligthgray05 panel-heading name" role="tab" id="header_add-friend">
                        <h3 class="panel-title">
                            <span class="text-capitalize sky bold text-center">Añadir amigo</span>
                        </h3>
                        <a class="btn settings" role="button" data-toggle="collapse" data-parent="#add-friend-wrap" href="#body_add-friend" aria-expanded="true" aria-controls="body_add-friend">
                            <span class="icon_set sky glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div class="col-xs-12 panel-collapse collapse" id="body_add-friend" role="tabpanel" aria-labelledby="header_add-friend">
                        <div class="panel-body">
                            <form role="form" class="add-friend" id="addFriend" method="post" action=""> 
                                <input type="text" name="friendname" class="form-control friendname" id="friendname" placeholder="Nombre" required="true"/>
                                <input type="email" name="friendemail" class="form-control friendemail" id="friendemail" placeholder="Correo Electrónico" required="true"/>
                                <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                                <button type="submit" id="" class="btn-sm btn btn-default warning-btn add" aria-label="Left Align" href=""><span class="glyphicon glyphicon-plus green" aria-hidden="true"></span> Añadir</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="info_area sky">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <div class="quotes">
                            <p class="bold"><?php echo $_SESSION['game_description']?></p>
                        </div>
                        <div class="datas">
                           <p class="bold white"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Precio Mínimo <span class="blue"><?php echo $_SESSION['game_price']?> &euro; </span></p>
                           <p class="bold white"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Lugar <span class="blue"><?php echo $_SESSION['game_place']?></span></p>
                           <p class="bold white"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Fecha <span class="blue"><?php echo $_SESSION['game_date']?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sky">
    <button class="btn btn-default" id="activator">Test</button>
    </div>

    <?php 
    include "../includes/footer.php";
    ?>


   
