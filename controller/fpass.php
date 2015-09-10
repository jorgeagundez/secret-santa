<?php 

session_start();

if(isset($_SESSION['user_id']))
{
    header('Location:/controller/logout.php');

}elseif(!isset( $_POST['useremail'])){

    $_SESSION['error'] = 'Por favor, introduzca un email valido';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $_SESSION['error'] = 'Envio de formulario incorrecto, por favor, intentelo de nuevo';

}else{

    include "randomPassword.php";

    $useremail = filter_var($_POST['useremail'],FILTER_SANITIZE_STRING);
    $password = randomPassword();
    $password = sha1( $password );

    require_once "conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE user SET password = :user_password WHERE email = :user_email");
        $stmt->bindParam(':user_password', $password, PDO::PARAM_STR, 40);
        $stmt->bindParam(':user_email', $useremail, PDO::PARAM_STR);

        $stmt->execute();
        
        // $destinario =  $_SESSION['friendemail' . $i] ;
        // $from = 'jamedina97@gmail.com';
        // $asunto = 'Invitation of ' . $_SESSION['user_name'] . ' to play Secret Santa';
        // $mensaje = '<html>
        //                 <head>
        //                     <title>'.$asunto.'</title>
        //                 </head>'.
        //             "\n";
        // $mensaje .= '<body>
        //                 <h1>Hello ' .    $_SESSION['friendname' . $i] .', you have been invited to join a Secret Santa Game.</h1>
        //                 <p>This is the message of ' . $_SESSION['user_name'] . 'to you:  </p>
        //                 <p>' . $_SESSION['game_description'] . '</p>
        //                 <p>If you are agree with the conditions of the game. Please, confirm following this.</p>
        //                 <a href="http://www.jorgeagundez.com/confirmation.php?gameKey='. $_SESSION['game_key'] . '&friendemail=' . $_SESSION['friendemail' . $i] . '"> link </a>
        //             </body>
        //             </html>';
        // $mime = new Mail_mime("\n");
        // $mime->setTXTBody(strip_tags($mensaje));
        // $mime->setHTMLBody($mensaje);

        // $body = $mime->get();
        // $hdrs = array('From' => $from, 'Subject' => $asunto);
        // $hdrs = $mime->headers($hdrs);
        // $mail =& Mail::factory('mail');
        // $res = $mail->send($destinario, $hdrs, $body);

        $_SESSION['info'] = 'Su contraseña ha sido actualizada automáticamente. Recibirá un email donde podrá acceder a ella y cambiarla automáticamente desde su panel de usuario';
        header('Location: /pass.php#info');


     
    }catch(Exception $e){
            
        $_SESSION['error'] = 'Ha ocurrido un problema en el servidor, por favor, intentelo de nuevo mas tarde.';
           

    }//End Try
}//End Else

if (isset($_SESSION['error'])) {

    header('Location:/index.php');

}

?>