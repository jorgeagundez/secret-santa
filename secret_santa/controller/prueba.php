<?php

try { 

	 $mysql_hostname = 'localhost';
    $mysql_username = 'root';
    $mysql_password = 'jam19977';
    $mysql_dbname = 'secretsanta';
    $nFriends = 87;
    $idgame = 22;

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE game SET gamenumberfriends = :numberfriends WHERE idgame = :idgame");
        $stmt->bindParam(':idgame', $idgame , PDO::PARAM_INT);
        $stmt->bindParam(':numberfriends',$nFriends , PDO::PARAM_INT);

        $stmt->execute();

        $_SESSION['numberfriends'] = $nFriends;

        echo $nFriends;
        echo '<br/>';
        print_r($stmt);

        //unset( $_SESSION['form_token'] );

       // header('Location:/secret_santa/userPages/dashboard.php');

    }catch(Exception $e){
            
        $error = $e->getCode();
        $error = $error . ' // ' . $e->getMessage();

    }//end try

if (isset($error)) {
    echo $error;
    unset($error);
}

// try { 

//     $mysql_hostname = 'localhost';
//     $mysql_username = 'root';
//     $mysql_password = 'jam19977';
//     $mysql_dbname = 'secretsanta';

// $friendname = 'mami';
// $friendemail = 'mami@gmail.com';
// $idgame = 4;

//                 $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
//                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                 $stmt = $conn->prepare("INSERT INTO friend (friendname, friendemail, game_idgame) VALUES (:friend_name, :friend_email, :game_idgame)");
//                 $stmt->bindParam(':friend_name', $friendname, PDO::PARAM_STR);
//                 $stmt->bindParam(':friend_email', $friendemail, PDO::PARAM_STR);
//                 $stmt->bindParam(':game_idgame', $idgame, PDO::PARAM_INT);
                

//                 $stmt->execute();

               


//             }catch(Exception $e){
                    
//                 $error = $e->getCode();
//                 $error = $error . ' // ' . $e->getMessage();
//             }




?>