<?php
/*** begin our session ***/
session_start();

$friendname = $_POST["name"];
$friendemail = $_POST["email"];
$friendid =  $_POST["friendid"]; 


try {

	require_once "../conexionDb.php";

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("DELETE FROM friend WHERE idfriend = :friend_id");
    $stmt->bindParam(':friend_id', $friendid, PDO::PARAM_STR);

    $stmt->execute();

    require_once 'Mail.php';
	require_once 'Mail/mime.php';

	$destinario =  $friendemail;
    $from = 'jamedina97@gmail.com';
    $asunto = 'Deleted from ' . $_SESSION['user_name'] . ' Secret Santa Game';
    $mensaje = '<html>
                    <head>
                        <title>'.$asunto.'</title>
                    </head>'.
                "\n";
    $mensaje .= '<body>
                    <h1>Hello ' .  $friendname .', you have been deleted from Secret Santa Game.</h1>
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

    if (PEAR::isError($res)) {  

        $_SESSION['error'] = 'There was a problem sending invitations. Please, try it later.';
    }


}catch(Exception $e){
        
    $_SESSION['error'] = 'Something was wrong, try it later please';

}


?>