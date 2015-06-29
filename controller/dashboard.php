<?php 

try { 

    require_once "conexionDb.php";

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT idgame, title, description, price, gameplace, gamedate, confirmed, gamekey FROM game WHERE user_idusuario = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id'] , PDO::PARAM_STR);

    $stmt->execute();
    $game_id = $stmt->fetchColumn(0);

    $stmt->execute();
    $game_title = $stmt->fetchColumn(1);

    $stmt->execute();
    $game_description = $stmt->fetchColumn(2);

    $stmt->execute();
    $game_price = $stmt->fetchColumn(3);

    $stmt->execute();
    $game_place = $stmt->fetchColumn(4);

    $stmt->execute();
    $game_date = $stmt->fetchColumn(5);

    $stmt->execute();
    $confirmed = $stmt->fetchColumn(6);

    $stmt->execute();
    $game_key = $stmt->fetchColumn(7);

    if (!$game_id) {

        $error = ' // There is a problem in the server. Please, try again.';

    }else{

        $_SESSION['game_id'] = $game_id;
        $_SESSION['game_title'] = $game_title;
        $_SESSION['game_description'] = $game_description;
        $_SESSION['game_price'] = $game_price;
        $_SESSION['game_place'] = $game_place;
        $_SESSION['game_date'] = $game_date;
        $_SESSION['groupConfirmed'] = $confirmed;
        $_SESSION['game_key'] = $game_key;

        try { 

            $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT idfriend, friendname, friendemail, invitation, confirmation  FROM friend WHERE game_idgame = :game_id");
            $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);

            $stmt->execute();

                $i = 1;
                $j = 0;
                while( $datos = $stmt->fetch() ) {
                    $_SESSION['idfriend' . $i] = $datos[0];
                    $_SESSION['friendname' . $i] = $datos[1];
                    $_SESSION['friendemail' . $i] = $datos[2];
                    $_SESSION['friendinvitation' . $i] = $datos[3];
                    $_SESSION['friendconfirmation' . $i] = $datos[4];
                        if($_SESSION['friendconfirmation' . $i] == 1){
                            $j++;
                        }
                    $i++;
                };

                $_SESSION['total_confirmed'] = $j;
                $_SESSION['numberfriends'] = $i - 1;
                

        }catch(Exception $e){
                
                if( $e->getCode() == 23000){
                    $error = $error;
                }
                else{
                    $error = $e->getCode();
                }
        }//End Try

    }//End Else

}catch(Exception $e){
        
        if( $e->getCode() == 23000){
            $error = $error;
        }
        else{
            $error = $e->getCode();
        }

}//End try




?>