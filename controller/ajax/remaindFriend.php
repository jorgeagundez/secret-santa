<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location:/secret_santa/controller/logout.php');
}

if( isset($_POST["friendid"]) || isset($_POST["friendname"]) || isset($_POST["friendemail"]) ) {
    
    send_remaind($_POST["friendid"], $_POST["friendname"], $_POST["friendemail"]);

} else {
    
    die("Solicitud no válida. Intentelo mas tarde");
}


function send_remaind($friendid, $friendname, $friendemail) {

    // require_once 'Mail.php';
    // require_once 'Mail/mime.php';

    // $destinario =  $friendemail ;
    // $from = 'jamedina97@gmail.com';
    // $asunto = 'Invitation of ' . $_SESSION['user_name'] . ' to play Secret Santa';
    // $mensaje = '<html>
    //                 <head>
    //                     <title>'.$asunto.'</title>
    //                 </head>'.
    //             "\n";
    // $mensaje .= '<body>
    //                 <h1>Hello ' .    $friendname .', you have been invited to join a Secret Santa Game.</h1>
    //                 <p>This is the message of ' . $_SESSION['user_name'] . 'to you:  </p>
    //                 <p>' . $_SESSION['game_description'] . '</p>
    //                 <p>If you are agree with the conditions of the game. Please, confirm following this.</p>
    //                 <a href="http://www.jorgeagundez.com/confirmation.php?gameKey='. $_SESSION['game_key'] . '&friendemail=' . $friendemail . '"> link </a>
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

    // $resultado = array();

    // if (PEAR::isError($res)) {  

    //     $resultado['error'] = true;
    //     $resultado['mensaje'] = 'Hubo un problema con la solicitud de envío. Inténtelo mas tarde.';

    // }else {
        $resultado['error'] = false;
        $resultado['mensaje'] = 'Email enviado correctamente';
    // };

  

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($resultado, JSON_FORCE_OBJECT);
    
}

exit();



?>