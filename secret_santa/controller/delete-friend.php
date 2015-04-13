<?php
/*** begin our session ***/
session_start();

if (!isset($_GET['idfriend']) || !isset($_SESSION['user_id']) || !isset($_GET['number'])) {

    $_SESSION['error'] = 'Something was wrong, try it later please';
    header('Location:/secret_santa/userPages/dashboard.php');
}

$i = $_GET['number'];
$friend_id = $_GET['idfriend'];

die();
try {

	require_once "conexionDb.php";

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("DELETE FROM friend WHERE idfriend = :friend_id");
    $stmt->bindParam(':friend_id', $friend_id, PDO::PARAM_STR);

    $stmt->execute();

    try { 

    	$gamenumberfriends = $_SESSION['numberfriends'] - 1;

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE game SET gamenumberfriends = :gamenumber_friends WHERE idgame = :id_game");
        $stmt->bindParam(':id_game', $_SESSION['game_id'] , PDO::PARAM_INT);
        $stmt->bindParam(':gamenumber_friends', $gamenumberfriends , PDO::PARAM_INT);

        $stmt->execute();

        require_once 'Mail.php';
    	require_once 'Mail/mime.php';

    	$destinario =  $_SESSION['friendemail' . $i] ;
        $from = 'jamedina97@gmail.com';
        $asunto = 'Deleted from ' . $_SESSION['user_name'] . ' Secret Santa Game';
        $mensaje = '<html>
                        <head>
                            <title>'.$asunto.'</title>
                        </head>'.
                    "\n";
        $mensaje .= '<body>
                        <h1>Hello ' .    $_SESSION['friendname' . $i] .', you have been deleted from Secret Santa Game.</h1>
                    </body>
                    </html>';
        $mime = new Mail_mime("\n");
        $mime->setTXTBody(strip_tags($mensaje));
        $mime->setHTMLBody($mensaje);

        $body = $mime->get();
        $hdrs = array('From' => $from, 'Subject' => $asunto);
        $hdrs = $mime->headers($hdrs);
        $mail =& Mail::factory('mail');
        $res = $mail->send($destinario, $hdrs, $body);

        header('Location:/secret_santa/userPages/dashboard.php?info=Your friend was deleted');

    }catch(Exception $e){
            
        $error= 'There was a problem updating the number of friends. Please, try it later.';

    }//end try

}catch(Exception $e){
        
    $error = 'Something was wrong, try it later please';

}


if (isset($error)) {

    header('Location:/secret_santa/userPages.php?&error=' . $error);
    unset($error);
}

?>