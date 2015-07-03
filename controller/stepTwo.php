<?php 

session_start();

if( isset($_SESSION['user_id']) || !isset($_POST['form_token']) || $_POST['form_token'] != $_SESSION['form_token']) {

    // $_SESSION['error'] = 'There was a problem, please start again or login if you have an account already';
    
    header('Location:/controller/logout.php');

}elseif(!isset($_POST['title'],$_POST['description'],$_POST['price'],$_POST['gameplace'],$_POST['gamedate'])){

	$_SESSION['error'] = 'Please enter a valid data';

}elseif(ctype_digit($_POST['price']) != true ){

    $_SESSION['error'] = 'Please enter a valid data, It must be alpha numeric';

}else{

  	$gametitle = filter_var( strip_tags($_POST['title']),FILTER_SANITIZE_STRING);
    $gamedescription = filter_var(strip_tags($_POST['description']),FILTER_SANITIZE_STRING);
    $gameprice = filter_var(strip_tags($_POST['price']),FILTER_SANITIZE_NUMBER_INT);
    $gameplace = filter_var(strip_tags($_POST['gameplace']),FILTER_SANITIZE_STRING);
    $gamedate = filter_var(strip_tags($_POST['gamedate']),FILTER_SANITIZE_STRING);
    
    $form_token = md5( uniqid('auth', true) );
    $_SESSION['form_token_step2'] = $form_token;
    $_SESSION['form_token'] = $_SESSION['form_token_step2'];

    require_once "conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO user (nombreusuario, password, email) VALUES (:user_name, :user_password, :user_email)");
        $stmt->bindParam(':user_name', $_SESSION['user_name'], PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $_SESSION['user_password'], PDO::PARAM_STR, 40);
        $stmt->bindParam(':user_email', $_SESSION['user_email'], PDO::PARAM_STR);

        $stmt->execute();

        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['game_key'] = md5($_SESSION['user_id']);

        
        try { 

            $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO game (title, description, price, gameplace, gamedate, user_idusuario, gamekey ) VALUES (:game_title, :game_description, :game_price, :game_place, :game_date, :user_id, :game_key )");
            $stmt->bindParam(':game_title', $gametitle, PDO::PARAM_STR);
            $stmt->bindParam(':game_description', $gamedescription, PDO::PARAM_STR);
            $stmt->bindParam(':game_price', $gameprice, PDO::PARAM_STR);
            $stmt->bindParam(':game_place', $gameplace, PDO::PARAM_STR);
            $stmt->bindParam(':game_date', $gamedate, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':game_key', $_SESSION['game_key'], PDO::PARAM_INT);

            $stmt->execute();

            $_SESSION['game_id'] = $conn->lastInsertId();
            
            unset( $_SESSION['form_token'] );
            unset( $_SESSION['form_token_step1'] );
            unset( $_SESSION['form_token_step2'] );
            header('Location:/user/stepThree.php');
               
        }catch(Exception $e){
                    
            $_SESSION['error'] = $e->getCode() . ' ' . $e;
        }

    }catch(Exception $e){

        $_SESSION['error'] = $e->getCode() . ' ' . $e;
    }

    

}

if (isset($_SESSION['error'])) {
    
    header('Location:/stepTwo.php');
}

?>