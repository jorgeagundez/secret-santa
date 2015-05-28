<?php 
session_start();


// if (!isset($_SESSION['form_token_step2'])){
//   header('Location:/secret_santa/controller/logout.php');
// }

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;

include "includes/header.php";
?>

<body>
    <header>
        <div class="fullwidth_wraper white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="top_bar"><span class="red">Paso 3 <span class="gray">|</span></span> Invita a tus amigos</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <section class="form_step_wrapper yellow steps">
        <div class="step_wrap">
            <div class="step ginger"></div>
            <div class="container">
                <form role="form" id="stepThree" method="post" action="">
                    <!-- controller/stepThree.php -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);}?>
                            </div>
                        </div>
                        <div class="friendList">
                            <div class="row">
                                <div class="col-md-3 input_wrapper">
                                    <label for="friendname1">Friend</label>
                                    <input type="text" name="friendname1" class="form-control" id="friendname1" placeholder="name" required="true"/>
                                </div>
                                <div class="col-md-9 input_wrapper">
                                    <label for="friendemail1">Email</label>
                                    <input type="email" name="friendemail1" class="form-control" id="friendemail1" placeholder="Email" required="true"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr />
                                <button type="button" class="btn btn-info addFriend pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> FRIEND</button>
                                <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                                <input type="hidden" class="nFriends" name="nFriends"/>
                                <button type="submit" class="btn btn-default pull-right">Send invitations</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="go_back">
        <a href="/secret_santa/controller/logout.php" class="" ><span class="gray">Reset</span></a></p>
    </div>
    <?php 
    include "includes/footer.php";
    ?>



