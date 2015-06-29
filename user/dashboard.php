<?php 

session_start();

if(!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You must be logged in to visit this page';
    header('Location:/index.php');
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
                                    <li><span class="glyphicon glyphicon-off red" aria-hidden="true"></span><a href="/controller/logout.php"> Salir</a></li>
                                    <li><span class="glyphicon glyphicon-erase red" aria-hidden="true"></span><a class="delete_account" href="/controller/delete-user.php"> Borrar cuenta</a></li>
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
                <div class="col-xs-4 col-md-6">
                    <div class="figure_small engranajecol"></div>
                </div>
                <div class="col-xs-8 col-md-6"></div>
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
    <section class="friends">
        <div class="container wrapper">
            <div class="row ">
                <?php if(isset($_SESSION['friendname1'])){ for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) { ?>
                <?php  
                    // $_SESSION['friendinvitation' . $i] = false ;
                    // $_SESSION['friendconfirmation' . $i] = false;
                ?>
                    <div class="col-xs-12 d col-sm-6 col-md-4 friend-wrap " id="<?php echo $_SESSION['idfriend' . $i] ?>">
                        <div class="content-wrapper" >

                        
                            <?php if ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>
                                <div class="content-top green02">  
                            <?php }else{ ?>
                                <div class="content-top ligthgray">  
                            <?php } ?>
                                         
                                <p class="name bold text-capitalize " id="<?php echo $_SESSION['friendname' . $i] ?>"><?php echo $_SESSION['friendname' . $i] ?></p> 

                                <?php 
                                    if ( strlen($_SESSION['friendname' . $i] . $_SESSION['friendemail' . $i]) > 35) {
                                        $rest = substr($_SESSION['friendemail' . $i], 0, 23);
                                        $rest = $rest . '...';
                                        echo '<small class="email text-lowercase" id="' . $_SESSION['friendemail' . $i] . '">(' . $rest . ')</small>';
                                    }else{
                                        echo '<small class="email text-lowercase" id="' . $_SESSION['friendemail' . $i] . '">(' . $_SESSION['friendemail' . $i] . ')</small>';
                                    }
                                ?>
                                
                                <?php if (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                    <i class="icon_status yellow fa fa-exclamation-triangle"></i>
                                <?php }elseif ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>
                                    <span class="icon_status glyphicon green glyphicon-thumbs-up" aria-hidden="true"></span>
                                <?php }else{ ?>
                                    <i class="icon_status sky fa fa-question-circle"></i>
                                <?php } ?>

                            </div>
                            <div class="content-behind">
                             
                                <?php if($_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]) { ?>
                                    <a class="remaind-btn behind-btn" aria-label="Left Align" href="">Recordar</a>
                                    <a class="delete-btn behind-btn" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash white" aria-hidden="true"></span></a> 
                                <?php }elseif (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>  
                                    <a class="invite-btn behind-btn" aria-label="Left Align" href=""> Invitar</a>
                                    <a class="delete-btn behind-btn" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash white" aria-hidden="true"></span></a>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                <?php } }?>
            </div>
        </div>
    </section>
    

    <section class="blue ribbon">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="white"><span class="glyphicon glyphicon-user"></span> Añadir Amigo</p>
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

    <section class="blue ribbon">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="white"><span class="glyphicon glyphicon-gift"></span>
                        Datos del Juego
                    </p>
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
                            <h3 class="bold"><?php echo $_SESSION['game_title']?></h3>
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

    <?php 
    include "../includes/footer.php";
    ?>


   
