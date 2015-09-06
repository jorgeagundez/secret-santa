<?php 

    require_once 'Mail.php';
    require_once 'Mail/mime.php';

   

        $destinario = 'jamedina97@gmail.com'  ;
        $from ='jamedina97@gmail.com';
        $asunto = 'Hello';
        $mensaje = '<html>
                        <head>
                            <title>'.$asunto.'</title>
                        </head>'.
                    "\n";
        $mensaje .= '<body>
                        <h1>Esta es una prueba de que el script automatico funciona correctamente</h1>
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
            header('Location:../user/dashboard.php?&error=' . $error);

        }else{

          
            
        }




?>