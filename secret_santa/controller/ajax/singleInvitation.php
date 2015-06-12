<?php

session_start();

$friendid = $_POST["friendid"];
$friendname = $_POST["friendname"];
$friendemail = $_POST["friendemail"];

if(!isset($_SESSION['user_id']))
{
    header('Location:/logout.php');
    
}else{

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

    if (PEAR::isError($res)) {  

        $_SESSION['error'] = 'There was a problem sending invitations. Please, try it later.';

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

            echo $friendid;
        die();

        }catch(Exception $e){
                
            $_SESSION['info'] = 'There was a problem updating the database about invitations';

        }//end try
    }
}
   


?>