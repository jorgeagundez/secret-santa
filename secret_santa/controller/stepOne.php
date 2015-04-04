<?php 

session_start();

if(isset($_SESSION['user_id']))
{
    header('Location:/logout.php');

}elseif(!isset($_POST['username'],$_POST['password'],$_POST['rPassword'],$_POST['email'],$_POST['rEmail'],$_POST['form_token'])){

	$error = 'Please enter a valid data';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $error = 'Invalid form submission, please try again';

}elseif (strlen( $_POST['username']) < 5 || strlen($_POST['username']) > 20) {

    $error = 'Incorrect Length for Username';

}elseif (strlen( $_POST['password']) < 8 || strlen($_POST['password']) > 20){

    $error = 'Incorrect Length for Password';

}elseif ($_POST['password'] != $_POST['rPassword']){

    $error = 'The passwords have to be the same. Please, try again.';

}elseif ($_POST['email'] != $_POST['rEmail']){

    $error = 'The emailes have to be the same. Please, try again';

}elseif (ctype_alnum($_POST['username']) != true){
 
    $error = "Username must be alpha numeric";

}elseif (ctype_alnum($_POST['password']) != true){

    $error = "Password must be alpha numeric";

}else{

  	$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $password = sha1( $password );
    $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

    require_once "/conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO user (nombreusuario, password, email) VALUES (:user_name, :user_password, :user_email)");
        $stmt->bindParam(':user_name', $username, PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $password, PDO::PARAM_STR, 40);
        $stmt->bindParam(':user_email', $email, PDO::PARAM_STR);

        $stmt->execute();

    }catch(Exception $e){
            
            if( $e->getCode() == 23000){
                $error = 'Username already exists';
            }
            else{
                $error = $e->getCode();
                print_r( $error );
            }

    }

     try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT idusuario FROM user WHERE nombreusuario = :user_name AND password = :user_password");
        $stmt->bindParam(':user_name', $username, PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $password, PDO::PARAM_STR, 40);
        
        $stmt->execute();
        $user_id = $stmt->fetchColumn(0);

        if (!$user_id) {

            $error = $error . ' // There is a problem in the server. Please, try again.';

        }else{

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $username;
            $_SESSION['user_email'] = $email;

            header('Location:/secret_santa/stepTwo.php?form_token=' . $_SESSION['form_token']);

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

    header('Location:/secret_santa/stepOne.php?error=' . $error);
    unset($error);
}

?>