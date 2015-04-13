<?php 

session_start();

if(!isset($_SESSION['user_id']))
{
    $_SESSION['error'] = 'You must be logged in to updated your details';
    header('Location:/secret_santa/index.php');
   

}elseif($_SESSION['id_session'] != session_id()){

    $_SESSION['error'] = 'There was a mistake in the session, please, login again';
    header('Location:/secret_santa/index.php');

}elseif(!isset($_POST['password'],$_POST['rPassword'],$_POST['email'],$_POST['rEmail'],$_POST['form_token'])){

    $_SESSION['error'] = 'Please enter a valid data';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $_SESSION['error'] = 'Invalid form update, please try again <a href="/ejemplos-php/practicas/ejemplo_autentificacion2/update.php">here</a>';

}elseif (strlen( $_POST['password']) < 8 || strlen($_POST['password']) > 20){

    $_SESSION['error'] = 'Incorrect Length for Password';

}elseif ($_POST['password'] != $_POST['rPassword']){

    $_SESSION['error'] = 'The passwords have to be the same. Please, try again.';

}elseif ($_POST['email'] != $_POST['rEmail']){

    $_SESSION['error'] = 'The emailes have to be the same. Please, try again';

}elseif (ctype_alnum($_POST['password']) != true){

    $_SESSION['error'] = "Password must be alpha numeric";

}else{

    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $password = sha1( $password );
    $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['user_id'];

    require_once "conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE user SET password = :user_password, email = :user_email WHERE idusuario = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $password, PDO::PARAM_STR, 40);
        $stmt->bindParam(':user_email', $email, PDO::PARAM_STR);
        
        $stmt->execute();
        
        unset( $_SESSION['form_token'] );

        if (!$user_id) {

            $_SESSION['error'] = 'There is a problem in the server. Please, try again.';

        }else{

            $_SESSION['user_email'] = $email;
            header('Location:/secret_santa/userPages/dashboard.php?info=You are now update your details');

        }

    }catch(Exception $e){
            
            if( $e->getCode() == 23000){
                $_SESSION['error'] = 'The Email is already used by an other user. Please, insert a new one';
            }
            else{
                $_SESSION['error'] = $e->getCode();
                print_r( $_SESSION['error'] );
            }

    }
}

if (isset($_SESSION['error'])) {

    header('Location:/secret_santa/userPages/update.php');

}

?>