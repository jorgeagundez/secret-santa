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
    <header class="fixed">
        <div class="fullwidth_wraper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="top_bar text-capitalize"><span class="red"><?php echo $_SESSION['user_name'] ?><span class="gray">|</span></span> Panel de Control</p>
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
                            <p class="bold"><?php echo $_SESSION['game_description']?>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eu fermentum metus, eu suscipit nisl. Mauris gravida sagittis elementum. Pellentesque vitae fermentum urna. Etiam interdum nisl tortor, vel eleifend urna vulputate eget. Cras viverra ultricies tellus, et maximus ligula bibendum gravida. </p>
                        </div>
                        <div class="datas">
                           <p class="bold white"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Precio Mínimo <span class="blue"><?php echo $_SESSION['game_price']?> &euro; </span></p>
                           <p class="bold white"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Lugar <span class="blue"><?php echo $_SESSION['game_place']?></span></p>
                           <p class="bold white"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Fecha <span class="blue"><?php echo $_SESSION['game_date']?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if(isset($_SESSION['friendname1'])){ for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) { ?>
                    <div class="col-xs-12  col-md-4 col-md-offset-0">
                        <div class="friend-wrap ligthgray">
                            <div class="row">
                                <div class="col-xs-12 name ligthgray05">
                                    <h3>
                                        <span class="text-capitalize blue bold text-center"><?php echo $_SESSION['friendname' . $i] ?></span>
                                        <a class="btn-sm btn pull-right delete-btn" href="<?php '/secret_santa/controller/delete-friend.php?idfriend=' . $_SESSION['idfriend' . $i] . '&number=' . $i ?>">
                                            <span class="glyphicon glyphicon-remove white" aria-hidden="true"></span>
                                        </a>
                                    </h3>
                                </div>
                                 <?php  
                                    $_SESSION['friendinvitation' . $i] = false ;
                                    $_SESSION['friendconfirmation' . $i] = false;
                                ?>
                                <div class="col-xs-12 email">
                                    <p><?php echo $_SESSION['friendemail' . $i] ?></p>
                                    <span class=" glyphicon glyphicon-send blue" aria-hidden="true"></span> 

                                    <?php if($_SESSION['friendinvitation' . $i]) { ?>
                                        <span class="glyphicon glyphicon-ok green" aria-hidden="true"></span>
                                    <?php }else{ ?>
                                        <span class="glyphicon glyphicon-exclamation-sign yellow" aria-hidden="true"></span> 
                                    <?php } ?>

                                    <span class=" glyphicon glyphicon-thumbs-up blue" aria-hidden="true"></span>

                                    <?php if($_SESSION['friendconfirmation' . $i]) { ?>
                                        <span class="glyphicon glyphicon-ok green" aria-hidden="true"></span>
                                    <?php }else{ ?>
                                        <span class="glyphicon glyphicon-exclamation-sign yellow" aria-hidden="true"></span> 
                                    <?php } ?>

                                    <?php if($_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]) { ?>
                                        <a class="btn-sm btn btn-default warning-btn" aria-label="Left Align" href=""><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Recordar</a>
                                    <?php }elseif (!$_SESSION['friendinvitation' . $i] && !$_SESSION['friendconfirmation' . $i]){ ?>
                                        <a class="btn-sm btn btn-default warning-btn" aria-label="Left Align" href=""> Invitar</a>
                                    <?php }elseif ($_SESSION['friendinvitation' . $i] && $_SESSION['friendconfirmation' . $i]){  ?>
                                        <span class="bold green">  READY!</span>
                                    <?php } ?>
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
        <!-- <div class="col-md-12 well">
            <a href="/secret_santa/userPages/update.php" class="btn btn-default" >Update your Details</a>
        </div> -->
        <div class="col-md-12 well">
            <a href="/secret_santa/controller/delete-user.php" class="btn btn-default" >Delete your account</a>
        </div>
        <div class="col-md-12 well">
            <a href="/secret_santa/controller/logout.php" class="btn btn-default" >Logout</a>
        </div>
    </div>

    <?php 
    include "../includes/footer.php";
    ?>