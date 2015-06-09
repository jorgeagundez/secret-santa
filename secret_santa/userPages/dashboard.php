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
        </div>
    </section>

    <section class="info_area ligthgray">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table">
                        <thead>
                            <tr>
                               
                                <th>Nombre</th>
                                <th>Email</th>
                                 <th></th>
                                  <th></th>
                                   <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php if(isset($_SESSION['friendname1'])){
                                    for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) {
                                        echo '<tr>';
                                        // echo '<td>' . $i . '</td>';
                                        echo '<td>' . $_SESSION['friendname' . $i] . '</td>';
                                        echo '<td>' . $_SESSION['friendemail' . $i] . '</td>';

                                        echo '<td>' . $_SESSION['friendinvitation' . $i] . $_SESSION['friendconfirmation' . $i] . '</td>';
                                        echo '<td><a href="/secret_santa/controller/delete-friend.php?idfriend=' . $_SESSION['idfriend' . $i] . '&number=' . $i . '">DEL</a></td>';
                                        echo '<td><a href="">ASK</a></td>';
                                        echo '</tr>';
                                        }
                                }?>
                        
                        </tbody>
                    </table>
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
                        . '<strong>Num of Friends</strong>: ' . $_SESSION['numberfriends']);
                }

                echo '<br/>';
                echo '<br/>';

                echo '<h2>Friends List: (' . $_SESSION['numberfriends'] . ')</h2>';


               

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