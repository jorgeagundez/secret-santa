<?php

session_start();

$friendname = $_POST["name"];
$friendemail = $_POST["email"];

if(!isset($_SESSION['user_id']))
{
    header('Location:/secret_santa/controller/logout.php'); 
};

if ( !isset($friendname) || !isset($friendemail) ) {

    $resultado['error'] = true;
    $resultado['mensaje'] = 'Por favor, introduzca un nombre e email validos';

}else{


    require_once "../conexionDb.php";
    include "../game.php";
    require_once 'Mail.php';
    require_once 'Mail/mime.php';

            try { 

                $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT idgame, title, description, confirmed, gamekey, ended FROM game WHERE user_idusuario = :user_id");
                $stmt->bindParam(':user_id', $_SESSION['user_id'] , PDO::PARAM_STR);
                $stmt->execute();

                while( $datos = $stmt->fetch() ) {
                    $game = new Game($datos['idgame'], $datos['title'], $datos['description'], $datos['confirmed'], $datos['gamekey'], $datos['ended']);
                }; 

                    if (!$game->getIdgame()) {

                        $resultado['error'] = true;
                        $resultado['mensaje'] = 'Hubo un problema con el servidor, por favor, inténtelo más tarde';

                    }else{

                        $gamekey = $game->getGamekey();

                        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $conn->prepare("SELECT friendemail FROM friend WHERE gamekey = :game_key");
                        $stmt->bindParam(':game_key',  $gamekey , PDO::PARAM_STR);

                        $stmt->execute();

                        $allemails = $stmt->fetchAll();
                        $valid = true;

                        foreach ( $allemails as $email) {
                            if( $email['friendemail'] == $friendemail) {
                                $valid = false;
                            };
                        }
                    

                        if ($valid) {

                            try {

                            $invitation = true;

                            $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare("INSERT INTO friend (friendname, friendemail, game_idgame, gamekey, invitation) VALUES (:friend_name, :friend_email ,:game_idgame, :game_key, :invitation)");
                            $stmt->bindParam(':friend_name', $friendname, PDO::PARAM_STR);
                            $stmt->bindParam(':friend_email', $friendemail, PDO::PARAM_STR);
                            $stmt->bindParam(':game_idgame', $game->getIdgame(), PDO::PARAM_INT);
                            $stmt->bindParam(':game_key', $game->getGamekey(), PDO::PARAM_STR);
                            $stmt->bindParam(':invitation', $invitation , PDO::PARAM_BOOL );
                            
                            $stmt->execute();

                            $resultado['newid'] = $conn->lastInsertId();

                            $resultado['error'] = false;
                            $resultado['mensaje'] = 'Email enviado correctamente';

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

                            }catch(Exception $e){

                                $resultado['error'] = true;
                                $resultado['mensaje'] = 'Hubo un problema con la base de datos, por favor, inténtelo más tarde';
                                $resultado['type'] = $e;

                        }//end try

                        }else{

                            $resultado['error'] = true;
                            $resultado['mensaje'] = 'No puedes añadir a un amigo dos veces. Asegurate que estás introduciendo el email correcto';

                        }
                    

                        
                    }

                }catch(Exception $e){
                    
                    $resultado['error'] = true;
                    $resultado['mensaje'] = 'Hubo un problema con la base de datos, por favor, inténtelo más tarde';
                    $resultado['type'] = $e;

            }//End try

}

header('Content-type: application/json; charset=utf-8');
echo json_encode($resultado, JSON_FORCE_OBJECT);

?>