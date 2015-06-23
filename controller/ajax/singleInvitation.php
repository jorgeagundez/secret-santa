<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location:/logout.php');
    
};

if( isset($_POST["friendid"]) || isset($_POST["friendname"]) || isset($_POST["friendemail"]) ) {
    
    single_invitation($_POST["friendid"], $_POST["friendname"], $_POST["friendemail"]);

} else {
    
    die("Solicitud no válida. Intentelo mas tarde");
};

function single_invitation($friendid, $friendname, $friendemail) {

    require_once 'Mail.php';
    require_once 'Mail/mime.php';

    $destinario =  $friendemail ;
    $from = 'jamedina97@gmail.com';
    $asunto = 'Invitation of ' . $_SESSION['user_name'] . ' to play Secret Santa';
    $mensaje = '<html>
                    <head>
                        <title>'.$asunto.'</title>
                    </head>'.
                "\n";
    $mensaje .= '<body>
                    <h1>Hello ' .    $friendname .', you have been invited to join a Secret Santa Game.</h1>
                    <p>This is the message of ' . $_SESSION['user_name'] . 'to you:  </p>
                    <p>' . $_SESSION['game_description'] . '</p>
                    <p>If you are agree with the conditions of the game. Please, confirm following this.</p>
                    <a href="http://www.jorgeagundez.com/secret_santa/confirmation.php?gameKey='. $_SESSION['game_key'] . '&friendemail=' . $friendemail . '"> link </a>
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

    if (PEAR::isError($res)) {  

        $resultado['error'] = true;
        $resultado['mensaje'] = 'Hubo un problema con el envío de invitaciones. Por favor, Inténtelo mas tarde.';

    }else{


        require_once "../conexionDb.php";
        $invitation = true;
        $confirmation = 0;

        try { 

            $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE friend SET invitation = :invitation WHERE idfriend = :id_friend");
            $stmt->bindParam(':id_friend', $friendid , PDO::PARAM_INT);
            $stmt->bindParam(':invitation', $invitation , PDO::PARAM_BOOL );

            $stmt->execute();

            $resultado['error'] = false;
            $resultado['mensaje'] = 'Email enviado correctamente';
      

        }catch(Exception $e){

            $resultado['error'] = true;
            $resultado['mensaje'] = 'Hubo un problema con la base de datos, por favor, inténtelo más tarde';

        }//end try

        
    }

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($resultado, JSON_FORCE_OBJECT);
}
   
exit();

?>