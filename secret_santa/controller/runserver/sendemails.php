<?php 

    require_once 'Mail.php';
    require_once 'Mail/mime.php';

    for ($i = 0; $i < $nFriends ; $i++) {

        $destinario =  $couples[$i][0][2] ;
        $from = $useremail;
        $asunto = 'Hello ' . $couples[$i][0][1] .'.Your have the result of the drawnames!';
        $mensaje = '<html>
                        <head>
                            <title>'.$asunto.'</title>
                        </head>'.
                    "\n";
        $mensaje .= '<body>
                        <h1>Hello ' . $couples[$i][0][1] .'</h1>
                        <p>The person you have to present is: <strong>' . $couples[$i][1][1] . '</strong></p>
                        <p>Thanks for play to Secret Santa</p>
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
            header('Location:../userPages/dashboard.php?&error=' . $error);

        }else{

            
        }

    }//Endfor


?>