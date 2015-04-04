<?php 

session_start();

if(!isset($_POST['nFriends'])) {

    header('Location:/secret_santa/stepThree.php?form_token=' . $_SESSION['form_token'] . '&error=Try again' );

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $error = 'Invalid form submission, please try again';

}else{ 

    $nFriends = intval($_POST['nFriends']);
    for ($i = 1; $i <= $nFriends; $i++) {

        if(!isset($_POST['friendname' . $i]) || !isset($_POST['friendemail' . $i])) {

            $error = 'Please enter a valid data';
            header('Location:/secret_santa/stepThree.php?form_token=' . $_SESSION['form_token'] . '&error=' . $error);

        }else{

            $friendname = filter_var($_POST['friendname' . $i],FILTER_SANITIZE_STRING);
            $friendemail = filter_var($_POST['friendemail' . $i],FILTER_SANITIZE_STRING);
            $game_id = intval($_SESSION['game_id']);

            require_once "/conexionDb.php";

            try { 

                $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("INSERT INTO friend (friendname, friendemail, game_idgame, gamekey) VALUES (:friend_name, :friend_email ,:game_idgame, :game_key)");
                $stmt->bindParam(':friend_name', $friendname, PDO::PARAM_STR);
                $stmt->bindParam(':friend_email', $friendemail, PDO::PARAM_STR);
                $stmt->bindParam(':game_idgame', $game_id, PDO::PARAM_INT);
                $stmt->bindParam(':game_key', $_SESSION['game_key'], PDO::PARAM_STR);
                

                $stmt->execute();

                $_SESSION['friendname' . $i] = $friendname;
                $_SESSION['friendemail' . $i] = $friendemail;
                $_SESSION['friendinvitation' . $i] = false;
                $_SESSION['friendconfirmation' . $i] = false;


            }catch(Exception $e){
                    
                $error = $e->getCode();
                $error = $error . ' // ' . $e->getMessage();

            }//end try
        }//end if
    }//End for

    try { 

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE game SET gamenumberfriends = :numberfriends WHERE idgame = :game_idgame");
        $stmt->bindParam(':game_idgame',$game_id , PDO::PARAM_INT);
        $stmt->bindParam(':numberfriends',$nFriends , PDO::PARAM_INT);

        $stmt->execute();

        $_SESSION['numberfriends'] = $nFriends;

        unset( $_SESSION['form_token'] );

        header('Location:/secret_santa/controller/invitations.php');

    }catch(Exception $e){
            
        $error = $e->getCode();
        $error = $error . ' // ' . $e->getMessage();

    }//end try

     try { 

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT idfriend FROM friend WHERE game_idgame = :game_id");
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);

        $stmt->execute();

        $i = 1;
        while( $datos = $stmt->fetch() ) {
            $_SESSION['idfriend' . $i] = $datos[0];
            $i++;
        };
            
        }catch(Exception $e){
                
                if( $e->getCode() == 23000){
                    $error = $error;
                }
                else{
                    $error = $e->getCode();
                }
        }//End Try
}

if (isset($error)) {
    echo $error;
    header('Location:/secret_santa/stepThree.php?form_token=' . $_SESSION['form_token'] . '&error=' . $error);
    unset($error);
}


?>