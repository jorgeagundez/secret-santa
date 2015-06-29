<?php

session_start();

$friendname = $_POST["name"];
$friendemail = $_POST["email"];

require_once "../conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO friend (friendname, friendemail, game_idgame, gamekey) VALUES (:friend_name, :friend_email ,:game_idgame, :game_key)");
        $stmt->bindParam(':friend_name', $friendname, PDO::PARAM_STR);
        $stmt->bindParam(':friend_email', $friendemail, PDO::PARAM_STR);
        $stmt->bindParam(':game_idgame', $_SESSION['game_id'], PDO::PARAM_INT);
        $stmt->bindParam(':game_key', $_SESSION['game_key'], PDO::PARAM_STR);
        
        $stmt->execute();

        $resultado['newid'] = $conn->lastInsertId();

        $resultado['error'] = false;
        $resultado['mensaje'] = 'Email enviado correctamente';

	    }catch(Exception $e){

	    	$resultado['error'] = true;
	    	$resultado['mensaje'] = 'Hubo un problema con la base de datos, por favor, inténtelo más tarde';
            $resultado['type'] = $e;

	    }//end try

	header('Content-type: application/json; charset=utf-8');
    echo json_encode($resultado, JSON_FORCE_OBJECT);

?>