<?php 

session_start();

if(!isset($_POST['nFriends'])) {

    header('Location:/secret_santa/stepThree.php?form_token=' . $_SESSION['form_token'] . '&error=Try again' );

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $error = 'Invalid form submission, please try again';

}else{ 

    $nFriends = $_POST['nFriends'];

    for ($i = 1; $i <= $nFriends; $i++) {
        if(!isset($_POST['friendname' . $i]) || !isset($_POST['friendemail' . $i])) {

            $error = 'Please enter a valid data';
            header('Location:/secret_santa/stepThree.php?form_token=' . $_SESSION['form_token'] . '&error=' . $error);

        }else{

            $friendname = filter_var($_POST['friendname' . $i],FILTER_SANITIZE_STRING);
            $friendemail = filter_var($_POST['friendemail' . $i],FILTER_SANITIZE_STRING);
            $game_id = intval($_SESSION['game_id']);

            require_once "/conexionDb.php";

            try { 

                $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("INSERT INTO friend (friendname, friendemail) VALUES (:friend_name, :friend_email)");
                $stmt->bindParam(':friend_name', $friendname, PDO::PARAM_STR);
                $stmt->bindParam(':friend_email', $friendemail, PDO::PARAM_STR);
                

                $stmt->execute();

                $_SESSION['friendname' . $i] = $friendname;
                $_SESSION['friendemail' . $i] = $friendemail;


            }catch(Exception $e){
                    
                $error = $e->getCode();

            }//end try
        }//end if
    }//end for

    // try { 

    //     $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $stmt = $conn->prepare("INSERT INTO game (gamenumberfriends) VALUES (:numberfriends");
    //     $stmt->bindParam(':numberfriends',$nFriends , PDO::PARAM_INT);

    //     $stmt->execute();

    //     $_SESSION['numberfriends'] = $nFriends;

    //     unset( $_SESSION['form_token'] );

    //     header('Location:/secret_santa/userPages/dashboard.php');

    // }catch(Exception $e){
            
    //     $error = $e->getCode();

    // }//end try
}

if (isset($error)) {
    echo $error;
    //header('Location:/secret_santa/stepThree.php?form_token=' . $_SESSION['form_token'] . '&error=' . $error);
    unset($error);
}


?>