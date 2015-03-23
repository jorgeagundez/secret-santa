<?php 

session_start();

if(!isset($_POST['title'],$_POST['description'],$_POST['price'],$_POST['gameplace'],$_POST['gamedate'],$_POST['drawdate'])){

	$error = 'Please enter a valid data';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $error = 'Invalid form submission, please try again';

}else{

  	$title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'],FILTER_SANITIZE_STRING);
    $gameplace = filter_var($_POST['gameplace'],FILTER_SANITIZE_STRING);
    $gamedate = filter_var($_POST['gamedate'],FILTER_SANITIZE_STRING);
    $drawdate = filter_var($_POST['drawdate'],FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['user_id'];

    require_once "/conexionDb.php";

    try { 

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO game (title, description, price, gameplace, gamedate, drawdate, user_idusuario ) VALUES (:game_title, :game_description, :game_price, :game_place, :game_date, :draw_date, :user_id )");
        $stmt->bindParam(':game_title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':game_description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':game_price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':game_place', $gameplace, PDO::PARAM_STR);
        $stmt->bindParam(':game_date', $gamedate, PDO::PARAM_STR);
        $stmt->bindParam(':draw_date', $drawdate, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();

    }catch(Exception $e){
            
            $error = $e->getCode();
    }

    try { 

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT idgame, title, description, price, gameplace, gamedate, drawdate, user_idusuario FROM game WHERE title = :game_title");
        $stmt->bindParam(':game_title', $title, PDO::PARAM_STR);

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
        $game_user_id = $stmt->fetchColumn(7);

        if (!$game_id) {

            $error = $error . ' // There is a problem in the server. Please, try again.';

        }else{

            $form_token = md5( uniqid('auth', true) );
            $_SESSION['form_token'] = $form_token;
            $_SESSION['game_id'] = $game_id;
            $_SESSION['game_title'] = $game_title;
            $_SESSION['game_description'] = $game_description;
            $_SESSION['game_price'] = $game_price;
            $_SESSION['game_place'] = $game_place;
            $_SESSION['game_date'] = $game_date;
            $_SESSION['game_drawdate'] = $game_drawdate;
            $_SESSION['game_price'] = $game_description;
            $_SESSION['game_user_id'] = $game_user_id;

            header('Location:/secret_santa/stepThree.php?form_token=' . $_SESSION['form_token']);

        }

    }catch(Exception $e){
            
            if( $e->getCode() == 23000){
                $error = $error . ' // Username already exists';
            }
            else{
                $error2 = $e->getCode();
                $error = $error . ' // ' . $error2;
            }

    }
}

if (isset($error)) {
    
    header('Location:/secret_santa/stepTwo.php?form_token=' . $_SESSION['form_token'] . '&error=' . $error);
    unset($error);
}

?>