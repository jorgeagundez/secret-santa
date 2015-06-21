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
                                    <li><span class="glyphicon glyphicon-erase red" aria-hidden="true"></span><a href="/secret_santa/controller/delete-user.php"> Borrar cuenta</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="info_area blue title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="figure engranajecol"></div>
                    <h2 class="white"><span class="bold"><?php echo $_SESSION['game_title']?></span></h2>
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


           <!--  <div class="row">
                <?php if(isset($_SESSION['friendname1'])){ for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) { ?>
                    <div class="col-xs-12  col-sm-6 col-md-4 col-md-offset-0">
                        <div class="friend-wrap ligthgray" id="<?php echo $_SESSION['idfriend' . $i] ?>">
                            <div class="row">
                                <div class="col-xs-12 name ligthgray05" id="<?php echo $_SESSION['friendname' . $i] ?>">
                                    <h3>
                                        <span class="text-capitalize blue bold text-center"><?php echo $_SESSION['friendname' . $i] ?></span>
                                    </h3>
                                </div>
                                 <?php  
                                    // $_SESSION['friendinvitation' . $i] = false ;
                                    // $_SESSION['friendconfirmation' . $i] = false;
                                ?>
                                <div class="col-xs-12 email" id="<?php echo $_SESSION['friendemail' . $i] ?>">
                                    <p><?php echo $_SESSION['friendemail' . $i] ?></p>
                                    
                                    <?php if($_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]) { ?>

                                    <a id="" class="btn-sm btn btn-default warning-btn remaind" aria-label="Left Align" href=""><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Recordar</a>
                                    <a id="" class="btn-sm btn btn-default warning-btn remaind" aria-label="Left Align" href="<?php '/secret_santa/controller/delete-friend.php?idfriend=' . $_SESSION['idfriend' . $i] ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Borrar</a>
                                    
                                    <?php }elseif (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                       
                                    <a id="" class="btn-sm btn btn-default warning-btn invite" aria-label="Left Align" href="">Invitar</a>
                                   
                                    <?php }elseif ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>
                                        
                                    <span class="bold green">  READY!</span>
                                    
                                    <?php } ?>
                                </div>
                            </div>  
                        </div>
                    </div>
                <?php } }?>
            </div> -->
        </div>
    </section>
    <section class="sky friends_section">
        <div class="container wrapper">
            <div class="row ">
                <?php if(isset($_SESSION['friendname1'])){ for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) { ?>
                    <div class="col-xs-12 d col-sm-6 col-md-4 col-md-offset-0 panel-group" id="<?php echo $_SESSION['idfriend' . $i] ?>"  role="tablist" aria-multiselectable="true">
                        <div class="friend-wrap ligthgray panel-default" id="<?php echo $_SESSION['idfriend' . $i] ?>">
                            <div class="row">
                                <div class="name" id="<?php echo $_SESSION['friendname' . $i] ?>">
                                    <div class="col-xs-12 ligthgray05 panel-heading" role="tab" id="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                        <h3 class="panel-title">
                                            <span class="text-capitalize blue bold text-center"><?php echo $_SESSION['friendname' . $i] ?></span>
                                        </h3>
                                        <?php if ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>

                                            <span class="icon_status glyphicon green glyphicon-thumbs-up" aria-hidden="true"></span>
                                            
                                        <?php }else{ ?> 

                                            <span class="icon_status glyphicon yellow glyphicon-thumbs-down" aria-hidden="true"></span>

                                        <?php } ?>
                                        <a class="btn settings" role="button" data-toggle="collapse" data-parent="#<?php echo $_SESSION['idfriend' . $i] ?>" href="#body_<?php echo $_SESSION['friendname' . $i] ?>" aria-expanded="true" aria-controls="body_<?php echo $_SESSION['friendname' . $i] ?>">
                                            <span class="icon_set glyphicon sky glyphicon-cog" aria-hidden="true"></span>
                                        </a>
                                    </div>
                                </div>
                                 <?php  
                                    // $_SESSION['friendinvitation' . $i] = false ;
                                    // $_SESSION['friendconfirmation' . $i] = false;
                                ?>
                                <div class="email" id="<?php echo $_SESSION['friendemail' . $i] ?>">
                                    <div class="col-xs-12 panel-collapse collapse" id="body_<?php echo $_SESSION['friendname' . $i] ?>" role="tabpanel" aria-labelledby="header_<?php echo $_SESSION['friendname' . $i] ?>">
                                        <div class="panel-body">
                                            <p><?php echo $_SESSION['friendemail' . $i] ?></p>
                                            
                                            <?php if($_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]) { ?>

                                            <a id="" class="btn-sm btn btn-default warning-btn remaind" aria-label="Left Align" href=""><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Recordar</a>
                                            <a id="" class="btn-sm btn btn-default warning-btn delete" aria-label="Left Align" href=""><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Borrar</a>
                                            
                                            <?php }elseif (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                               
                                            <a id="" class="btn-sm btn btn-default warning-btn invite" aria-label="Left Align" href="">Invitar</a>
                                           
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

   
    <div class="container">
        <div class="col-md-12 well">
            <div class="detailsWrapper">
                <?php 

                if($_SESSION['groupConfirmed']) {
                    echo 'THIS GROUP HAS BEEN CONFIRMED BY ALL FRIENDS. THE DRAW NAMES HAS BEEN DONE SUCCESSFULLY';
                    echo '<br/><br/>';
                }

                ?>

            </div>
        </div>
        <div class="col-md-12">
            <?php if (isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);}?>
            <?php if (isset($_SESSION['info'])){ echo $_SESSION['info']; unset($_SESSION['info']);}?>
            <?php if (isset($error)){ echo $error; unset($error);}?>
        </div>

       
  
    </div>

   

    <button class="btn btn-default" id="activator">Here</button>
    
    <div id="result">
        <?php // include('../controller/ajax/consulta.php'); ?>
    </div>

        <script>

       




        </script>




    


    

    <?php 
    include "../includes/footer.php";
    ?>


   
