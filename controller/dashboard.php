<?php 

try { 

    require_once "conexionDb.php";
    include "friend.php";
    include "game.php";

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT idgame, title, description, confirmed, gamekey FROM game WHERE user_idusuario = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id'] , PDO::PARAM_STR);

    $stmt->execute();

    while( $datos = $stmt->fetch() ) {
        $game = new Game($datos['idgame'], $datos['title'], $datos['description'], $datos['confirmed'], $datos['gamekey']);
    }; 

    if (!$game->getIdgame()) {

        $_SESSION['error'] = ' // There is a problem in the server. Please, try again.';

    }else{

        try { 

            $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT idfriend, friendname, friendemail, invitation, confirmation  FROM friend WHERE game_idgame = :game_id");
            $stmt->bindParam(':game_id', $game->getIdgame(), PDO::PARAM_INT);

            $stmt->execute();

            $allFriends = array();

                while( $datos = $stmt->fetch() ) {
                    $friend = new Friend($datos['idfriend'], $datos['friendname'], $datos['friendemail'], $datos['invitation'], $datos['confirmation']);
                    $allFriends[] = $friend;
                }; 

                $i=0;
                foreach ( $allFriends as $friend ) {
                    if ( $friend->getConfirmation() ) { 
                        $i++;
                    };
                }
                $_SESSION['total_confirmed'] = $i;
                $_SESSION['numberfriends'] = count($allFriends);
         

        }catch(Exception $e){
                
                if( $e->getCode() == 23000){
                    $_SESSION['error'] = $_SESSION['error'];
                }
                else{
                    $_SESSION['error'] = $e->getCode();
                }
        }//End Try

    }//End Else

}catch(Exception $e){
        
        if( $e->getCode() == 23000){
            $_SESSION['error'] = $_SESSION['error'];
        }
        else{
            $_SESSION['error'] = $e->getCode();
        }

}//End try




?>