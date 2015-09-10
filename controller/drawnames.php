<?php

session_start();

if(!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You must be logged in to visit this page';
    header('Location:/controller/logout.php');
}

$_SESSION['id_session'] = session_id();

include "../controller/dashboard.php";
include "../includes/header.php";
require_once 'Mail.php';
require_once 'Mail/mime.php';


    $user = new Friend($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email'], 1 , 1 );
    array_push($allFriends, $user);

	$unmixed = $allFriends;
	$match = false;

    while (!$match) {

    	$match = true;

	 	shuffle($allFriends);
	 	$mixed = $allFriends;

	 	$couples = array();
	 	foreach( $unmixed as $key => $value ) {
	 		array_push($couples, array() );
	 		array_push($couples[$key],$value);
	 	}

	 	foreach( $mixed as $key => $value ) {
	 		array_push($couples[$key],$value); 	
	 	}
		
	 	foreach( $couples as $value ) {
	 		if ($value[0]->getIdfriend() == $value[1]->getIdfriend()) {
	 			$match = false;
	 		}
	 	}

	}//End while

	
	foreach ($couples as $value) {

		// Datos del juego
		$giver = $value[0];
		$receiver = $value[1];

		// Datos del email
		$destinario =  $giver->getFriendemail();
		$from = $user->getFriendemail();

		$asunto = 'Hola ' . $giver->getFriendname() . '. Averigua quién te ha tocado en tu amigo Invisible!';
        $mensaje = '<html>
                        <head>
                            <title>'.$asunto.'</title>
                        </head>'.
                    "\n";
        $mensaje .= '<body>
                        <h1>Hello ' . $giver->getFriendname() . '</h1>
                        <p>Ya tienes el resultado del amigo invisible organizado por ' . $user->getFriendname() . '.</p>
                        <p>La persona que te ha tocado es <strong>' . $receiver->getFriendname() . '</strong></p>
                        <p>Muchas gracias por jugar</p>
                        <p>Y recuerda! No reveles nunca el nombre de tu afortunad@!</p>
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

            $_SESSION['error'] = 'Ha habido un problema con el envio de las invitaciones. Por favor, intentalo mas tarde';
            header('Location:../user/dashboard.php');

        }
	}//End Foreach


	$ended = true;
	$conn3 = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
	$conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt3 = $conn3->prepare("UPDATE game SET ended = :ended WHERE idgame = :game_idgame");
	$stmt3->bindParam(':game_idgame', $game->getIdgame() , PDO::PARAM_INT);
	$stmt3->bindParam(':ended', $ended , PDO::PARAM_BOOL);
	$stmt3->execute();


	header('Location:../user/dashboard.php');



?>