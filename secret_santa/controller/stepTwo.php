<?php 

session_start();

if(!isset($_POST['title'],$_POST['description'],$_POST['price'],$_POST['gameplace'],$_POST['gamedate'],$_POST['drawdate'])){

	$error = 'Please enter a valid data';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $error = 'Invalid form submission, please try again';

}else{

  	$_SESSION['game_title'] = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $_SESSION['game_description'] = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
    $_SESSION['game_price'] = filter_var($_POST['price'],FILTER_SANITIZE_STRING);
    $_SESSION['game_place'] = filter_var($_POST['gameplace'],FILTER_SANITIZE_STRING);
    $_SESSION['game_date'] = filter_var($_POST['gamedate'],FILTER_SANITIZE_STRING);
    $_SESSION['game_drawdate'] = filter_var($_POST['drawdate'],FILTER_SANITIZE_STRING);
    
    $form_token = md5( uniqid('auth', true) );
    $_SESSION['form_token'] = $form_token;

    header('Location:/secret_santa/stepThree.php?form_token=' . $_SESSION['form_token']);

}

if (isset($error)) {
    
    header('Location:/secret_santa/stepTwo.php?form_token=' . $_SESSION['form_token'] . '&error=' . $error);
    unset($error);
}

?>