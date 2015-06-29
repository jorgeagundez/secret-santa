<?php 

session_start();

if( isset($_SESSION['user_id']) || !isset($_POST['form_token']) || $_POST['form_token'] != $_SESSION['form_token']) {

    // $_SESSION['error'] = 'There was a problem, please start again or login if you have an account already';
    
    header('Location:/secret_santa/controller/logout.php');

}elseif(!isset($_POST['title'],$_POST['description'],$_POST['price'],$_POST['gameplace'],$_POST['gamedate'])){

	$_SESSION['error'] = 'Please enter a valid data';

}elseif(ctype_digit($_POST['price']) != true ){

    $_SESSION['error'] = 'Please enter a valid data, It must be alpha numeric';

}else{

    $gametitle = strip_tags($_POST['title']);
    $gamedescription = strip_tags($_POST['description']);
    $gameprice = strip_tags($_POST['price']);
    $gameplace = strip_tags($_POST['gameplace']);
    $gamedate = strip_tags($_POST['gamedate']);

  	$_SESSION['game_title'] = filter_var($gametitle,FILTER_SANITIZE_STRING);
    $_SESSION['game_description'] = filter_var($gamedescription,FILTER_SANITIZE_STRING);
    $_SESSION['game_price'] = filter_var($gameprice,FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['game_place'] = filter_var($gameplace,FILTER_SANITIZE_STRING);
    $_SESSION['game_date'] = filter_var($gamedate,FILTER_SANITIZE_STRING);
    
    $form_token = md5( uniqid('auth', true) );
    $_SESSION['form_token_step2'] = $form_token;
    $_SESSION['form_token'] = $_SESSION['form_token_step2'];

    header('Location:/secret_santa/stepThree.php');

}

if (isset($_SESSION['error'])) {
    
    header('Location:/secret_santa/stepTwo.php');
}

?>