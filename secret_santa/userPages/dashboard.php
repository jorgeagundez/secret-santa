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
     <header>
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

    <section class="info_area blue ">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="figure engranajecol"></div>
                     <h2 class="white quotes"><span class="bold"><?php echo $_SESSION['game_title']?></span></h2>
                </div>
            </div>
        </div>
    </section>


    <section class="info_area white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                     <div class="game_data text-left">
                        <table class="table datas">
                            <tbody>
                                <tr>
                                    <td>Usuario:</td>
                                    <td><span class="bold"><?php echo $_SESSION['user_name']?></span></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><span class="bold"><?php echo $_SESSION['user_email']?></span></td>
                                </tr>
                                <tr>
                                    <td>Descripción:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><span class="bold"><?php echo $_SESSION['game_description']?></span></td>
                                    <td></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <div class="container">
        <div class="col-md-12 well">
            <div class="detailsWrapper">
                <?php 

                echo '<h2>User</h2>';

                echo ( '<strong>Id Admin User</strong>:' . $_SESSION['user_id'] . '<br/>' 
                    . '<strong>User Name</strong>: ' . $_SESSION['user_name'] . '<br/>'
                    . '<strong>User Email</strong>: ' . $_SESSION['user_email']);

                echo '<br/>';
                echo '<br/>';

                echo '<h2>Game Details</h2>';

                if(isset($_SESSION['game_id'])) {
                    echo ('<strong>Game Id</strong>:' . $_SESSION['game_id'] . '<br/>' 
                        . '<strong>Game Title</strong>: ' . $_SESSION['game_title']  . '<br/>' 
                        . '<strong>Description</strong>: ' . $_SESSION['game_description']  . '<br/>' 
                        . '<strong>Price</strong>: ' . $_SESSION['game_price']  . '<br/>' 
                        . '<strong>Place</strong>: ' . $_SESSION['game_place'] . '<br/>' 
                        . '<strong>Game Date</strong>: ' . $_SESSION['game_date'] . '<br/>' 
                        . '<strong>Draw Date</strong>: ' . $_SESSION['game_drawdate'] . '<br/>' 
                        . '<strong>Num of Friends</strong>: ' . $_SESSION['numberfriends']);
                }

                echo '<br/>';
                echo '<br/>';

                echo '<h2>Friends List: (' . $_SESSION['numberfriends'] . ')</h2>';


                if(isset($_SESSION['friendname1'])){
                    for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) {
                        echo $i;
                        echo '<br/>';
                        echo '<strong>Name</strong>: ' . $_SESSION['friendname' . $i] . ' <strong>Email</strong>: ' . $_SESSION['friendemail' . $i] . '<br/>';
                        echo '<strong>Invitation is sent</strong>: ' .$_SESSION['friendinvitation' . $i]. '<br/>';
                        echo '<strong>Invitation is confirmed</strong>: ' .$_SESSION['friendconfirmation' . $i]. '<br/>';
                        echo '<a href="/secret_santa/controller/delete-friend.php?idfriend=' . $_SESSION['idfriend' . $i] . '&number=' . $i . '">Delete friend</a>';
                        echo '<br/><br/>';
                    }
                }

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