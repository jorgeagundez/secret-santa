<?php 

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location:/logout.php');
}else{

    //PARA PRUEBAS EN SERVIDOR ONLINE
    // $_SESSION['numberfriends'] = 3;
    // $_SESSION['friendemail1'] = 'secretsanta.adria@gmail.com';
    // $_SESSION['friendname1'] = 'Adria';
    // $_SESSION['friendemail2'] = 'secretsanta.clara@gmail.com';
    // $_SESSION['friendname2'] = 'Clara';
    // $_SESSION['friendemail3'] = 'secretsanta.keyvan@gmail.com';
    // $_SESSION['friendname3'] = 'Keyvan';
    // $_SESSION['user_name'] = 'Jorge';

    require_once 'Mail.php';
    require_once 'Mail/mime.php';

    for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) {

        $destinario =  $_SESSION['friendemail' . $i] ;
        $from = 'jamedina97@gmail.com';
        $asunto = 'Invitation of ' . $_SESSION['user_name'] . ' to play Secret Santa';
        $mensaje = '<html>
                        <head>
                            <title>'.$asunto.'</title>
                        </head>'.
                    "\n";
        $mensaje .= '<body>
                        <h1>Hello ' .    $_SESSION['friendname' . $i] .', you have been invited to join a Secret Santa Game.</h1>
                        <p>If you are agree with the conditions of the game. Please, confirm following this.</p>
                        <a href="http://localhost/secret_santa/confirmation.php?gameKey='. $_SESSION['game_key'] .'&friendemail=' . $_SESSION['friendemail' . $i] '"> link </a>
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

            $error= 'There was a problem sending invitations. Please, try it later.';
            header('Location:/secret_santa/userPages/dashboard.php?&error=' . $error);

        }else{

            require_once "/conexionDb.php";
            $invitation = true;
            $confirmation = 0;

            try { 

                $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("UPDATE friend SET invitation = :invitation WHERE idfriend = :id_friend");
                $stmt->bindParam(':id_friend',$_SESSION['idfriend' . $i] , PDO::PARAM_INT);
                $stmt->bindParam(':invitation', $invitation , PDO::PARAM_BOOL );

                $stmt->execute();

                $_SESSION['friendinvitation' . $i] = $invitation;
                $_SESSION['friendconfirmation' . $i] = $confirmation;
            }catch(Exception $e){
                    
                $error= 'There was a problem sending invitations. Please, try it later.';
                header('Location:/secret_santa/userPages/dashboard.php?&error=' . $error);

            }//end try
        }
    }//Endfor

    header('Location:/secret_santa/userPages/dashboard.php');

} //endif

?>