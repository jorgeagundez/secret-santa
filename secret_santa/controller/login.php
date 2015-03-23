<?php 

session_start();

// if(isset($_SESSION['user_id']))
// {
//     header('Location:/secret_santa/userPages/dashboard.php');

// }else

if(!isset( $_POST['username'],$_POST['password'])){

	$error = 'Please enter a valid username and password';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $error = 'Invalid form submission, please try again';

}elseif (strlen( $_POST['username']) < 5 || strlen($_POST['username']) > 20) {

    $error = 'Incorrect Length for Username';

}elseif (strlen( $_POST['password']) < 8 || strlen($_POST['password']) > 20){

    $error = 'Incorrect Length for Password';

}elseif (ctype_alnum($_POST['username']) != true){
 
    $error = "Username must be alpha numeric";

}elseif (ctype_alnum($_POST['password']) != true){

    $error = "Password must be alpha numeric";

}else{

  	$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $password = sha1( $password );

    require_once "/conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT idusuario, nombreusuario, email, userimage FROM user WHERE nombreusuario = :user_name AND password = :user_password");
        $stmt->bindParam(':user_name', $username, PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $password, PDO::PARAM_STR, 40);
        
        $stmt->execute();
        $user_id = $stmt->fetchColumn(0);

        $stmt->execute();
        $user_name = $stmt->fetchColumn(1);

        $stmt->execute();
        $user_email = $stmt->fetchColumn(2);

        $stmt->execute();
        $user_image = $stmt->fetchColumn(3);

        unset( $_SESSION['form_token'] );

        if (!$user_id) {

            $error = 'There is no user with "' . $username . '" as an username. Please, try again.';

        }else{

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_image'] = $user_image;


            try { 

                $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT idgame, title, description, price, gameplace, gamedate, drawdate, gamenumberfriends FROM game WHERE user_idusuario = :user_id");
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

                $stmt->execute();
                $game_id = $stmt->fetchColumn(0);

                $stmt->execute();
                $game_title = $stmt->fetchColumn(1);

                $stmt->execute();
                $game_description = $stmt->fetchColumn(2);

                $stmt->execute();
                $game_price = $stmt->fetchColumn(3);

                $stmt->execute();
                $game_place = $stmt->fetchColumn(4);

                $stmt->execute();
                $game_date = $stmt->fetchColumn(5);

                $stmt->execute();
                $game_drawdate = $stmt->fetchColumn(6);

                $stmt->execute();
                $nFriends = $stmt->fetchColumn(7);

                if (!$game_id) {

                    $error = $error . ' // There is a problem in the server. Please, try again.';

                }else{

                    $_SESSION['game_id'] = $game_id;
                    $_SESSION['game_title'] = $game_title;
                    $_SESSION['game_description'] = $game_description;
                    $_SESSION['game_price'] = $game_price;
                    $_SESSION['game_place'] = $game_place;
                    $_SESSION['game_date'] = $game_date;
                    $_SESSION['game_drawdate'] = $game_drawdate;
                    $_SESSION['numberfriends'] = $nFriends;

                    $_SESSION['game_user_id'] = $user_id;


                    try { 

                        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $conn->prepare("SELECT idfriend, friendname, friendemail FROM friend WHERE game_idgame = :game_id");
                        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);

                        $stmt->execute();

                            $i = 1;
                            while( $datos = $stmt->fetch() ) {
                                $_SESSION['idfriend' . $i] = $datos[0];
                                $_SESSION['friendname' . $i] = $datos[1];
                                $_SESSION['friendemail' . $i] = $datos[2];
                                $i++;
                            };

                    }catch(Exception $e){
                            
                            if( $e->getCode() == 23000){
                                $error = $error;
                            }
                            else{
                                $error = $e->getCode();
                            }
                    }//End Try

                    header('Location:/secret_santa/userPages/dashboard.php');

                }//End Else

            }catch(Exception $e){
                    
                    if( $e->getCode() == 23000){
                        $error = $error;
                    }
                    else{
                        $error = $e->getCode();
                    }

            }//End try
        }//End Else

    }catch(Exception $e){
            
            $error = $e . ' We are unable to process your request. Please try again later';

    }//End Try
}//End Else

if (isset($error)) {

    header('Location:/secret_santa/index.php?error=' . $error);
    unset($error);
}

?>