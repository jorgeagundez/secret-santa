<?php

session_start();

$friendname = $_POST["name"];
$friendemail = $_POST["email"];

if(!isset($_SESSION['user_id']))
{
    header('Location:/logout.php');
    
};

if ( !isset($friendname) || !isset($friendemail) ) {

    $resultado['error'] = true;
    $resultado['mensaje'] = 'Por favor, introduzca un nombre e email validos';

}else{

    require_once "../conexionDb.php";
    include "../game.php";

    try { 

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT idgame, title, description, price, gameplace, gamedate, confirmed, gamekey FROM game WHERE user_idusuario = :user_id");
        $stmt->bindParam(':user_id', $_SESSION['user_id'] , PDO::PARAM_STR);

        $stmt->execute();

        while( $datos = $stmt->fetch() ) {
            $game = new Game($datos['idgame'], $datos['title'], $datos['description'], $datos['price'], $datos['gameplace'], $datos['gamedate'], $datos['confirmed'], $datos['gamekey']);
        }; 

            if (!$game->getIdgame()) {

                $_SESSION['error'] = ' // There is a problem in the server. Please, try again.';

            }else{

                try {

                    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("INSERT INTO friend (friendname, friendemail, game_idgame, gamekey) VALUES (:friend_name, :friend_email ,:game_idgame, :game_key)");
                    $stmt->bindParam(':friend_name', $friendname, PDO::PARAM_STR);
                    $stmt->bindParam(':friend_email', $friendemail, PDO::PARAM_STR);
                    $stmt->bindParam(':game_idgame', $game->getIdgame(), PDO::PARAM_INT);
                    $stmt->bindParam(':game_key', $game->getGamekey(), PDO::PARAM_STR);
                    
                    $stmt->execute();

                    $resultado['newid'] = $conn->lastInsertId();

                    $resultado['error'] = false;
                    $resultado['mensaje'] = 'Email enviado correctamente';

            	    }catch(Exception $e){

            	    	$resultado['error'] = true;
            	    	$resultado['mensaje'] = 'Hubo un problema con la base de datos, por favor, inténtelo más tarde';
                        $resultado['type'] = $e;

            	}//end try
            }

        }catch(Exception $e){
            
            $resultado['error'] = true;
            $resultado['mensaje'] = 'Hubo un problema con la base de datos, por favor, inténtelo más tarde';
            $resultado['type'] = $e;

    }//End try
}//End if

header('Content-type: application/json; charset=utf-8');
echo json_encode($resultado, JSON_FORCE_OBJECT);

?>