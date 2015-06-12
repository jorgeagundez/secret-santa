<?php 

session_start();

if(!isset($_POST['nFriends'])) {

    header('Location:/secret_santa/controller/logout.php');

}else {

    $nFriends = intval($_POST['nFriends']);
}


for ($i = 1; $i <= $nFriends; $i++) {

    if ( !isset($_POST['friendname' . $i]) || !isset($_POST['friendemail' . $i]) ) {

       $_SESSION['error'] = 'Please enter a valid data';
       header('Location:/secret_santa/stepThree.php');
    }
}


if(isset($_SESSION['user_id']) || !isset($_POST['form_token']) || $_POST['form_token'] != $_SESSION['form_token']){

    // $_SESSION['error'] = 'There was a problem, please start again or login if you have an account already';
    header('Location:/secret_santa/controller/logout.php');
    
}else{ 

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
            $stmt = $conn->prepare("INSERT INTO game (title, description, price, gameplace, gamedate, drawdate, user_idusuario, gamekey ) VALUES (:game_title, :game_description, :game_price, :game_place, :game_date, :draw_date, :user_id, :game_key )");
            $stmt->bindParam(':game_title', $_SESSION['game_title'], PDO::PARAM_STR);
            $stmt->bindParam(':game_description', $_SESSION['game_description'], PDO::PARAM_STR);
            $stmt->bindParam(':game_price', $_SESSION['game_price'], PDO::PARAM_STR);
            $stmt->bindParam(':game_place', $_SESSION['game_place'], PDO::PARAM_STR);
            $stmt->bindParam(':game_date', $_SESSION['game_date'], PDO::PARAM_STR);
            $stmt->bindParam(':draw_date', $_SESSION['game_drawdate'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':game_key', $_SESSION['game_key'], PDO::PARAM_INT);

            $stmt->execute();

            $_SESSION['game_id'] = $conn->lastInsertId();
            $_SESSION['numberfriends'] = $nFriends;

            for ($i = 1; $i <= $nFriends; $i++) {

                $friendname = filter_var($_POST['friendname' . $i],FILTER_SANITIZE_STRING);
                $friendemail = filter_var($_POST['friendemail' . $i],FILTER_SANITIZE_EMAIL);
                $_SESSION['game_id'] = intval($_SESSION['game_id']);

                try { 

                    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("INSERT INTO friend (friendname, friendemail, game_idgame, gamekey) VALUES (:friend_name, :friend_email ,:game_idgame, :game_key)");
                    $stmt->bindParam(':friend_name', $friendname, PDO::PARAM_STR);
                    $stmt->bindParam(':friend_email', $friendemail, PDO::PARAM_STR);
                    $stmt->bindParam(':game_idgame', $_SESSION['game_id'], PDO::PARAM_INT);
                    $stmt->bindParam(':game_key', $_SESSION['game_key'], PDO::PARAM_STR);
                    
                    $stmt->execute();

                    $_SESSION['idfriend' . $i] = $conn->lastInsertId();
                    $_SESSION['friendname' . $i] = $friendname;
                    $_SESSION['friendemail' . $i] = $friendemail;
                    $_SESSION['friendinvitation' . $i] = false;
                    $_SESSION['friendconfirmation' . $i] = false;


                }catch(Exception $e){
                        
                    $_SESSION['error'] = $e->getCode();

                }//end try
               
            }//End for

            unset( $_SESSION['form_token'] );
            unset( $_SESSION['form_token_step1'] );
            unset( $_SESSION['form_token_step2'] );
            header('Location:/secret_santa/controller/multiple_invitations.php');
               
        }catch(Exception $e){
                    
            $_SESSION['error'] = $e->getCode();
        }

    }catch(Exception $e){

        $_SESSION['error'] = $e->getCode();
    }
}



?>