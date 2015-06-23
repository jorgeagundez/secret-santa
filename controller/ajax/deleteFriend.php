<?php
/*** begin our session ***/
session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location:../logout.php');
}

if( isset($_POST["friendid"]) || isset($_POST["friendname"]) || isset($_POST["friendemail"]) ) {
    
    delete_friend($_POST["friendid"], $_POST["friendname"], $_POST["friendemail"]);

} else {
    
    die("Solicitud no válida. Intentelo mas tarde");
}


function delete_friend($friendid, $friendname, $friendemail) {

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

        $resultado = array();

        $resultado['error'] = false;
        $resultado['mensaje'] = 'Amigo eliminado correctamente';

        
        }catch(Exception $e){
                
            $resultado['error'] = true;
            $resultado['mensaje'] = 'No ha sido posible eliminar a tu amigo del juego. Por favor inténtelo más tarde.';

        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($resultado, JSON_FORCE_OBJECT);

}

exit();


?>