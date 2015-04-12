<?php 

session_start();

if(isset($_SESSION['user_id']))
{
    header('Location:/secret_santa/controller/logout.php');

}elseif(!isset( $_POST['username'],$_POST['password'])){

	$_SESSION['error'] = 'Please enter a valid username and password';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $_SESSION['error'] = 'Invalid form submission, please try again';

}elseif (strlen( $_POST['username']) < 5 || strlen($_POST['username']) > 20) {

    $_SESSION['error'] = 'Incorrect Length for Username';

}elseif (strlen( $_POST['password']) < 8 || strlen($_POST['password']) > 20){

    $_SESSION['error'] = 'Incorrect Length for Password';

}elseif (ctype_alnum($_POST['username']) != true){
 
    $_SESSION['error'] = "Username must be alpha numeric";

}elseif (ctype_alnum($_POST['password']) != true){

    $_SESSION['error'] = "Password must be alpha numeric";

}else{

  	$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $password = sha1( $password );

    require_once "conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT idusuario, nombreusuario, email FROM user WHERE nombreusuario = :user_name AND password = :user_password");
        $stmt->bindParam(':user_name', $username, PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $password, PDO::PARAM_STR, 40);
        
        $stmt->execute();
        $user_id = $stmt->fetchColumn(0);

        $stmt->execute();
        $user_name = $stmt->fetchColumn(1);

        $stmt->execute();
        $user_email = $stmt->fetchColumn(2);

        unset( $_SESSION['form_token'] );

        if (!$user_id) {

            $_SESSION['error'] = 'There is no user with "' . $username . '" as an username. Please, try again.';

        }else{

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;

            header('Location:/secret_santa/userPages/dashboard.php');

        }//End Else

    }catch(Exception $e){
            
            $_SESSION['error'] = $e . ' We are unable to process your request. Please try again later';

    }//End Try
}//End Else

if (isset($_SESSION['error'])) {

    header('Location:/secret_santa/index.php');

}

?>