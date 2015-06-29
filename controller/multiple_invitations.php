<?php 

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location:/logout.php');
    
}else{

    // require_once 'Mail.php';
    // require_once 'Mail/mime.php';

    for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) {

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

        // if (PEAR::isError($res)) {  

        //     $_SESSION['error'] = 'There was a problem sending invitations. Please, try it later.';

        // }else{

            require_once "conexionDb.php";
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
                    
                $_SESSION['info']= 'There was a problem updating the database about invitations';

            }//end try
        // }
    }//Endfor

    header('Location:/user/dashboard.php');

} //endif




  //   require_once '/vendor/swiftmailer/swiftmailer/lib/swift_required.php';

  //   // Create the message
  //   $message = Swift_Message::newInstance()

  // // Give the message a subject
  // ->setSubject('Probando swiftmessage')

  // // Set the From address with an associative array
  // ->setFrom(array('john@prueba.com' => 'John Doe'))

  // // Set the To addresses with an associative array
  // ->setTo(array('jamedina97@gmail.com' => 'Jorge'))

  // // Give it a body
  // ->setBody('Here is the message itself')

  // // And optionally an alternative body
  // ->addPart('<q>Here is the message itself</q>', 'text/html')

  // // Optionally add any attachments
  // // ->attach(Swift_Attachment::fromPath('my-document.pdf'))
  // ;


?>